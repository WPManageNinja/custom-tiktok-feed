<?php

namespace NinjaTiktokFeed\Application\Services\Platforms\Feeds\Tiktok;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Helper
{
    public static function  getConncetedSourceList()
    {
        $configs = get_option('wpsr_tiktok_connected_sources_config', []);
        $sourceList = Arr::get($configs, 'sources') ? $configs['sources'] : [];
        return $sourceList;
    }

    public static function getUserAccountInfo($settings = [])
    {
        $configs            = get_option('wpsr_tiktok_verification_configs', []);
        $account_to_show    = Arr::get($settings, 'header_settings.account_to_show', null);
        $connected_accounts = Arr::get($configs, 'connected_accounts', []);

        return Arr::get($connected_accounts, $account_to_show, []);
    }
}