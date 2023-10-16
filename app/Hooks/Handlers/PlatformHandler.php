<?php

namespace WPNinjaTiktokFeed\App\Hooks\Handlers;


use WPNinjaTiktokFeed\App\Services\Platforms\Feeds\Tiktok\TiktokFeed;



class PlatformHandler
{
    public function register()
    {
        if(defined('WPSOCIALREVIEWS_VERSION') ){
            (new TiktokFeed())->registerHooks();
        }
    }
}