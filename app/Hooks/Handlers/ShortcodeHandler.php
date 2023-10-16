<?php

namespace WPNinjaTiktokFeed\App\Hooks\Handlers;
use WPSocialReviews\Framework\Support\Arr;
use WPSocialReviews\App\Services\Platforms\Feeds\Config;


class ShortcodeHandler
{
    public function templateMeta($templateId, $platform)
    {
        $encodedMeta = get_post_meta($templateId, '_wpsr_template_config', true);
        $template_meta = json_decode($encodedMeta, true);
        if (!$template_meta || empty($template_meta)) {
            return ['error_message' => __('No template is available for this shortcode!!', 'wp-social-reviews')];
        }
        $error_message = __('Please set a template platform name on your shortcode', 'wp-social-reviews');
        if ($platform === 'reviews' || $platform === 'testimonial') {
            $template_meta = Helper::formattedTemplateMeta($template_meta);
            if (empty($template_meta['platform'])) {
                return [
                    'error_message' => $error_message
                ];
            }
        } elseif ($platform === 'twitter') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatTwitterConfig($configs, []);
        } elseif ($platform === 'youtube') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatYoutubeConfig($configs, []);
        } elseif ($platform === 'instagram') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatInstagramConfig($configs, []);
        } elseif ($platform === 'facebook_feed') {
            $configs = Arr::get($template_meta, 'feed_settings', []);
            $template_meta = Config::formatFacebookConfig($configs, []);
        }

        if (($platform !== 'reviews' && $platform !== 'testimonial') && !Arr::get($template_meta, 'feed_settings.platform')) {
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

        if ($platform === 'twitter') {
            $header = Arr::get($feed, 'header', []);
            $layout_type = Arr::get($feed_settings, 'layout_type', 'standard');
        } else {
            $header = Arr::get($dynamic, 'header', []);
            $layout_type = Arr::get($feed_settings, 'layout_type', 'grid');
        }

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
