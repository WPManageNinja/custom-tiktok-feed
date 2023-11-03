<?php

namespace NinjaTiktokFeed\Application\Hooks\Handlers;


use NinjaTiktokFeed\Application\Services\Platforms\Feeds\Tiktok\TiktokFeed;



class PlatformHandler
{
    public function register()
    {
        if(defined('WPSOCIALREVIEWS_VERSION') ){
            (new TiktokFeed())->registerHooks();
        }
    }
}