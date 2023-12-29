<?php

namespace NinjaTiktokFeed\Application\Services\Widgets;
use Elementor\Plugin as Elementor;

class ElementorWidget
{
    public function __construct()
    {
        add_action( 'elementor/frontend/after_register_styles', [$this, 'registerAssets'], 10);
        add_action( 'elementor/frontend/after_enqueue_styles', [$this, 'enqueueAssets'], 10);
        add_action( 'elementor/widgets/register', [$this, 'init_widgets'] );
        add_action( 'elementor/init', [ $this, 'elementor_init' ] );
    }

    public function elementor_init() {
        // Add element category in panel
        Elementor::instance()->elements_manager->add_category(
            'wp-social-reviews',
            [
                'title' => __( 'WP Social Ninja', 'wp-social-reviews' ),
                'icon' => 'font',
            ],
            1
        );
    }

    public function enqueueAssets()
    {
        global $post;
        $post_id = isset($post) && isset($post->ID) ? $post->ID : null;

        $wpsn_elementor_ids = get_post_meta($post_id, '_wpsn_elementor_ids', true);

        $styles = [
            'tiktok'        => 'tt',
        ];

        foreach ($styles as $style){
            if(!empty($wpsn_elementor_ids) && in_array($style, $wpsn_elementor_ids)){
                wp_enqueue_style('wp_social_ninja_'.$style);
            }
        }
    }

    public function init_widgets()
    {
        $widgets_manager = Elementor::instance()->widgets_manager;
        if ( file_exists( NINJA_TIKTOK_FEED_DIR.'app/Services/Widgets/TikTokWidget.php' ) ) {
            require_once NINJA_TIKTOK_FEED_DIR.'app/Services/Widgets/TikTokWidget.php';
            $widgets_manager->register( new TikTokWidget() );
        }
    }

    public function registerAssets()
    {
        wp_register_style(
            'wp_social_ninja_tt',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_tt.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );
    }
}
