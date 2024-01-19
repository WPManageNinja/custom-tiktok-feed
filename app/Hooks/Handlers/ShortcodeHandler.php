<?php

namespace CustomTiktokFeed\Application\Hooks\Handlers;
use CustomTiktokFeed\Application\Services\Platforms\Feeds\Tiktok\TiktokFeed;
use WPSocialReviews\App\Services\GlobalSettings;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler as BaseShortCodeHandler;
use WPSocialReviews\Framework\Support\Arr;
use CustomTiktokFeed\Application\Traits\LoadView;



class ShortcodeHandler
{
    use LoadView;
    public function renderTiktokTemplate($templateId, $platform)
    {
        if (defined('LSCWP_V')) {
            do_action('litespeed_tag_add', 'wpsn_purge_tiktok');
        }

        do_action('wpsocialreviews/before_display_tiktok_feed');
        $shortcodeHandler = new BaseShortCodeHandler();

        $template_meta = $shortcodeHandler->templateMeta($templateId, $platform);

        if (!empty($template_meta['error_message'])) {
            return $template_meta['error_message'] . '<br/>';
        }

        $feed = (new TiktokFeed())->getTemplateMeta($template_meta, $templateId);
        $settings      = $shortcodeHandler->formatFeedSettings($feed);

        $error_message = Arr::get($settings['dynamic'], 'error_message');
        if (Arr::get($error_message, 'error_message')) {
            return $error_message['error_message'];
        } elseif ($error_message) {
            return $error_message;
        }

        if (sizeof(Arr::get($settings, 'feeds')) === 0) {
            return '<p>' . __('Posts are not available!', 'custom-tiktok-feed') . '</p>';
        }

        //template mapping
        $templateMapping = [
            'template1' => 'public/feeds-templates/tiktok/template1',
        ];

        $template = Arr::get($settings['feed_settings'], 'template', '');
        if (!isset($templateMapping[$template])) {
            return '<p>' . __('No Templates found!! Please save and try again', 'custom-tiktok-feed') . '</p>';
        }

        $file = $templateMapping[$template];

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
                $feeds[$index]['time_ago'] = sprintf(__('%s ago'), human_time_diff($create_time));
            }
            $shortcodeHandler->makePopupModal($feeds, $settings['header'], $settings['feed_settings'], $templateId, $platform);
            $shortcodeHandler->enqueuePopupScripts();
        }

        $shortcodeHandler->enqueueScripts();
        do_action('wpsocialreviews/load_template_assets', $templateId);

        $html = '';

        $html .=  $this->loadView('public/feeds-templates/tiktok/header', array(
            'templateId'    => $templateId,
            'template'      => $template,
            'header'        => Arr::get($settings, 'header.data.user'),
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
