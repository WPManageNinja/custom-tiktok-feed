<?php
/**
 * All registered filter's handlers should be in app\Hooks\Handlers,
 * addFilter is similar to add_filter and addCustomFlter is just a
 * wrapper over add_filter which will add a prefix to the hook name
 * using the plugin slug to make it unique in all wordpress plugins,
 * ex: $app->addCustomFilter('foo', ['FooHandler', 'handleFoo']) is
 * equivalent to add_filter('slug-foo', ['FooHandler', 'handleFoo']).
 */

/**
 * $app
 * @var $app CustomTiktokFeed\Application\Application
 */

// tiktok feed hooks
$app->addFilter('wpsocialreviews/get_paginated_feed_html', 'CustomTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@getPaginatedFeedHtml', 10, 2);
$app->addFilter('wpsocialreviews/render_tiktok_template', 'CustomTiktokFeed\Application\Hooks\Handlers\ShortcodeHandler@renderTiktokTemplate', 10, 2);
$app->addFilter('wpsocialreviews/format_tiktok_config', 'CustomTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@formatTiktokConfig', 10, 2);