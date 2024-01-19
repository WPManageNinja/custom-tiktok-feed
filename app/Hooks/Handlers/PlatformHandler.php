<?php

namespace CustomTiktokFeed\Application\Hooks\Handlers;

use CustomTiktokFeed\Application\Services\Platforms\Feeds\Tiktok\TiktokFeed;

class PlatformHandler
{
    public function register()
    {
        if(defined('WPSOCIALREVIEWS_VERSION') ){
            (new TiktokFeed())->registerHooks();
        }
    }
}