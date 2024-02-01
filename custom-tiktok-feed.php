<?php
/*
Plugin Name:  Custom TikTok Feed
Plugin URI:   https://github.com/WPManageNinja/custom-tiktok-feed
Description:  Create eye-catchy and responsive TikTok feed on your WordPress website.
Version:      1.0.0
Author:       Social Feed - WP Social Ninja Team
Author URI:   https://github.com/devutpol
License:      GPLv2 or later
Text Domain:  custom-tiktok-feed
Domain Path:  /language
*/

if (defined('CUSTOM_TIKTOK_FEED_MAIN_FILE')) {
    return;
}

define('CUSTOM_TIKTOK_FEED_MAIN_FILE', __FILE__);

require_once(plugin_dir_path(__FILE__) . 'custom-tiktok-feed-boot.php');

add_action('wp_social_reviews_loaded_v2', function ($app) {
    (new \CustomTiktokFeed\Application\Application($app));
    do_action('custom_tiktok_feed_loaded', $app);
});

add_action('init', function () {
    load_plugin_textdomain('custom-tiktok-feed', false, basename(dirname(__FILE__)) . '/language');
});


