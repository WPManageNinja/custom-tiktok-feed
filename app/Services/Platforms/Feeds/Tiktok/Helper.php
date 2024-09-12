<?php

namespace CustomFeedForTiktok\Application\Services\Platforms\Feeds\Tiktok;

use WPSocialReviews\Framework\Support\Arr;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Helper
{
    public static function getConnectedSourceList()
    {
        $configs = get_option('wpsr_tiktok_connected_sources_config', []);
        $sourceList = Arr::get($configs, 'sources') ? $configs['sources'] : [];
        return $sourceList;
    }
}