<?php

/**
 * All registered action's handlers should be in app\Hooks\Handlers,
 * addAction is similar to add_action and addCustomAction is just a
 * wrapper over add_action which will add a prefix to the hook name
 * using the plugin slug to make it unique in all wordpress plugins,
 * ex: $app->addCustomAction('foo', ['FooHandler', 'handleFoo']) is
 * equivalent to add_action('slug-foo', ['FooHandler', 'handleFoo']).
 */

/**
 * @var $app CustomTiktokFeed\Application\Application
 */

/*******
 *
 * Tiktok feed templates action hooks
 *
 *******/

(new \CustomTiktokFeed\Application\Hooks\Handlers\PlatformHandler())->register();

$app->addAction('custom_tiktok_feed/tiktok_feed_template_item_wrapper_before', 'CustomTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderTemplateItemWrapper');
$app->addAction('custom_tiktok_feed/tiktok_feed_author', 'CustomTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderFeedAuthor', 10, 2);
$app->addAction('custom_tiktok_feed/tiktok_feed_description', 'CustomTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderFeedDescription', 10, 2);
$app->addAction('custom_tiktok_feed/tiktok_feed_media', 'CustomTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderFeedMedia', 10, 2);
$app->addAction('custom_tiktok_feed/tiktok_feed_icon', 'CustomTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderFeedIcon', 10, 1);

$app->addAction('custom_tiktok_feed/load_more_tiktok_button', 'CustomTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderLoadMoreButton', 10, 7);


$app->addAction('wp_ajax_wpsr_get_more_feeds', 'ShortcodeHandler@handleLoadMoreAjax');
$app->addAction('wp_ajax_nopriv_wpsr_get_more_feeds', 'ShortcodeHandler@handleLoadMoreAjax');

/*
 * Oxygen Widget Init
 */
if (class_exists('OxyEl') ) {
    if ( file_exists( CUSTOM_TIKTOK_FEED_DIR.'app/Services/Widgets/Oxygen/OxygenWidget.php' ) ) {
        new CustomTiktokFeed\Application\Services\Widgets\Oxygen\OxygenWidget();
    }
}

/*
 * Elementor Widget Init
 */
if (defined('ELEMENTOR_VERSION')) {
    new CustomTiktokFeed\Application\Services\Widgets\ElementorWidget();
}

/*
 * Beaver Builder Widget Init
 */
if ( class_exists( 'FLBuilder' ) ) {
    new CustomTiktokFeed\Application\Services\Widgets\Beaver\BeaverWidget();
}