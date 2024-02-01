<?php

namespace CustomFeedForTiktok\Application\Hooks\Handlers;

use CustomFeedForTiktok\Application\Services\Platforms\Feeds\Tiktok\TiktokFeed;

class PlatformHandler
{
    public function register()
    {
        if(defined('WPSOCIALREVIEWS_VERSION') ){
            (new TiktokFeed())->registerHooks();
        }
    }
}