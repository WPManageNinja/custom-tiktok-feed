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
 * @var $app NinjaTiktokFeed\App\Application
 */

/*******
 *
 * Tiktok feed templates action hooks
 *
 *******/

(new \WPNinjaTiktokFeed\App\Hooks\Handlers\PlatformHandler())->register();

$app->addAction('ninja_tiktok_feed/tiktok_feed_template_item_wrapper_before', 'WPNinjaTiktokFeed\App\Hooks\Handlers\TiktokTemplateHandler@renderTemplateItemWrapper');
$app->addAction('ninja_tiktok_feed/tiktok_feed_author', 'WPNinjaTiktokFeed\App\Hooks\Handlers\TiktokTemplateHandler@renderFeedAuthor', 10, 3);
$app->addAction('ninja_tiktok_feed/tiktok_feed_description', 'WPNinjaTiktokFeed\App\Hooks\Handlers\TiktokTemplateHandler@renderFeedDescription', 10, 2);
$app->addAction('ninja_tiktok_feed/tiktok_feed_media', 'WPNinjaTiktokFeed\App\Hooks\Handlers\TiktokTemplateHandler@renderFeedMedia', 10, 2);
$app->addAction('ninja_tiktok_feed/tiktok_feed_icon', 'WPNinjaTiktokFeed\App\Hooks\Handlers\TiktokTemplateHandler@renderFeedIcon', 10, 1);
$app->addAction('ninja_tiktok_feed/tiktok_feed_date', 'WPNinjaTiktokFeed\App\Hooks\Handlers\TiktokTemplateHandler@renderFeedDate');

$app->addAction('ninja_tiktok_feed/load_more_tiktok_button', 'WPNinjaTiktokFeed\App\Hooks\Handlers\TiktokTemplateHandler@renderLoadMoreButton', 10, 7);


$app->addAction('wp_ajax_wpsr_get_more_feeds', 'ShortcodeHandler@handleLoadMoreAjax');
$app->addAction('wp_ajax_nopriv_wpsr_get_more_feeds', 'ShortcodeHandler@handleLoadMoreAjax');
