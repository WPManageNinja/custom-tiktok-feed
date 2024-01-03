<?php
namespace NinjaTiktokFeed\Application\Services\Widgets\Oxygen;

if (!class_exists('OxyEl') ) {
    return;
}

class OxygenWidget
{
    public function __construct()
    {
        add_action('init', array($this, 'initWidgets'));
        add_action('oxygen_add_plus_wpsocialninja_section_content', array($this, 'registerAddPlusSubsections'));
    }

    public function initWidgets()
    {
        if ( file_exists( NINJA_TIKTOK_FEED_DIR.'app/Services/Widgets/Oxygen/TikTokWidget.php' ) ) {
            require_once NINJA_TIKTOK_FEED_DIR.'app/Services/Widgets/Oxygen/TikTokWidget.php';
        }
    }

    public function registerAddPlusSubsections()
    {
        do_action("oxygen_add_plus_wpsocialninja_tiktok");
    }
}