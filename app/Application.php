<?php

namespace CustomFeedForTiktok\Application;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

class Application
{
    public function __construct($app)
    {
        $this->boot($app);
    }

    public function boot($app)
    {
        $router = $app->router;

        require_once CUSTOM_FEED_FOR_TIKTOK_DIR . 'app/Hooks/actions.php';
        require_once CUSTOM_FEED_FOR_TIKTOK_DIR . 'app/Hooks/filters.php';
        require_once CUSTOM_FEED_FOR_TIKTOK_DIR . 'app/Http/Routes/api.php';
    }
}