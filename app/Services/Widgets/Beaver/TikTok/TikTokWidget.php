<?php
use WPSocialReviews\App\Services\Widgets\Helper;
/**
 * This is an example module with only the basic
 * setup necessary to get it working.
 *
 * @class WPSR_Fl_TikTok_Module
 */
class WPSR_Fl_TikTok_Module extends FLBuilderModule {

    /**
     * Constructor function for the module. You must pass the
     * name, description, dir and url in an array to the parent class.
     *
     * @method __construct
     */
    public function __construct()
    {
        parent::__construct(array(
            'name'          => __('TikTok Feeds', 'wp-social-reviews'),
            'description'   => '',
            'category'		=> __('WP Social Ninja', 'wp-social-reviews'),
            'dir'           => NINJA_TIKTOK_FEED_DIR . 'app/Services/Widgets/Beaver/TikTok/',
            'url'           => NINJA_TIKTOK_FEED_URL . 'app/Services/Widgets/Beaver/TikTok/',
            'editor_export' => true, // Defaults to true and can be omitted.
            'enabled'       => true, // Defaults to true and can be omitted.
            'partial_refresh' => true, // Set this to true to enable partial refresh.
        ));

        $this->add_css(
            'wp_social_ninja_tt',
            WPSOCIALREVIEWS_URL . 'assets/css/wp_social_ninja_tt.css',
            array(),
            WPSOCIALREVIEWS_VERSION
        );
        if(defined('WPSOCIALREVIEWS_PRO')){
            $this->add_css(
                'swiper',
                WPSOCIALREVIEWS_PRO_URL . 'assets/libs/swiper/swiper-bundle.min.css',
                array(),
                WPSOCIALREVIEWS_VERSION
            );
        }
    }
}

/**
 * Register the module and its form settings.
 */
FLBuilder::register_module('WPSR_Fl_TikTok_Module', array(
    'general'       => array( // Tab
        'title'         => __('General', 'wp-social-reviews'), // Tab title
        'sections'      => array( // Tab Sections
            'general'       => array( // Section
                'title'     => '', // Section Title
                'fields' => array( // Section Fields
                    'template_id'  => array(
                        'type'         => 'select',
                        'label'        => __( 'Select a Template', 'wp-social-reviews' ),
                        'options'      => Helper::getTemplates(['tiktok'])
                    ),
                )
            )
        )
    ),
    'style'   => array(
        'title'    => __( 'Style', 'wp-social-reviews' ),
        'sections' => array(
            'header_style' => array(
                'title'  => __( 'Header', 'wp-social-reviews' ),
                'fields' => array(
                    'tt_header_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Header Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper',
                            'property'  => 'background',
                        ),
                    ),
                    'tt_header_account_name_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Account Name Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_header_description_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Description Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_header_statistics_count_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Statistics Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics p',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_header_account_name_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Account Name Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a'
                        )
                    ),
                    'tt_header_account_description_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Description Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p'
                        )
                    ),
                    'tt_header_account_statistics_counter_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Likes Counter Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics p'
                        )
                    ),
                ),
            ),
            'content_author_style' => array(
                'title'  => __( 'Post Author', 'wp-social-reviews' ),
                'fields' => array(
                    'tt_content_author_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link a, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-link a',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_content_author_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link a, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-link a'
                        )
                    ),
                ),
            ),
            'content_date_style' => array(
                'title'  => __( 'Post Date', 'wp-social-reviews' ),
                'fields' => array(
                    'tt_content_date_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link .wpsr-feed-avatar-right .wpsr-tiktok-feed-time, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-tiktok-feed-time',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_content_date_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-feed-link .wpsr-feed-avatar-right .wpsr-tiktok-feed-time, .wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-tiktok-feed-time'
                        )
                    ),
                ),
            ),
            'post_content_style' => array(
                'title'  => __( 'Post Text', 'wp-social-reviews' ),
                'fields' => array(
                    'tt_post_content_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-description-link a',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_post_content_rm_link_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Read More Link Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_post_content_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-tiktok-feed-statistics .wpsr-tiktok-icon-position .wpsr-feed-description-link a'
                        )
                    ),
                ),
            ),
            'follow_btn_style' => array(
                'title'  => __( 'Follow Button', 'wp-social-reviews' ),
                'fields' => array(
                    'tt_feed_follow_button_text_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Text Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_feed_follow_button_background_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a',
                            'property'  => 'background',
                        ),
                    ),
                    'tt_feed_follow_button_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a'
                        )
                    ),
                ),
            ),
            'load_more_style' => array(
                'title'  => __( 'Load More Button', 'wp-social-reviews' ),
                'fields' => array(
                    'tt_load_more_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_load_more_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'color',
                        ),
                    ),
                    'tt_load_more_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'tt_load_more_bg_hover_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Background Hover Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr_more',
                            'property'  => 'background',
                        ),
                    ),
                    'tt_load_more_typography'		=> array(
                        'type'					=> 'typography',
                        'label'					=> __('Typography', 'wp-social-reviews'),
                        'responsive'  			=> true,
                        'preview'				=> array(
                            'type'					=> 'css',
                            'selector'				=> '.wpsr_more'
                        )
                    ),
                ),
            ),
            'box_style' => array(
                'title'  => __( 'Box', 'wp-social-reviews' ),
                'fields' => array(
                    'tt_box_bg_color' => array(
                        'type'        => 'color',
                        'label'       => __( 'Box Background Color', 'wp-social-reviews' ),
                        'show_reset' => true,
                        'preview'     => array(
                            'type'      => 'css',
                            'selector'  => '.wpsr-tiktok-feed-item .wpsr-tiktok-feed-inner',
                            'property'  => 'background',
                        ),
                    ),
                ),
            ),
        ),
    ),
));