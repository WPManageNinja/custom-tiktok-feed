<?php

namespace CustomFeedForTiktok\Application\Services\Widgets\Beaver;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class BeaverWidget
{

    public function __construct()
    {
        add_action( 'init', array($this, 'setup_hooks') );
    }

    public function setup_hooks() {
        if ( ! class_exists( 'FLBuilder' ) ) {
            return;
        }

        // Load custom modules.
        $this->init_widgets();
    }

    public function init_widgets()
    {
        if ( file_exists( CUSTOM_FEED_FOR_TIKTOK_DIR.'app/Services/Widgets/Beaver/TikTok/TikTokWidget.php' ) ) {
            require_once CUSTOM_FEED_FOR_TIKTOK_DIR.'app/Services/Widgets/Beaver/TikTok/TikTokWidget.php';
        }
    }

}
