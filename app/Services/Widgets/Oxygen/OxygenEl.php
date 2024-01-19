<?php
namespace CustomTiktokFeed\Application\Services\Widgets\Oxygen;


if (!class_exists('OxyEl') ) {
    return;
}

class OxygenEl extends \OxyEl
{
    function init()
    {
        $this->El->useAJAXControls();
    }

    function class_names()
    {
        return array('wpsr-oxy-element');
    }

    function button_place()
    {
        $button_place = $this->accordion_button_place();

        if( $button_place )
            return "wpsocialninja::" . $button_place;

        return "";
    }

    function button_priority()
    {
        return '';
    }

    function isBuilderEditorActive()
    {
        if( isset($_GET['oxygen_iframe']) || defined('OXY_ELEMENTS_API_AJAX') ) {
            return true;
        }

        return false;
    }

    function save_meta($options)
    {
        $selector = explode('-', $options);
        $platform_name[] = explode('_', $selector[1])[0];
        $postId = $selector[3];

        $shortcodeIds = get_post_meta($postId, '_wpsn_ids', true);

        if($platform_name && $shortcodeIds){
            $platform_name  = array_merge($shortcodeIds, $platform_name);
            $platform_name = array_keys(array_flip($platform_name));
        }

        if($shortcodeIds != $platform_name) {
            update_post_meta($postId, '_wpsn_ids', $platform_name);
        }

    }
}