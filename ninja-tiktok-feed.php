<?php
/*
Plugin Name:  Custom TikTok Feed
Plugin URI:   https://wpsocialninja.com/
Description:  Create eye-catchy and responsive TikTok feed on your WordPress website.
Version:      1.0.0
Author:       Social Feed - WP Social Ninja Team
Author URI:   https://wpsocialninja.com/
License:      GPLv2 or later
Text Domain:  ninja-tiktok-feed
Domain Path:  /language
*/

if (defined('NINJA_TIKTOK_FEED_MAIN_FILE')) {
    return;
}

define('NINJA_TIKTOK_FEED_MAIN_FILE', __FILE__);

require_once('ninja-tiktok-feed-boot.php');

add_action('wp_social_reviews_loaded_v2', function ($app) {
    (new \NinjaTiktokFeed\Application\Application($app));
    do_action('ninja_tiktok_feed_loaded', $app);
});

add_action('init', function () {
    load_plugin_textdomain('ninja-tiktok-feed', false, basename(dirname(__FILE__)) . '/language');
});


