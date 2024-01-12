<?php

namespace NinjaTiktokFeed\Application\Services\Platforms\Feeds\Tiktok;

use NinjaTiktokFeed\Application\Services\Platforms\Feeds\Tiktok\Config as TiktokConfig;
use WPSocialReviews\App\Services\DataProtector;
use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\App\Services\Platforms\Feeds\BaseFeed;
use WPSocialReviews\App\Services\Platforms\Feeds\CacheHandler;
use WPSocialReviews\App\Services\Platforms\Feeds\Common\FeedFilters;
use WPSocialReviews\App\Services\Platforms\PlatformData;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class TiktokFeed extends BaseFeed
{
    public $platform = 'tiktok';
    public $feedData = [];
    protected $protector;
    protected $platfromData;
    private $remoteFetchUrl = 'https://open.tiktokapis.com/v2/';
    protected $cacheHandler;
    private $client_key = 'aw4cddbhcvsbl34m';
    private $client_secret = 'IV2QhJ7nxhvEthCI2QqZTTPpoNZOPZB6';
    private $redirect_uri = 'https://wpsocialninja.com/wp-json/wpsocialreviews/tiktok_callback';


    public function __construct()
    {
        parent::__construct($this->platform);
        $this->cacheHandler = new CacheHandler('tiktok');
        $this->protector = new DataProtector();
        $this->platfromData = new PlatformData($this->platform);
    }

    public function pushValidPlatform($platforms)
    {
        $isActive = get_option('wpsr_tiktok_connected_sources_config');
        if ($isActive) {
            $platforms['tiktok'] = __('TikTok', 'ninja-tiktok-feed');
        }
        return $platforms;
    }

    public function handleCredential($args = [])
    {
        try {
            if (!empty($args['access_code'])) {
                $this->saveVerificationConfigs($args['access_code']);
            }

            wp_send_json_success([
                'message' => __('You are Successfully Verified.', 'ninja-tiktok-feed'),
                'status' => true
            ], 200);

        } catch (\Exception $exception) {
            wp_send_json_error([
                'message' => $exception->getMessage()
            ], 423);
        }
    }

    protected function getAccessToken($access_code = '')
    {
//        $app_credentials = $this->getAppCredentials();

        $args = build_query(array(
//            'client_key' => Arr::get($app_credentials, 'client_id'),
//            'client_secret' => $this->protector->maybe_decrypt(Arr::get($app_credentials, 'client_secret')),
            'client_key' => $this->client_key,
            'client_secret' => $this->client_secret,
            'code' => $access_code,
            'grant_type' => 'authorization_code',
            'redirect_uri' => $this->redirect_uri,
//            'redirect_uri' => Arr::get($app_credentials, 'redirect_uri')
        ));

        $fetchUrl = $this->remoteFetchUrl . 'oauth/token/';

        $response = wp_remote_post($fetchUrl, array(
            'body' => $args,
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ));

        if (is_wp_error($response)) {
            throw new \Exception($response->get_error_message());
        }

        if (200 !== wp_remote_retrieve_response_code($response)) {
            $errorMessage = $this->getErrorMessage($response);
            throw new \Exception($errorMessage);
        }

        return $response;
    }

    public function saveVerificationConfigs($access_code = '')
    {
        $response = $this->getAccessToken($access_code);

        if (200 === wp_remote_retrieve_response_code($response)) {
            $responseArr = json_decode(wp_remote_retrieve_body($response), true);
            $access_token = Arr::get($responseArr, 'access_token');
            $refresh_token = Arr::get($responseArr, 'refresh_token');
            $refresh_expires_in = Arr::get($responseArr, 'refresh_expires_in');
            $expires_in = intval(Arr::get($responseArr, 'expires_in'));
            $open_id = Arr::get($responseArr, 'open_id');

            $fetchUrl = $this->remoteFetchUrl . 'user/info/?fields=avatar_url,display_name,profile_deep_link';
            $response = wp_remote_get($fetchUrl, [
                'headers' => [
                    'Authorization' => "Bearer " . $access_token,
                    'Content-Type' => 'application/json'
                ],
            ]);

            if (is_wp_error($response)) {
                throw new \Exception($response->get_error_message());
            }

            if (200 !== wp_remote_retrieve_response_code($response)) {
                $errorMessage = $this->getErrorMessage($response);
                throw new \Exception($errorMessage);
            }

            if (200 === wp_remote_retrieve_response_code($response)) {
                $responseArr = json_decode(wp_remote_retrieve_body($response), true);
                $name = Arr::get($responseArr, 'data.user.display_name');
                $profile_url = Arr::get($responseArr, 'data.user.profile_deep_link');
                $avatar = Arr::get($responseArr, 'data.user.avatar_url');

                $data = [
                    'display_name' => $name,
                    'avatar_url' => $avatar,
                    'profile_url' => $profile_url,
                    'access_token' => $this->protector->encrypt($access_token),
                    'refresh_token' => $refresh_token,
                    'expiration_time' => time() + $expires_in,
                    'refresh_expires_in' => $refresh_expires_in,
                    'open_id' => $open_id,
                ];

                $sourceList = $this->getConnectedSourceList();
                $sourceList[$open_id] = $data;
                update_option('wpsr_tiktok_connected_sources_config', array('sources' => $sourceList));

                // add global tiktok settings when user verified
                $this->setGlobalSettings();
            }
        }
    }

    public function maybeRefreshToken($account)
    {
        $accessToken    = Arr::get($account, 'access_token');
        $userId         = Arr::get($account, 'open_id');
        $configs        = get_option('wpsr_tiktok_connected_sources_config', []);
        $sourceList     = Arr::get($configs, 'sources') ? $configs['sources'] : [];

        if (array_key_exists($userId, $sourceList)) {
            $existingData = $sourceList[$userId];
            $expirationTime = Arr::get($existingData, 'expiration_time', 0);
            $current_time = current_time('timestamp', true);
            $refreshToken = Arr::get($existingData, 'refresh_token', '');
            if ($expirationTime < $current_time) {
                $accessToken = $this->refreshAccessToken($refreshToken, $userId);
            }
        }
        return $accessToken;
    }

    public function refreshAccessToken($refreshTokenReceived, $userId)
    {
        $api_url = $this->remoteFetchUrl . 'oauth/token/';

//        $settings = get_option('wpsr_tiktok_global_settings');
//        $clientId = Arr::get($settings, 'app_settings.client_id', '');
//        $clientSecret = Arr::get($settings, 'app_settings.client_secret', '');
//
//        $clientId = $this->protector->decrypt($clientId);
//        $clientSecret = $this->protector->decrypt($clientSecret);

        $args = array(
            'body' => array(
//                'client_key' => $clientId,
//                'client_secret' => $clientSecret,
                'client_key' => $this->client_key,
                'client_secret' => $this->client_secret,
                'refresh_token' => $refreshTokenReceived,
                'grant_type' => 'refresh_token',
            ),
            'headers' => array(
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Cache-Control' => 'no-cache',
            ),
        );

        $response = wp_remote_post($api_url, $args);
        $body = wp_remote_retrieve_body($response);
        $data = json_decode($body, true);

        if (isset($data['open_id']) && isset($data['access_token'])) {
            $access_token = $data['access_token'];
            $refresh_token = $data['refresh_token'];
            $expires_in = intval($data['expires_in']);
            $expiration_time = time() + $expires_in;
            $open_id = $data['open_id'];

            $data = [
                'access_token' => $this->protector->encrypt($access_token),
                'refresh_token' => $refresh_token,
                'expiration_time' => $expiration_time,
                'open_id' => $open_id,
            ];

            $configs = get_option('wpsr_tiktok_connected_sources_config', []);
            $sourceList = Arr::get($configs, 'sources') ? $configs['sources'] : [];

            $existingData = $sourceList[$userId];
            $mergedData = array_merge($existingData, $data);

            $sourceList[$userId] = $mergedData;
            update_option('wpsr_tiktok_connected_sources_config', array('sources' => $sourceList));
            return $access_token;
        } else {
            return false;
        }
    }

    public function getVerificationConfigs()
    {
        $connected_source_list  = $this->getConnectedSourceList();
        wp_send_json_success([
            'connected_source_list'  => $connected_source_list,
            'status'                 => true,
        ], 200);
    }

    public function clearVerificationConfigs($userId)
    {
        $sources = $this->getConnectedSourceList();
        unset($sources[$userId]);
        update_option('wpsr_tiktok_connected_sources_config', array('sources' => $sources));

        if (!count($sources)) {
            delete_option('wpsr_tiktok_connected_sources_config');
//            delete_option('wpsr_tiktok_global_settings');
        }

        $cache_names = [
            'user_account_header_' . $userId,
            'user_feed_id_' . $userId,
//            'specific_videos_id_' . $userId,
        ];

        foreach ($cache_names as $cache_name) {
            $this->cacheHandler->clearCacheByName($cache_name);
        }

        wp_send_json_success([
            'message' => __('Successfully Disconnected!', 'ninja-tiktok-feed'),
        ], 200);
    }

    public function getConnectedSourceList()
    {
        $configs = get_option('wpsr_tiktok_connected_sources_config', []);
        $sourceList = Arr::get($configs, 'sources') ? $configs['sources'] : [];
        return $sourceList;
    }

    public function getTemplateMeta($settings = array(), $postId = null)
    {
        $feed_settings = Arr::get($settings, 'feed_settings', array());
        $apiSettings   = Arr::get($feed_settings, 'source_settings', array());
        $data = [];
        if(!empty(Arr::get($apiSettings, 'selected_accounts'))) {
            $response = $this->apiConnection($apiSettings);
            if(isset($response['error_message'])) {
                $settings['dynamic'] = $response;
            } else {
                $data['items'] = $response;
            }
        } else {
            $settings['dynamic']['error_message'] = __('Please select an Account to get feeds.', 'ninja-tiktok-feed');
        }

        $account = Arr::get($feed_settings, 'header_settings.account_to_show');
        if(!empty($account)) {
            $accountDetails = $this->getAccountDetails($account);
            if(isset($accountDetails['error_message'])) {
                $settings['dynamic'] = $accountDetails;
            } else {
                $data['header'] = $accountDetails;
            }
        }

        if (Arr::get($settings, 'dynamic.error_message')) {
            $filterResponse = $settings['dynamic'];
        } else {
            $filterResponse = (new FeedFilters())->filterFeedResponse($this->platform, $feed_settings, $data);
        }
        $settings['dynamic'] = $filterResponse;
        return $settings;
    }

    public function getEditorSettings($args = [])
    {
        $postId = Arr::get($args, 'postId');
        $tiktokConfig = new TiktokConfig();
        $feed_meta       = get_post_meta($postId, '_wpsr_template_config', true);
        $feed_template_style_meta = get_post_meta($postId, '_wpsr_template_styles_config', true);
        $decodedMeta     = json_decode($feed_meta, true);
        $feed_settings   = Arr::get($decodedMeta, 'feed_settings', array());
        $feed_settings   = TiktokConfig::formatTiktokConfig($feed_settings, array());
        $settings        = $this->getTemplateMeta($feed_settings, $postId);
        $templateDetails = get_post($postId);
        $settings['feed_type'] = Arr::get($settings, 'feed_settings.source_settings.feed_type');
        $settings['styles_config'] = $tiktokConfig->formatStylesConfig(json_decode($feed_template_style_meta, true), $postId);

        $translations = GlobalSettings::getTranslations();
        wp_send_json_success([
            'message'          => __('Success', 'ninja-tiktok-feed'),
            'settings'         => $settings,
            'sources'          => $this->getConnectedSourceList(),
            'template_details' => $templateDetails,
            'elements'         => $tiktokConfig->getStyleElement(),
            'translations'     => $translations
        ], 200);
    }

    public function updateEditorSettings($settings = array(), $postId = null)
    {
        if(defined('WPSOCIALREVIEWS_PRO') && class_exists('\WPSocialReviewsPro\App\Services\TemplateCssHandler')){
            (new \WPSocialReviewsPro\App\Services\TemplateCssHandler())->saveCss($settings, $postId);
        }

        // unset them for wpsr_template_config meta
        $unsetKeys = ['dynamic', 'feed_type', 'styles_config', 'styles', 'responsive_styles'];
        foreach ($unsetKeys as $key){
            if(Arr::get($settings, $key, false)){
                unset($settings[$key]);
            }
        }

        $encodedMeta = json_encode($settings, JSON_UNESCAPED_UNICODE);
        update_post_meta($postId, '_wpsr_template_config', $encodedMeta);

        $this->cacheHandler->clearPageCaches($this->platform);
        wp_send_json_success([
            'message' => __('Template Saved Successfully!!', 'ninja-tiktok-feed'),
        ], 200);
    }

    public function editEditorSettings($settings = array(), $postId = null)
    {
        $styles_config = Arr::get($settings, 'styles_config');

        $format_feed_settings = TiktokConfig::formatTiktokConfig($settings['feed_settings'], array());
        $settings             = $this->getTemplateMeta($format_feed_settings);
        $settings['feed_type'] = Arr::get($settings, 'feed_settings.source_settings.feed_type');

        $settings['styles_config'] = $styles_config;
        wp_send_json_success([
            'settings' => $settings,
        ]);
    }

    public function apiConnection($apiSettings)
    {
        return $this->getMultipleFeeds($apiSettings);
    }

    public function getMultipleFeeds($apiSettings)
    {
        $ids = Arr::get($apiSettings, 'selected_accounts');
        $connectedAccounts = $this->getConnectedSourceList();
        $multiple_feeds = [];
        foreach ($ids as $id) {
            if (isset($connectedAccounts[$id])) {
                $accountInfo = $connectedAccounts[$id];
                $feed = $this->getAccountFeed($accountInfo, $apiSettings);
                if(isset($feed['error_message'])) {
                    return $feed;
                }
                $multiple_feeds[] = $feed['videos'];
            }
        }

        $tiktok_feeds = [];
        foreach ($multiple_feeds as $index => $feeds) {
            $tiktok_feeds = array_merge($tiktok_feeds, $feeds);
        }

        return $tiktok_feeds;
    }

    public function getAccountFeed($account, $apiSettings, $cache = false)
    {
        $accessToken    = $this->protector->decrypt($account['access_token']) ? $this->protector->decrypt($account['access_token']) : $account['access_token'];
        $accountId         = Arr::get($account, 'open_id');
        $feedType       = Arr::get($apiSettings, 'feed_type', 'user_feed');

        $totalFeed      = Arr::get($apiSettings, 'feed_count');
        $totalFeed      = !defined('WPSOCIALREVIEWS_PRO') && $totalFeed > 10 ? 10 : $totalFeed;
        $totalFeed      = apply_filters('ninja_tiktok_feed/tiktok_feeds_limit', $totalFeed);
        if(defined('WPSOCIALREVIEWS_PRO') && $totalFeed > 200){
            $totalFeed = 200;
        }

        if($totalFeed >= 20){
            $perPage = 20;
        } else {
            $perPage = $totalFeed;
        }

        $pages = (int)($totalFeed / $perPage);
        if(($totalFeed % $perPage) > 0){
            $pages++;
        }

        $accountCacheName  = $feedType.'_id_'.$accountId.'_num_'.$totalFeed;

//        elseif ($feedType === 'specific_videos') {
//            $apiSpecificVideos = Arr::get($apiSettings, 'specific_videos', []);
//            $video_ids = array_map('trim', explode(',', $apiSpecificVideos));
//
//            $cached_video_ids = get_option('wpsr_tiktok_specific_video_ids', []);
//
//            $difference1 = array_diff($video_ids, $cached_video_ids);
//            $difference2 = array_diff($cached_video_ids, $video_ids);
//
//            $accountCacheName = $feedType . '_id_' . $accountId . '_video_ids_' . count($video_ids);
//
//            if (!empty($difference1) && !empty($difference2)) {
//                if(!empty($cached_video_ids)){
//                    $this->cacheHandler->clearCacheByName($accountCacheName);
//                }
//                $cache = false;
//            }
//
//            if($cached_video_ids !== $video_ids) {
//                update_option('wpsr_tiktok_specific_video_ids', $video_ids);
//            }
//
//        }

        $feeds = [];
        if(!$cache) {
            $feeds = $this->cacheHandler->getFeedCache($accountCacheName);
        }
        $fetchUrl = '';

        if(!$feeds) {
            $request_data = '';
            $fields = '';

            $body_args = [];

            if($feedType === 'user_feed') {
                $fields = 'video/list/?fields=id,title,duration,cover_image_url,embed_link,create_time';
                $fields = apply_filters('ninja_tiktok_feed/tiktok_video_api_details', $fields);
                $fetchUrl = $this->remoteFetchUrl . $fields ;
                $body_args = [
                    'max_count' => $perPage
                ];
            }
//            elseif ($feedType === 'specific_videos') {
//                $fields = apply_filters('ninja_tiktok_feed/tiktok_specific_video_api_details', '');
//                $fetchUrl = $this->remoteFetchUrl . $fields;
//
//                $video_ids = apply_filters('ninja_tiktok_feed/tiktok_specific_video_ids', $apiSettings);
//
//                if (empty($video_ids)) {
//                    return [
//                        'error_message' => __('Please enter at least one video id', 'ninja-tiktok-feed')
//                    ];
//                }
//
//                $request_data = json_encode(array(
//                    "filters" => [
//                        "video_ids" => $video_ids
//                    ],
//                    'max_count' => $perPage,
//                ));
//            }

            $account_data = $this->makeRequest($fetchUrl, $accessToken, $body_args);

            if(is_wp_error($account_data)) {
                $errorMessage = ['error_message' => $account_data->get_error_message()];
                return $errorMessage;
            }

            if(Arr::get($account_data, 'response.code') !== 200) {
                $errorMessage = $this->getErrorMessage($account_data);
                return ['error_message' => $errorMessage];
            }

            if (Arr::get($account_data, 'response.code') === 200) {
                $account_feeds = json_decode(wp_remote_retrieve_body($account_data), true);

                if (isset($account_feeds['data']) && !empty($account_feeds['data'])) {
                    $this->feedData = $account_feeds['data']['videos'];

                    if (isset($account_feeds['data']['has_more']) && !empty($account_feeds['data']['has_more']) && isset($account_feeds['data']['cursor']) && ($account_feeds['data']['cursor']) !== 0) {
                        $x = 0;
                        while ($x < $pages) {
                            $cursorIs = $account_feeds['data']['cursor'];
                            $fetchUrl = $this->remoteFetchUrl . $fields;
                            $body_args = [
                                'max_count' => 20,
                                'cursor' => $cursorIs,
                            ];
                            $account_data = $this->makeRequest($fetchUrl, $accessToken, $body_args);

                            $account_feeds = json_decode(wp_remote_retrieve_body($account_data), true);
                            $new_data = $account_feeds['data']['videos'];
                            $this->feedData = array_merge($this->feedData, $new_data);
                            $x++;

                            if (isset($account_feeds['data']['has_more']) && $account_feeds['data']['has_more'] === false) {
                                break;
                            }
                        }
                    }

                    $this->feedData = array_slice($this->feedData, 0, $totalFeed);

                    $account_feeds['data']['videos'] = $this->feedData;

                    $configs = get_option('wpsr_tiktok_connected_sources_config', []);
                    $sourceList = Arr::get($configs, 'sources', []);
                    $sourceFrom = Arr::get($sourceList, $accountId, '');

                    if (isset($account_feeds['data']['videos'])) {
                        foreach ($account_feeds['data']['videos'] as &$feed) {
                            $feed['from'] = $sourceFrom;
                        }
                    }

                    $dataFormatted = $this->formatData($account_feeds['data']);
                    $account_feeds['data'] = $dataFormatted;
                    $this->cacheHandler->createCache($accountCacheName, $dataFormatted);
                }
                $feeds = Arr::get($account_feeds, 'data', []);
            }
        }

        if(!$feeds || empty($feeds)) {
            return [];
        }

        return $feeds;
    }


    public function makeRequest($url, $accessToken, $bodyArgs)
    {
        $args = [
            'headers' => [
                'Authorization' => "Bearer " . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'timeout' => 60,
        ];

        if ($bodyArgs) {
            $args['body'] = json_encode($bodyArgs);
        }

        return wp_remote_post($url, $args);
    }

    public function getFormattedUser($user)
    {
        $curUser = [];
        $curUser["name"] = Arr::get($user, 'display_name', '');
		$curUser["profile_image_url"] = Arr::get($user, 'avatar_url', '');
        $curUser["profile_url"] = Arr::get($user, 'profile_url', '');
        $curUser["id"] = Arr::get($user, 'open_id', '');
        return $curUser;
    }

    public function getFormattedStatistics($video)
    {
        $curStatistics = [];
        $curStatistics['like_count'] = Arr::get($video, 'like_count', 0);
        $curStatistics['view_count'] = Arr::get($video, 'view_count', 0);
        $curStatistics['comment_count'] = Arr::get($video, 'comment_count', 0);
        $curStatistics['share_count'] = Arr::get($video, 'share_count', 0);

        return $curStatistics;
    }

    public function getFormattedMedia($video)
    {
        $curMedia = [];
        $curMedia['url'] = Arr::get($video, 'embed_link', '');
        $curMedia['preview_image_url'] = Arr::get($video, 'cover_image_url', '');
        $curMedia['duration'] = Arr::get($video, 'duration', 0);

        return $curMedia;
    }

//    public function getAppCredentials()
//    {
//        $settings = get_option('wpsr_' . $this->platform . '_global_settings');
//        $enableApp = Arr::get($settings, 'app_settings.enable_app', 'false');
//        $client_id = Arr::get($settings, 'app_settings.client_id', '');
//        $client_secret = Arr::get($settings, 'app_settings.client_secret', '');
//        $redirect_uri = Arr::get($settings, 'app_settings.redirect_uri', '');
//
//        return [
//            'enable_app' => $enableApp,
//            'client_id' => $this->protector->maybe_decrypt($client_id),
//            'client_secret' => $client_secret,
//            'redirect_uri' => $redirect_uri,
//        ];
//    }

    public function formatData($data = [])
    {
        $allData = $data;
        $videos = Arr::get($data, 'videos', []);

        $formattedVideos = [];
        foreach ($videos as $index => $video) {
            $user = Arr::get($video, 'from', []);
            $formattedUser = $this->getFormattedUser($user);
            $formattedVideos[$index]['id'] = Arr::get($video, 'id', '');
            $formattedVideos[$index]['user'] = $formattedUser;

            $formattedStatistics = $this->getFormattedStatistics($video);
            $formattedVideos[$index]['statistics'] = $formattedStatistics;

            $formattedMedia = $this->getFormattedMedia($video);
            $formattedVideos[$index]['media'] = $formattedMedia;

            $formattedVideos[$index]['created_at'] = Arr::get($video, 'create_time', '');
            $formattedVideos[$index]['title'] = Arr::get($video, 'title', '');
            $formattedVideos[$index]['text'] = Arr::get($video, 'video_description', '');
        }

        $allData['videos'] = $formattedVideos;

        return $allData;
    }

    public function getAccountDetails($account)
    {
        $connectedAccounts = $this->getConnectedSourceList();
        $accountDetails = [];
        if (isset($connectedAccounts[$account])) {
            $accountInfo = $connectedAccounts[$account];
            $accountDetails  = $this->getHeaderDetails($accountInfo, false);
        }
        return $accountDetails;
    }

    public function getHeaderDetails($account, $cacheFetch = false)
    {
        $accountId         = Arr::get($account, 'open_id');
        $accessToken    = $this->protector->decrypt($account['access_token']) ? $this->protector->decrypt($account['access_token']) : $account['access_token'];
        $accountCacheName = 'user_account_header_'.$accountId;

        $accountData = [];
        if(!$cacheFetch) {
            $accountData = $this->cacheHandler->getFeedCache($accountCacheName);
        }

        if(empty($accountData) || $cacheFetch) {
            $fetchUrl = $this->remoteFetchUrl . 'user/info/?fields=open_id,union_id,avatar_url,profile_deep_link,display_name,bio_description,is_verified,follower_count,following_count,likes_count,video_count';
            $args     = array(
                'headers' => [
                    'Authorization' => "Bearer ". $accessToken,
                    'Content-Type' => 'application/json'
                ],
            );
            $accountData = wp_remote_get($fetchUrl , $args);

            if(is_wp_error($accountData)) {
                return ['error_message' => $accountData->get_error_message()];
            }

            if(Arr::get($accountData, 'response.code') !== 200) {
                $errorMessage = $this->getErrorMessage($accountData);
                return ['error_message' => $errorMessage];
            }

            if(Arr::get($accountData, 'response.code') === 200) {
                $accountData = json_decode(wp_remote_retrieve_body($accountData), true);

                $this->cacheHandler->createCache($accountCacheName, $accountData);
            }
        }

        return $accountData;
    }

    public function getErrorMessage($response = [])
    {
        $userProfileErrors = json_decode(wp_remote_retrieve_body($response), true);

        $message = Arr::get($response, 'response.message');
        if (Arr::get($userProfileErrors, 'error')) {
            if(Arr::get($userProfileErrors, 'error.message')) {
                $error = Arr::get($userProfileErrors, 'error.message');
            }else {
                $error = Arr::get( $userProfileErrors, 'error.error_user_msg', '' );
            }
        } else if (Arr::get($response, 'response.error')) {
            $error = Arr::get($response, 'response.error.message');
        } else if ($message) {
            $error = $message;
        } else {
            $error = __('Something went wrong', 'ninja-tiktok-feed');
        }
        return $error;
    }

    public function setGlobalSettings()
    {
        $option_name    = 'wpsr_' . $this->platform . '_global_settings';
        $existsSettings = get_option($option_name);
        if (!$existsSettings) {
            $args = array(
                'global_settings' => array(
                    'expiration'    => 60*60*6,
                    'caching_type'  => 'background'
                )
            );
            update_option($option_name, $args);
        }
    }

    public function updateCachedFeeds($caches)
    {
        $this->cacheHandler->clearPageCaches($this->platform);
        foreach ($caches as $index => $cache) {
            $optionName = $cache['option_name'];
            $num_position = strpos($optionName, '_num_');
            $total    = substr($optionName, $num_position + strlen('_num_'), strlen($optionName));

            $feed_type  = '';
            $separator        = '_feed';
            $feed_position    = strpos($optionName, $separator) + strlen($separator);
            $initial_position = 0;
            if ($feed_position) {
                $feed_type = substr($optionName, $initial_position, $feed_position - $initial_position);
            }

            $id_position = strpos($optionName, '_id_');
            $sourceId    = substr($optionName, $id_position + strlen('_id_'),
                $num_position - ($id_position + strlen('_id_')));

//            $feedTypes = ['user_feed', 'specific_videos'];
            $feedTypes = ['user_feed'];
            $connectedSources = $this->getConnectedSourceList();
            if(in_array($feed_type, $feedTypes)) {
                if(isset($connectedSources[$sourceId])) {
                    $account = $connectedSources[$sourceId];
                    $this->maybeRefreshToken($account);
                    $apiSettings['feed_type'] = $feed_type;
                    $apiSettings['feed_count'] = $total;
                    $this->getAccountFeed($account, $apiSettings, true);
                }
            }

            $accountIdPosition = strpos($optionName, '_account_header_');
            $accountId = substr($optionName, $accountIdPosition + strlen('_account_header_'), strlen($optionName));
            if(!empty($accountId)) {
                if(isset($connectedSources[$accountId])) {
                    $account = $connectedSources[$accountId];
                    $this->getHeaderDetails($account, true);
                }
            }
        }
    }

    public function clearCache()
    {
        $this->cacheHandler->clearPageCaches($this->platform);
        $this->cacheHandler->clearCache();
        wp_send_json_success([
            'message' => __('Cache cleared successfully!', 'ninja-tiktok-feed'),
        ], 200);
    }
}