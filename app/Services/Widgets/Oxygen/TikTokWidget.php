<?php
namespace NinjaTiktokFeed\Application\Services\Widgets\Oxygen;
use WPSocialReviews\App\Hooks\Handlers\ShortcodeHandler;
use WPSocialReviews\App\Services\Widgets\Helper;

class TikTokWidget extends OxygenEl
{
    public $css_added = false;

    function name() {
        return __( "TikTok", 'wp-social-reviews' );
    }

    function slug() {
        return "tiktok_widget";
    }

    function accordion_button_place() {
        return "tiktok";
    }

    function icon() {
        return '';
    }

    function controls() {
        /*****************************
         * template list
         *****************************/
        $platforms = ['tiktok'];
        $templates = Helper::getTemplates($platforms);
        $templates_control = $this->addOptionControl(
            array(
                'type' 		=> 'dropdown',
                'name' 		=> __('Select Template' , "wp-social-reviews"),
                'slug' 		=> 'wpsr_tiktok',
                'value' 	=> $templates,
                'default' 	=> "no",
                "css" 		=> false
            )
        );
        $templates_control->rebuildElementOnChange();

        /*****************************
         * Header
         *****************************/
        $tiktok_header_section = $this->addControlSection( "wpsr_tiktok_header_section", __("Header", "wp-social-reviews"), "assets/icon.png", $this );

        /*****************************
         * Header username
         *****************************/
        $tiktok_header_un = $tiktok_header_section->addControlSection( "wpsr_tiktok_header_username_section", __("Username", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_header_un->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        /*****************************
         * Header description
         *****************************/
        $tiktok_header_des = $tiktok_header_section->addControlSection( "wpsr_tiktok_header_des_section", __("Description", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_header_des->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p',
                    "property" 			=> 'line-height',
                )
            )
        );

        /*****************************
         * Header statistics
         *****************************/
        $tiktok_header_stat = $tiktok_header_section->addControlSection( "wpsr_tiktok_header_stat_section", __("Statistics", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_header_stat->addStyleControls(
            array(
                array(
                    "name" 				=> __('Text Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics span',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics span',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics span',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics span',
                    "property" 			=> 'line-height',
                )
            )
        );

        /*****************************
         * Header Box
         *****************************/
        $tiktok_header_box = $tiktok_header_section->addControlSection( "wpsr_tiktok_header_box_section", __("Box", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_header_box->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper',
                    "property" 			=> 'background-color'
                )
            )
        );

        $tiktok_header_box->addPreset(
            "padding",
            "wpsr_tiktok_header_box_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper'
        )->whiteList();

        $tiktok_header_box->addPreset(
            "margin",
            "wpsr_tiktok_header_box_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper'
        )->whiteList();

        $tiktok_header_box->addPreset(
            "border",
            "wpsr_tiktok_header_box_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper'
        )->whiteList();

        $tiktok_header_box->addPreset(
            "border-radius",
            "wpsr_tiktok_header_box_border_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper'
        )->whiteList();


        /*****************************
         * Content
         *****************************/
        $tiktok_content_section = $this->addControlSection( "wpsr_tiktok_content_section", __("Content", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_content_section->typographySection( __('Post Text'), '.wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-description-link a', $this );
        $tiktok_content_section->addPreset(
            "padding",
            "wpsr_tiktok_content_padding",
            __("Padding", "wp-social-reviews"),
            '.wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-description-link a'
        )->whiteList();

        $tiktok_author_section = $tiktok_content_section->addControlSection( "wpsr_tiktok_author_section", __("Author", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_author_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link a, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-link a',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link a, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-link a',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link a, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-link a',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link a, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-link a',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link a, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-link a',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );

        $tiktok_date_section = $tiktok_content_section->addControlSection( "wpsr_tiktok_date_section", __("Date", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_date_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link .wpsr-feed-avatar-right .wpsr-tiktok-feed-time, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-tiktok-feed-time',
                    "property" 			=> 'color',
                ),
                array(
                    "name" 				=> __('Font Size', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link .wpsr-feed-avatar-right .wpsr-tiktok-feed-time, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-tiktok-feed-time',
                    "property" 			=> 'font-size',
                    'control_type' 		=> 'slider-measurebox'
                ),
                array(
                    "name" 				=> __('Font Weight', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link .wpsr-feed-avatar-right .wpsr-tiktok-feed-time, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-tiktok-feed-time',
                    "property" 			=> 'font-weight',
                ),
                array(
                    "name" 				=> __('Line Height', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link .wpsr-feed-avatar-right .wpsr-tiktok-feed-time, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-tiktok-feed-time',
                    "property" 			=> 'line-height',
                ),
                array(
                    "name" 				=> __('Bottom Spacing', "wp-social-reviews"),
                    "selector" 			=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link .wpsr-feed-avatar-right .wpsr-tiktok-feed-time, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-tiktok-feed-time',
                    "property" 			=> 'margin-bottom',
                    "control_type" 		=> 'slider-measurebox',
                    'unit' 				=> 'px'
                )
            )
        );


        /*****************************
         *follow btn
         *****************************/
        $tiktok_follow_section = $this->addControlSection( "wpsr_tiktok_follow_section", __("Follow Button", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_follow_section_fz = $tiktok_follow_section->addStyleControl(
            array(
                "name" 				=> __('Font Size', "wp-social-reviews"),
                "selector" 			=> '.wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a',
                "property" 			=> 'font-size',
                'control_type' 		=> 'slider-measurebox'
            )
        );
        $tiktok_follow_section_fz->setRange('5', '100', '1');
        $tiktok_follow_section_fz->setUnits('px', 'px,%,em');

        $tiktok_follow_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a',
                    "property" 			=> 'color'
                )
            )
        );
        $tiktok_follow_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> '.wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a',
                    "property" 			=> 'background-color'
                )
            )
        );
        $tiktok_follow_section->addPreset(
            "padding",
            "wpsr_tiktok_header_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a'
        )->whiteList();

        /*****************************
         * Pagination
         *****************************/
        $pagination_section = $this->addControlSection( "wpsr_tiktok_pagination_section", __("Pagination", "wp-social-reviews"), "assets/icon.png", $this );
        $pagination_section->typographySection( __('Typography'), '.wpsr_more', $this );
        $pagination_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=>  '.wpsr_more',
                    "property" 			=> 'background-color'
                )
            )
        );

        $pagination_section->addPreset(
            "padding",
            "wpsr_tiktok_pagination_padding",
            __("Padding", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section->addPreset(
            "margin",
            "wpsr_tiktok_pagination_margin",
            __("Margin", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section_border = $pagination_section->addControlSection( "wpsr_tiktok_pagination_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $pagination_section_border->addPreset(
            "border",
            "wpsr_tiktok_pagination_border",
            __("Border", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        $pagination_section_border->addPreset(
            "border-radius",
            "wpsr_tiktok_pagination_radius",
            __("Border Radius", 'wp-social-reviews'),
            '.wpsr_more'
        )->whiteList();

        /*****************************
         * Box
         *****************************/
        $tiktok_box_section = $this->addControlSection( "wpsr_tiktok_box_section", __("Item Box", "wp-social-reviews"), "assets/icon.png", $this );
        $selector = '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-inner';
        $tiktok_box_section->addStyleControls(
            array(
                array(
                    "name" 				=> __('Background Color','wp-social-reviews'),
                    "selector" 			=> $selector,
                    "property" 			=> 'background-color'
                )
            )
        );
        $tiktok_box_sp = $tiktok_box_section->addControlSection( "wpsr_tiktok_box_sp_section", __("Spacing", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_box_sp->addPreset(
            "padding",
            "tiktok_box_padding",
            __("Padding", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $tiktok_box_sp->addPreset(
            "margin",
            "tiktok_box_margin",
            __("Margin", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $tiktok_box_border = $tiktok_box_section->addControlSection( "wpsr_tiktok_box_border_section", __("Border", "wp-social-reviews"), "assets/icon.png", $this );
        $tiktok_box_border->addPreset(
            "border",
            "tiktok_box_border",
            __("Border", 'wp-social-reviews'),
            $selector
        )->whiteList();

        $tiktok_box_border->addPreset(
            "border-radius",
            "tiktok_box_radius",
            __("Border Radius", 'wp-social-reviews'),
            $selector
        )->whiteList();
    }

    function render( $options, $defaults, $content ) {
        if( $options['wpsr_tiktok'] == "no" ) {
            echo '<h5 class="wpsr-template-missing">' . __("Select a template", 'wp-social-reviews') . '</h5>';
            return;
        }

        if(isset($options['selector'])){
            $this->save_meta($options['selector']);
        }

        if ( function_exists('do_oxygen_elements') ) {
            echo do_oxygen_elements('[wp_social_ninja id="'. $options['wpsr_tiktok'] .'" platform="tiktok"]');
        } else {
            echo do_shortcode('[wp_social_ninja id="'. $options['wpsr_tiktok'] .'" platform="tiktok"]');
        }
    }

    function init() {
        $this->El->useAJAXControls();
        if ( isset( $_GET['ct_builder'] ) ) {
            wp_enqueue_style(
                'wp_social_ninja_tt',
                WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_tt.css',
                array(),
                WPSOCIALREVIEWS_VERSION
            );
            wp_enqueue_script('wp-social-review');
            add_action('wp_footer', array(new ShortcodeHandler(), 'loadLocalizeScripts'), 99);
            if(defined('WPSOCIALREVIEWS_PRO')){
                wp_enqueue_style(
                    'swiper',
                    WPSOCIALREVIEWS_PRO_URL . 'assets/libs/swiper/swiper-bundle.min.css',
                    array(),
                    WPSOCIALREVIEWS_VERSION
                );
            }
        }
    }

    function enablePresets() {
        return true;
    }

    function enableFullPresets() {
        return true;
    }

    function customCSS( $options, $selector ) {

    }
}
new TikTokWidget();