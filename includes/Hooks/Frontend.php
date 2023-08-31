<?php

namespace WPNinjaTiktokFeed\Hooks;

if (!defined('ABSPATH')) {
    exit;
}

class Frontend
{
    public function __construct()
    {
        //code goes here
    }

    public function loadView($fileName, $data)
    {
        // normalize the filename
        $fileName = str_replace(array('../', './'), '', $fileName);
        $basePath = NINJA_TIKTOK_FEED_DIR . 'includes/views/';

        $filePath = $basePath . $fileName . '.php';

        extract($data);
        ob_start();
        include $filePath;

        return ob_get_clean();
    }
}
