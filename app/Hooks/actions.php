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
 * @var $app NinjaTiktokFeed\Application\Application
 */

/*******
 *
 * Tiktok feed templates action hooks
 *
 *******/

(new \NinjaTiktokFeed\Application\Hooks\Handlers\PlatformHandler())->register();

$app->addAction('ninja_tiktok_feed/tiktok_feed_template_item_wrapper_before', 'NinjaTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderTemplateItemWrapper');
$app->addAction('ninja_tiktok_feed/tiktok_feed_author', 'NinjaTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderFeedAuthor', 10, 2);
$app->addAction('ninja_tiktok_feed/tiktok_feed_description', 'NinjaTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderFeedDescription', 10, 2);
$app->addAction('ninja_tiktok_feed/tiktok_feed_media', 'NinjaTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderFeedMedia', 10, 2);
$app->addAction('ninja_tiktok_feed/tiktok_feed_icon', 'NinjaTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderFeedIcon', 10, 1);

$app->addAction('ninja_tiktok_feed/load_more_tiktok_button', 'NinjaTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@renderLoadMoreButton', 10, 7);


$app->addAction('wp_ajax_wpsr_get_more_feeds', 'ShortcodeHandler@handleLoadMoreAjax');
$app->addAction('wp_ajax_nopriv_wpsr_get_more_feeds', 'ShortcodeHandler@handleLoadMoreAjax');
$app->addAction('ninja_tiktok_feed/load_tiktok_view', 'NinjaTiktokFeed\Application\Hooks\Handlers\TiktokTemplateHandler@loadTikTokView', 10, 2);


/*
 * Oxygen Widget Init
 */
if (class_exists('OxyEl') ) {
    if ( file_exists( NINJA_TIKTOK_FEED_DIR.'app/Services/Widgets/Oxygen/OxygenWidget.php' ) ) {
        new NinjaTiktokFeed\Application\Services\Widgets\Oxygen\OxygenWidget();
    }
}

/*
 * Elementor Widget Init
 */
if (defined('ELEMENTOR_VERSION')) {
    new NinjaTiktokFeed\Application\Services\Widgets\ElementorWidget();
}


/*
 * Beaver Builder Widget Init
 */
if ( class_exists( 'FLBuilder' ) ) {
    new NinjaTiktokFeed\Application\Services\Widgets\Beaver\BeaverWidget();
}


add_action('rest_api_init', function () use ($app)  {
    register_rest_route('wpsocialreviews', '/tiktok_callback/', array(
        'methods'             => 'GET',
        'callback'            => function (\WP_REST_Request $request) use ($app) {
            $code = $request->get_param('code');
            if (isset($code)) {
                $filename = 'admin/html_code';
                $data = [
                    'code' => $code
                ];
                do_action('ninja_tiktok_feed/load_tiktok_view', $filename, $data);

                die();
            } else {
                return rest_ensure_response(array(
                    'success' => false,
                    'message' => 'An error occurred while retrieving the access code. Please try again later.'
                ));
                die();
            }
        },
        'permission_callback' => function() {
            if(current_user_can('manage_options')) {
                return false;
            }
            return true;
        }
    ));
});