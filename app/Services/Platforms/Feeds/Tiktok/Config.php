<?php

namespace WPNinjaTiktokFeed\App\Services\Platforms\Feeds\Tiktok;

use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Config
{
    public function __construct()
    {

    }

    public function getStyleElement()
    {
        return array(
            'header' => array(
                'title' => __('Header', 'wp-social-reviews'),
                'key'  => 'header',
                array(
                    'title'     => __('User Name', 'wp-social-reviews'),
                    'key'      => 'user_name',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Bottom Spacing', 'wp-social-reviews'),
                    ),
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Description', 'wp-social-reviews'),
                    'key'      => 'description',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Bottom Spacing', 'wp-social-reviews'),
                    ),
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                    )
                ),
                array(
                    'title'     => __('Likes', 'wp-social-reviews'),
                    'key'      => 'likes',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                    )
                ),
                array(
                    'title'     => __('Box', 'wp-social-reviews'),
                    'key'      => 'header_box',
                    'divider' => false,
                    'typography' => false,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'content' => array(
                'title' => __('Content', 'wp-social-reviews'),
                'key'  => 'content',
                array(
                    'title'     => __('Author', 'wp-social-reviews'),
                    'key'      => 'author',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Post Date', 'wp-social-reviews'),
                    'key'      => 'post_date',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Event Date', 'wp-social-reviews'),
                    'key'      => 'event_date',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Post Title', 'wp-social-reviews'),
                    'key'      => 'post_title',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Event Title', 'wp-social-reviews'),
                    'key'      => 'event_title',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Event Location', 'wp-social-reviews'),
                    'key'      => 'event_location',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Event Statistics', 'wp-social-reviews'),
                    'key'      => 'event_statistics',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Album Meta', 'wp-social-reviews'),
                    'key'      => 'album_meta',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Album Breadcrumb', 'wp-social-reviews'),
                    'key'      => 'album_breadcrumb',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Post Text', 'wp-social-reviews'),
                    'key'      => 'post_content',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'key'      => 'link_color',
                    'divider' => false,
                    'typography' => false,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Link Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'key'      => 'read_more_link_color',
                    'divider' => false,
                    'typography' => false,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Read More Link Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Summary Card', 'wp-social-reviews'),
                    'key'      => 'summary_card',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Bottom Spacing', 'wp-social-reviews'),
                    ),
                    'styles' => array(
                        array(
                            'title'      => __('Domain Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'key'      => 'summary_card_title',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Bottom Spacing', 'wp-social-reviews'),
                    ),
                    'styles' => array(
                        array(
                            'title'      => __('Title Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'key'      => 'summary_card_description',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Description Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'like_and_share' => array(
                'title' => __('Like and Share Button', 'wp-social-reviews'),
                'key'  => 'like_and_share',
                array(
                    'key'      => 'like_and_share',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'pagination' => array(
                'title' => __('Pagination', 'wp-social-reviews'),
                'key'  => 'pagination',
                array(
                    'key'      => 'fb_pagination',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                    )
                )
            ),
            'item' => array(
                'title' => __('Item Box', 'wp-social-reviews'),
                'key'  => 'item_box',
                array(
                    'key'      => 'item_box',
                    'divider' => false,
                    'typography' => false,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Background Color:', 'wp-social-reviews'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
        );
    }

    public function formatStylesConfig($settings = [] , $postId = null)
    {
        $prefix = '.wpsr-fb-feed-template-'.$postId;
        return [
            'styles' => array(
                'user_name' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-name-wrapper a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.user_name.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.user_name.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.user_name.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.user_name.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.user_name.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.user_name.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.user_name.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.user_name.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.user_name.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.user_name.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.user_name.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.user_name.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.user_name.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.user_name.typography.text_decoration', ''),
                    ),
                    'slider'  => array(
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.user_name.slider.bottom.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.user_name.slider.bottom.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.user_name.slider.bottom.mobile', 0),
                        ),
                    ),
                ),
                'description' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-info-description p',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.description.color.text_color', ''),
                        'background_color' => Arr::get($settings,'styles.description.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.description.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.description.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.description.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.description.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.description.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.description.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.description.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.description.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.description.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.description.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.description.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.description.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.description.typography.text_decoration', ''),
                    ),
                    'slider'  => array(
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.description.slider.bottom.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.description.slider.bottom.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.description.slider.bottom.mobile', 0),
                        ),
                    ),
                ),
                'likes' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper .wpsr-fb-feed-user-info-head .wpsr-fb-feed-header-info .wpsr-fb-feed-user-info .wpsr-fb-feed-user-statistics span',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.likes.color.text_color', ''),
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.likes.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.likes.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.likes.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.likes.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.likes.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.likes.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.likes.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.likes.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.likes.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.likes.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.likes.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.likes.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.likes.typography.text_decoration', ''),
                    ),
                ),
                'header_box' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-header .wpsr-fb-feed-user-info-wrapper',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.header_box.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.header_box.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.header_box.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.header_box.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.header_box.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.header_box.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.header_box.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.header_box.border.border_color', ''),
                    ),
                ),
                'author' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-author .wpsr-fb-feed-author-info a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.author.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.author.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.author.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.author.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.author.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.author.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.author.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.author.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.author.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.author.typography.text_decoration', ''),
                    ),
                ),
                'post_date' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-author .wpsr-fb-feed-time , .wpsr-fb-feed-item .wpsr-fb-feed-video-info .wpsr-fb-feed-video-statistics .wpsr-fb-feed-video-statistic-item',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.post_date.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.post_date.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_date.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_date.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.post_date.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_date.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_date.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.post_date.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_date.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_date.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.post_date.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.post_date.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.post_date.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.post_date.typography.text_decoration', ''),
                    ),
                ),
                'event_date' => array(
                    'selector' => $prefix.'.wpsr-fb-event_feed .wpsr-fb-feed-item .wpsr-fb-events-feed-info .wpsr-fb-feed-time',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.event_date.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.event_date.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_date.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_date.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.event_date.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_date.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_date.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.event_date.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_date.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_date.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.event_date.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.event_date.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.event_date.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.event_date.typography.text_decoration', ''),
                    ),
                ),
                'post_title' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-item .wpsr-fb-feed-video-info h3 a, '. $prefix.'.wpsr-fb-album_feed .wpsr-fb-feed-item .wpsr-fb-feed-album-name, '. $prefix.'.wpsr-fb-album_feed .wpsr-fb-feed-album-header .wpsr-fb-feed-album-name',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.post_title.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.post_title.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_title.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_title.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.post_title.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_title.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_title.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.post_title.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_title.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_title.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.post_title.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.post_title.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.post_title.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.post_title.typography.text_decoration', ''),
                    ),
                ),
                'event_title' => array(
                    'selector' => $prefix.'.wpsr-fb-event_feed .wpsr-fb-feed-item .wpsr-fb-feed-event-name h4',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.event_title.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.event_title.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_title.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_title.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.event_title.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_title.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_title.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.event_title.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_title.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_title.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.event_title.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.event_title.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.event_title.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.event_title.typography.text_decoration', ''),
                    ),
                ),
                'event_location' => array(
                    'selector' => $prefix.'.wpsr-fb-event_feed .wpsr-fb-feed-item .wpsr-fb-feed-event-place',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.event_location.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.event_location.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_location.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_location.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.event_location.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_location.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_location.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.event_location.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_location.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_location.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.event_location.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.event_location.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.event_location.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.event_location.typography.text_decoration', ''),
                    ),
                ),
                'event_statistics' => array(
                    'selector' => $prefix.'.wpsr-fb-event_feed .wpsr-fb-feed-item .wpsr-fb-feed-event-count',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.event_statistics.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.event_statistics.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_statistics.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_statistics.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.event_statistics.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_statistics.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_statistics.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.event_statistics.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.event_statistics.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.event_statistics.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.event_statistics.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.event_statistics.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.event_statistics.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.event_statistics.typography.text_decoration', ''),
                    ),
                ),
                'album_meta' => array(
                    'selector' => $prefix.'.wpsr-fb-album_feed .wpsr-fb-feed-item .wpsr-fb-feed-album-count, '. $prefix.'.wpsr-fb-album_feed .wpsr-fb-feed-album-header .wpsr-fb-feed-album-info',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.album_meta.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.album_meta.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.album_meta.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.album_meta.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.album_meta.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.album_meta.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.album_meta.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.album_meta.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.album_meta.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.album_meta.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.album_meta.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.album_meta.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.album_meta.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.album_meta.typography.text_decoration', ''),
                    ),
                ),
                'album_breadcrumb' => array(
                    'selector' => $prefix.'.wpsr-fb-album_feed .wpsr-fb-feed-bread-crumbs, '. $prefix.'.wpsr-fb-album_feed .wpsr-fb-feed-bread-crumbs .wpsr-fb-feed-bread-crumbs-album',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.album_breadcrumb.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.album_breadcrumb.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.album_breadcrumb.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.album_breadcrumb.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.album_breadcrumb.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.album_breadcrumb.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.album_breadcrumb.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.album_breadcrumb.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.album_breadcrumb.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.album_breadcrumb.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.album_breadcrumb.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.album_breadcrumb.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.album_breadcrumb.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.album_breadcrumb.typography.text_decoration', ''),
                    ),
                ),
                'post_content' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-item .wpsr-fb-feed-content',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.post_content.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.post_content.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_content.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_content.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.post_content.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_content.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_content.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.post_content.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.post_content.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.post_content.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.post_content.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.post_content.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.post_content.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.post_content.typography.text_decoration', ''),
                    ),
                ),
                'link_color' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-inner p a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.link_color.color.text_color', '')
                    ),
                ),
                'read_more_link_color' => array(
                    'selector' => $prefix.' .wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.read_more_link_color.color.text_color', '')
                    ),
                ),
                'summary_card' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-domain',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.summary_card.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.summary_card.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.summary_card.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.summary_card.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.summary_card.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.summary_card.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.summary_card.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.summary_card.typography.text_decoration', ''),
                    ),
                    'slider'  => array(
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.summary_card.slider.bottom.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.summary_card.slider.bottom.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.summary_card.slider.bottom.mobile', 0),
                        ),
                    ),
                ),
                'summary_card_title' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-title',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.summary_card_title.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.summary_card_title.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card_title.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card_title.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.summary_card_title.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card_title.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card_title.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.summary_card_title.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card_title.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card_title.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.summary_card_title.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.summary_card_title.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.summary_card_title.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.summary_card_title.typography.text_decoration', ''),
                    ),
                    'slider'  => array(
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.summary_card_title.slider.bottom.desktop', 0),
                            'tablet' => Arr::get($settings,'styles.summary_card_title.slider.bottom.tablet', 0),
                            'mobile' => Arr::get($settings,'styles.summary_card_title.slider.bottom.mobile', 0),
                        ),
                    ),
                ),
                'summary_card_description' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-url-summary-card-wrapper .wpsr-fb-feed-url-summary-card-contents .wpsr-fb-feed-url-summary-card-contents-description',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.summary_card_description.color.text_color', '')
                    ),
                    'typography' => array(
                        'font_size' => array(
                            'desktop' => Arr::get($settings,'styles.summary_card_description.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card_description.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card_description.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.summary_card_description.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card_description.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card_description.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.summary_card_description.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.summary_card_description.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.summary_card_description.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.summary_card_description.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.summary_card_description.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.summary_card_description.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.summary_card_description.typography.text_decoration', ''),
                    ),
                ),
                'like_and_share' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-follow-button-group .wpsr-fb-feed-btn a',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.like_and_share.color.text_color', ''),
                        'fill_color' => Arr::get($settings,'styles.like_and_share.color.fill_color', ''),
                        'background_color' => Arr::get($settings,'styles.like_and_share.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.like_and_share.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.like_and_share.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.like_and_share.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.like_and_share.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.like_and_share.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.like_and_share.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.like_and_share.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.like_and_share.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.like_and_share.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.like_and_share.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.like_and_share.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.like_and_share.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.like_and_share.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.like_and_share.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.like_and_share.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.like_and_share.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.like_and_share.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.like_and_share.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.like_and_share.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.like_and_share.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.like_and_share.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.like_and_share.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.like_and_share.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.like_and_share.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.like_and_share.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.like_and_share.padding.linked', false),
                    ),
                ),
                'fb_pagination' => array(
                    'selector' => $prefix.' .wpsr_more',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.fb_pagination.color.text_color', ''),
                        'background_color' => Arr::get($settings,'styles.fb_pagination.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.fb_pagination.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.fb_pagination.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.fb_pagination.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.fb_pagination.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.fb_pagination.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.fb_pagination.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.fb_pagination.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.fb_pagination.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.fb_pagination.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.fb_pagination.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.fb_pagination.border.border_color', ''),
                    ),

                ),
                'item_box' => array(
                    'selector' => $prefix.' .wpsr-fb-feed-item .wpsr-fb-feed-inner',
                    'color'  => array(
                        'background_color' => Arr::get($settings,'styles.item_box.color.background_color', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.item_box.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.item_box.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.item_box.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.item_box.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.item_box.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.item_box.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.item_box.border.border_color', ''),
                    ),

                ),
            ),
        ];
    }
}