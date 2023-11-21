<?php

namespace NinjaTiktokFeed\Application\Hooks\Handlers;
use NinjaTiktokFeed\Application\Services\Platforms\Feeds\Tiktok\TiktokFeed;
use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler as BaseShortCodeHandler;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Platforms\Feeds\Config;
use NinjaTiktokFeed\Application\Traits\LoadView;



class ShortcodeHandler
{
    use LoadView;
    public function renderTiktokTemplate($templateId, $platform)
    {
        if (defined('LSCWP_V')) {
            do_action('litespeed_tag_add', 'wpsn_purge_tiktok_feed');
        }
        do_action('wpsocialreviews/before_display_tiktok_feed');

        $template_meta = $this->templateMeta($templateId, $platform);

        if (!empty($template_meta['error_message'])) {
            return $template_meta['error_message'] . '<br/>';
        }

        $feed = (new TiktokFeed())->getTemplateMeta($template_meta, $templateId);
        $settings = $this->formatFeedSettings($feed);

        $error_message = Arr::get($settings['dynamic'], 'error_message');
        if (Arr::get($error_message, 'error_message')) {
            return $error_message['error_message'];
        } elseif ($error_message) {
            return $error_message;
        }

        if (sizeof(Arr::get($settings, 'feeds')) === 0) {
            return '<p>' . __('Posts are not available!', 'wp-social-reviews') . '</p>';
        }

        //template mapping
        $templateMapping = [
            'template1' => 'feeds-templates/tiktok/template1',
        ];

        $template = Arr::get($settings['feed_settings'], 'template', '');
        if (!isset($templateMapping[$template])) {
            return '<p>' . __('No Templates found!! Please save and try again', 'wp-social-reviews') . '</p>';
        }

        $file = $templateMapping[$template];

        $layout = Arr::get($settings, 'feed_settings.layout_type');
        do_action('wp_social_review_loading_layout_' . $layout, $templateId, $settings);

        //pagination settings
        $pagination_settings = $this->formatPaginationSettings($feed);

        $translations = GlobalSettings::getTranslations();

        if (Arr::get($settings['feed_settings'], 'post_settings.display_mode') === 'popup') {
            $feeds = $settings['feeds'];
            foreach ($feeds as $index => $feed) {
                /* translators: %s: Human-readable time difference. */
                $create_time = Arr::get($feed, 'created_at');
                $feeds[$index]['time_ago'] = sprintf(__('%s ago'), human_time_diff($create_time));
            }
            (new BaseShortCodeHandler())->makePopupModal($feeds, $settings['header'], $settings['feed_settings'], $templateId, $platform);
            (new BaseShortCodeHandler())->enqueuePopupScripts();
        }

        // if(Arr::get($settings['feed_settings'], 'pagination_settings.pagination_type') != 'none') {
        (new BaseShortCodeHandler())->enqueueScripts();
        //}
        do_action('wpsocialreviews/load_template_assets', $templateId);

        $html = '';

        $html .=  $this->loadView('feeds-templates/tiktok/header', array(
            'templateId'    => $templateId,
            'template'      => $template,
            'header'        => $settings['header']['data']['user'],
            'feed_settings' => $settings['feed_settings'],
            'layout_type'   => $settings['layout_type'],
            'column_gaps'   => $settings['column_gaps'],
            'translations'  => $translations
        ));

        $html .= $this->loadView($file, array(
            'templateId'    => $templateId,
            'feeds'         => $settings['feeds'],
            'template_meta' => $settings['feed_settings'],
            'paginate'      => $pagination_settings['paginate'],
            'sinceId'       => $pagination_settings['sinceId'],
            'maxId'         => $pagination_settings['maxId'],
            'pagination_settings' => $pagination_settings,
            'translations'  => $translations
        ));

        $html .= $this->loadView('feeds-templates/tiktok/footer', array(
            'templateId'      => $templateId,
            'feeds'           => $settings['feeds'],
            'feed_settings'   => $settings['feed_settings'],
            'layout_type'     => $settings['layout_type'],
            'column_gaps'     => $settings['column_gaps'],
            'paginate'        => $pagination_settings['paginate'],
            'pagination_type' => $pagination_settings['pagination_type'],
            'header'        => $settings['header']['data']['user'],
            'total'           => $pagination_settings['total'],
        ));

        return $html;
    }

    public function templateMeta($templateId, $platform)
    {
        $encodedMeta = get_post_meta($templateId, '_wpsr_template_config', true);
        $template_meta = json_decode($encodedMeta, true);

        if (!$template_meta || empty($template_meta)) {
            return ['error_message' => __('No template is available for this shortcode!!', 'wp-social-reviews')];
        }
        $error_message = __('Please set a template platform name on your shortcode', 'wp-social-reviews');

        if ($platform === 'tiktok') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatTiktokConfig($configs, []);
        }

        if (!Arr::get($template_meta, 'feed_settings.platform')) {
            return [
                'error_message' => $error_message
            ];
        }

        return $template_meta;
    }

    public function formatFeedSettings($feed = [], $platform = '')
    {
        $feed_settings = Arr::get($feed, 'feed_settings', []);
        $filterSettings = Arr::get($feed_settings, 'filters', []);
        $dynamic = Arr::get($feed, 'dynamic', $feed);
        $feeds = Arr::get($dynamic, 'items', []);

        $header = Arr::get($dynamic, 'header', []);
        $layout_type = Arr::get($feed_settings, 'layout_type', 'grid');

        $column_gaps = Arr::get($feed_settings, 'column_gaps', 'default');

        return [
            'feeds'           => $feeds,
            'header'          => $header,
            'feed_settings'   => $feed_settings,
            'filter_settings' => $filterSettings,
            'layout_type'     => $layout_type,
            'column_gaps'     => $layout_type !== 'carousel' ? $column_gaps : null,
            'dynamic'         => $dynamic,
        ];
    }

    public function formatPaginationSettings($feed = [], $platform = '')
    {
        $settings = $this->formatFeedSettings($feed);
        $sinceId = 0;
        $paginate = intval(Arr::get($settings['feed_settings'], 'pagination_settings.paginate', 6));
        $maxId = ($sinceId + $paginate) - 1;
        if ($platform === 'twitter') {
            $totalFeed = is_array($settings['dynamic']) ? count($settings['dynamic']) : 0;
        } else {
            $totalFeed = is_array($settings['feeds']) ? count($settings['feeds']) : 0;
        }

        $numOfFeeds = Arr::get($settings, 'filter_settings.total_posts_number');
        $totalFilterFeed = wp_is_mobile() ? Arr::get($numOfFeeds, 'mobile') : Arr::get($numOfFeeds, 'desktop');
        $total = (int)($totalFilterFeed && $totalFeed < $totalFilterFeed) ? $totalFeed : $totalFilterFeed;

        $pagination_type = Arr::get($settings['feed_settings'], 'pagination_settings.pagination_type', 'none');

        if ($settings['layout_type'] === 'carousel' || $pagination_type === 'none') {
            $maxId = $totalFeed;
        }

        return [
            'sinceId'         => $sinceId,
            'maxId'           => $maxId,
            'paginate'        => $paginate,
            'total'           => $total,
            'pagination_type' => $pagination_type,
        ];
    }
}
