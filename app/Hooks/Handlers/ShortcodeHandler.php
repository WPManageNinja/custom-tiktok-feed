<?php

namespace CustomFeedForTiktok\Application\Hooks\Handlers;
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

use CustomFeedForTiktok\Application\Services\Platforms\Feeds\Tiktok\TiktokFeed;
use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler as BaseShortCodeHandler;
use WPSocialReviews\Framework\Support\Arr;
use CustomFeedForTiktok\Application\Traits\LoadView;



class ShortcodeHandler
{
    use LoadView;
    public function renderTiktokTemplate($templateId, $platform)
    {
        if (defined('LSCWP_V')) {
            do_action('litespeed_tag_add', 'wpsn_purge_tiktok');
        }

        $shortcodeHandler = new BaseShortCodeHandler();

        $template_meta = $shortcodeHandler->templateMeta($templateId, $platform);
        $account_ids = Arr::get($template_meta, 'feed_settings.source_settings.selected_accounts');
        do_action('wpsocialreviews/before_display_tiktok_feed', $account_ids);

        $feed = (new TiktokFeed())->getTemplateMeta($template_meta, $templateId);
        $settings      = $shortcodeHandler->formatFeedSettings($feed);


        //template mapping
        $templateMapping = [
            'template1' => 'public/feeds-templates/tiktok/template1',
        ];

        $template = Arr::get($settings['feed_settings'], 'template', '');
//        if (!isset($templateMapping[$template])) {
//            return '<p>' . __('No Templates found!! Please save and try again', 'custom-feed-for-tiktok') . '</p>';
//        }

//        $file = $templateMapping[$template];

        $layout = Arr::get($settings, 'feed_settings.layout_type');
        do_action('wp_social_review_loading_layout_' . $layout, $templateId, $settings);

        //pagination settings
        $pagination_settings = $shortcodeHandler->formatPaginationSettings($feed);

        $translations = GlobalSettings::getTranslations();

        if (Arr::get($settings['feed_settings'], 'post_settings.display_mode') === 'popup') {
            $feeds = $settings['feeds'];
            foreach ($feeds as $index => $feed) {
                /* translators: %s: Human-readable time difference. */
                $create_time = Arr::get($feed, 'created_at');
                /* translators: %s: Human-readable time difference. */
                $feeds[$index]['time_ago'] = sprintf(__('%s ago'), human_time_diff($create_time));
            }
            $shortcodeHandler->makePopupModal($feeds, $settings['header'], $settings['feed_settings'], $templateId, $platform);
            $shortcodeHandler->enqueuePopupScripts();
        }

        $shortcodeHandler->enqueueScripts();
        do_action('wpsocialreviews/load_template_assets', $templateId);

        $html = '';
        $error_data = Arr::get($settings['dynamic'], 'error');

        if (Arr::get($error_data, 'error.message')) {
            $html .= apply_filters('wpsocialreviews/display_frontend_error_message', $platform, $error_data['error']['message'], $account_ids);
        } elseif ($error_data) {
            $html .= apply_filters('wpsocialreviews/display_frontend_error_message', $platform, $error_data, $account_ids);
        }

        $template_body_data = [
            'templateId'    => $templateId,
            'feeds'         => $settings['feeds'],
            'template_meta' => $settings['feed_settings'],
            'paginate'      => $pagination_settings['paginate'],
            'sinceId'       => $pagination_settings['sinceId'],
            'maxId'         => $pagination_settings['maxId'],
            'pagination_settings' => $pagination_settings,
            'translations'  => $translations
        ];

        $html .=  $this->loadView('public/feeds-templates/tiktok/header', array(
            'templateId'    => $templateId,
            'template'      => $template,
            'header'        => Arr::get($settings, 'header.data.user'),
            'feed_settings' => $settings['feed_settings'],
            'layout_type'   => $settings['layout_type'],
            'column_gaps'   => $settings['column_gaps'],
            'translations'  => $translations
        ));

        if (defined('WPSOCIALREVIEWS_PRO') && $template !== 'template1') {
            $html .= apply_filters('wpsocialreviews/add_tiktok_feed_template', $template_body_data);
        } else {
            $html .= $this->loadView('public/feeds-templates/tiktok/template1', $template_body_data);
        }

        $html .= $this->loadView('public/feeds-templates/tiktok/footer', array(
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
}
