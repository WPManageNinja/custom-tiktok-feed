<?php

!defined('WPINC') && die;

define('CUSTOM_TIKTOK_FEED_VERSION', '1.0.0');
define('CUSTOM_TIKTOK_FEED', true);
define('CUSTOM_TIKTOK_FEED_URL', plugin_dir_url(__FILE__));
define('CUSTOM_TIKTOK_FEED_DIR', plugin_dir_path(__FILE__));

spl_autoload_register(function ($class){
    $match = 'CustomTiktokFeed';
    if ( ! preg_match("/\b{$match}\b/", $class)) {
        return;
    }
    $path = plugin_dir_path(__FILE__);

    $file = str_replace(
        ['CustomTiktokFeed', '\\', '/Application/'],
        ['', DIRECTORY_SEPARATOR, 'app/'],
        $class
    );

    $filePath = (trailingslashit($path) . trim($file, '/') . '.php');
    if (file_exists($filePath)) {
        require $filePath;
    }
});

class CustomTiktokFeedDependency
{
    public function init()
    {
        $this->injectDependency();
    }

    /**
     * Notify the user about the WP Social Ninja dependency and instructs to install it.
     */
    protected function injectDependency()
    {
        add_action('admin_notices', function () {
            $pluginInfo = $this->getBasePluginInstallationDetails();

            $class = 'notice notice-error';

            $install_url_text = __('Click Here to Install the Plugin', 'custom-tiktok-feed');

            if ($pluginInfo->action == 'activate') {
                $install_url_text = __('Click Here to Activate the Plugin', 'custom-tiktok-feed');
            }

            $message = 'Custom TikTok Feed Requires WP Social Ninja Base Plugin, <b><a href="' . $pluginInfo->url
                . '">' . $install_url_text . '</a></b>';

            printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), $message);
        });
    }

    /**
     * Get the WP Social Ninja plugin installation information e.g. the URL to install.
     *
     * @return \stdClass $activation
     */
    protected function getBasePluginInstallationDetails()
    {
        $activation = (object)[
            'action' => 'install',
            'url'    => ''
        ];

        $allPlugins = get_plugins();

        $plugin_path = 'wp-social-reviews/wp-social-reviews.php';

        if (isset($allPlugins[$plugin_path])) {
            $url = wp_nonce_url(
                self_admin_url('plugins.php?action=activate&plugin=' . $plugin_path . ''),
                'activate-plugin_' . $plugin_path . ''
            );

            $activation->action = 'activate';
        } else {
            $api = (object)[
                'slug' => 'wp-social-reviews'
            ];

            $url = wp_nonce_url(
                self_admin_url('update.php?action=install-plugin&plugin=' . $api->slug),
                'install-plugin_' . $api->slug
            );
        }
        $activation->url = $url;

        return $activation;
    }
}

add_action('init', function ($app) {
    if( !defined('WPSOCIALREVIEWS_VERSION') ){
        (new CustomTiktokFeedDependency())->init();
    }
});

