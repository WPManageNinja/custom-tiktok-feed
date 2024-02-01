<?php

namespace CustomFeedForTiktok\Application\Traits;

Trait LoadView
{
    public function loadView($fileName, $data)
    {
        // normalize the filename
        $fileName = str_replace(array('../', './'), '', $fileName);
        $basePath = CUSTOM_FEED_FOR_TIKTOK_DIR . 'app/Views/';


        $filePath = $basePath . $fileName . '.php';

        extract($data);
        ob_start();
        include $filePath;

        return ob_get_clean();
    }
}