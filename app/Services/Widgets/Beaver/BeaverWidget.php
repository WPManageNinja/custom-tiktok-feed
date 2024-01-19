<?php

namespace CustomTiktokFeed\Application\Services\Widgets\Beaver;


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
        if ( file_exists( CUSTOM_TIKTOK_FEED_DIR.'app/Services/Widgets/Beaver/TikTok/TikTokWidget.php' ) ) {
            require_once CUSTOM_TIKTOK_FEED_DIR.'app/Services/Widgets/Beaver/TikTok/TikTokWidget.php';
        }
    }

}
