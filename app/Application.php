<?php

namespace CustomTiktokFeed\Application;

class Application
{
    public function __construct($app)
    {
        $this->boot($app);
    }

    public function boot($app)
    {
        $router = $app->router;

        require_once CUSTOM_TIKTOK_FEED_DIR . 'app/Hooks/actions.php';
        require_once CUSTOM_TIKTOK_FEED_DIR . 'app/Hooks/filters.php';
        require_once CUSTOM_TIKTOK_FEED_DIR . 'app/Http/Routes/api.php';
    }
}