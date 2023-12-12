<?php

namespace NinjaTiktokFeed\Application\Services\Platforms\Feeds\Tiktok;

use NinjaTiktokFeed\Application\Services\Platforms\Feeds\Tiktok\Helper as TiktokHelper;
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

class Config
{
    public function __construct()
    {

    }

    public static function formatTiktokConfig($settings, $response)
    {
        $accounts    = TiktokHelper::getConnectedSourceList();
        $selectedAccounts = Arr::get($settings, 'source_settings.selected_accounts', []);

        $firstKey = '';
        if(!empty($accounts) && empty($selectedAccounts)) {
            $accountsKeys = array_keys($accounts);
            $firstKey = ''.$accountsKeys[0];
            $selectedAccounts = Arr::get($settings, 'source_settings.account_ids', [0 => $firstKey]);
        }

        return array(
            'feed_settings' => array(
                'platform'                  => 'tiktok',
                'template'                  => Arr::get($settings, 'template', 'template1'),
                'layout_type'               => Arr::get($settings, 'layout_type', 'grid'),
                'column_number'             => Arr::get($settings, 'column_number', '4'),
                'responsive_column_number'  => array(
                    'desktop'  => Arr::get($settings, 'responsive_column_number.desktop', Arr::get($settings,'column_number', '4')),
                    'tablet'   => Arr::get($settings, 'responsive_column_number.tablet','6'),
                    'mobile'   => Arr::get($settings, 'responsive_column_number.mobile', '12')
                ),
                'column_gaps'               => Arr::get($settings, 'column_gaps', 'default'),
                'enable_style'           => Arr::get($settings,'enable_style', 'false'),
                'source_settings'  => array(
                    'feed_type'         => Arr::get($settings, 'source_settings.feed_type', 'user_feed'),
                    'selected_accounts' => $selectedAccounts,
                    'specific_videos'    => sanitize_text_field(Arr::get($settings,'source_settings.specific_videos', '')),
                    'feed_count'        => (int) Arr::get($settings, 'source_settings.feed_count', 50),
                ),
                'filters'  => array(
                    'total_posts'      => (int) Arr::get($settings,'filters.total_posts', 50),
                    'total_posts_number'  => array(
                        'desktop'  => (int) Arr::get($settings, 'filters.total_posts_number.desktop', Arr::get($settings,'filters.total_posts', 50)),
                        'mobile'   => (int) Arr::get($settings, 'filters.total_posts_number.mobile', Arr::get($settings,'filters.total_posts', 50))
                    ),
                    'post_order'       => Arr::get($settings,'filters.post_order', 'ascending'),
                    'includes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.includes_inputs', '')),
                    'excludes_inputs'  => sanitize_text_field(Arr::get($settings,'filters.excludes_inputs', '')),
                    'hide_posts_by_id' => sanitize_text_field(Arr::get($settings,'filters.hide_posts_by_id', '')),
                ),
                'post_settings' => array(
                    'display_mode'            => Arr::get($settings,'post_settings.display_mode', 'tiktok'),
                    'display_author_photo'    => Arr::get($settings,'post_settings.display_author_photo', 'true'),
                    'display_author_name'     => Arr::get($settings,'post_settings.display_author_photo', 'true'),
                    'display_date'            => Arr::get($settings,'post_settings.display_date', 'true'),
                    'display_description'     => Arr::get($settings,'post_settings.display_description', 'true'),
                    'display_views_count'     => Arr::get($settings,'post_settings.display_views_count', 'true'),
                    'display_likes_count'     => Arr::get($settings,'post_settings.display_likes_count', 'true'),
                    'display_comments_count'  => Arr::get($settings,'post_settings.display_comments_count', 'true'),
                    'display_play_icon'       => Arr::get($settings,'post_settings.display_play_icon', 'true'),
                    'display_platform_icon'   => Arr::get($settings,'post_settings.display_platform_icon', 'true'),
                    'content_length'       => (int) Arr::get($settings,'post_settings.content_length', 15),
                ),
                'header_settings' => array(
                    'display_header'             => Arr::get($settings,'header_settings.display_header', 'true'),
                    'account_to_show'            => Arr::get($settings,'header_settings.account_to_show', $firstKey),
                    'display_profile_photo'      => Arr::get($settings,'header_settings.display_profile_photo', 'true'),
                    'display_page_name'          => Arr::get($settings,'header_settings.display_page_name', 'true'),
                    'display_description'        => Arr::get($settings,'header_settings.display_description', 'true'),
//                    'display_posts_counter'      => Arr::get($settings,'header_settings.display_posts_counter', 'true'),
                    'display_likes_counter'      => Arr::get($settings,'header_settings.display_likes_counter', 'true'),
                    'display_followers_counter'  => Arr::get($settings,'header_settings.display_followers_counter', 'true'),
                    'display_following_counter'  => Arr::get($settings,'header_settings.display_following_counter', 'true'),
                ),
                'carousel_settings' => array(
                    'autoplay'         => Arr::get($settings,'carousel_settings.autoplay', 'true'),
                    'autoplay_speed'   => (int) Arr::get($settings,'carousel_settings.autoplay_speed', 3000),
                    'slides_to_show'   => (int) Arr::get($settings,'carousel_settings.slides_to_show', 3),
                    'responsive_slides_to_show'  => array(
                        'desktop'  => (int)Arr::get($settings, 'carousel_settings.responsive_slides_to_show.desktop', Arr::get($settings, 'carousel_settings.slides_to_show', 3)),
                        'tablet'   => (int)Arr::get($settings, 'carousel_settings.responsive_slides_to_show.tablet',2),
                        'mobile'   => (int)Arr::get($settings, 'carousel_settings.responsive_slides_to_show.mobile', 1)
                    ),
                    'slides_to_scroll' => (int) Arr::get($settings,'carousel_settings.slides_to_scroll', 3),
                    'responsive_slides_to_scroll' => array(
                        'desktop'  => (int)Arr::get($settings, 'carousel_settings.responsive_slides_to_scroll.desktop', Arr::get($settings, 'carousel_settings.slides_to_scroll', 3)),
                        'tablet'   => (int)Arr::get($settings, 'carousel_settings.responsive_slides_to_scroll.tablet',2),
                        'mobile'   => (int)Arr::get($settings, 'carousel_settings.responsive_slides_to_scroll.mobile', 1)
                    ),
                    'navigation'       => Arr::get($settings,'carousel_settings.navigation', 'dot')
                ),
                'popup_settings'     => array(
                    'display_sidebar'       => Arr::get($settings,'popup_settings.display_sidebar', 'true'),
                    'display_video'         => Arr::get($settings,'popup_settings.display_video', 'true'),
                    'display_profile_photo' => Arr::get($settings,'popup_settings.display_profile_photo', 'true'),
                    'display_username'      => Arr::get($settings,'popup_settings.display_username', 'true'),
                    'display_caption'       => Arr::get($settings,'popup_settings.display_caption', 'true'),
                    'display_date'          => Arr::get($settings,'popup_settings.display_date', 'true'),
                    'display_cta_btn'      => Arr::get($settings,'popup_settings.display_cta_btn', 'true'),
                    'autoplay'              => Arr::get($settings,'popup_settings.autoplay', 'true')
                ),
                'follow_button_settings' => array(
                    'display_follow_button'      => Arr::get($settings,'follow_button_settings.display_follow_button', 'true'),
                    'follow_button_text'         => sanitize_text_field(Arr::get($settings,'follow_button_settings.follow_button_text', __('Follow on TikTok', 'ninja-tiktok-feed'))),
                    'follow_button_position'     => Arr::get($settings,'follow_button_settings.follow_button_position', 'header'),
                ),
                'pagination_settings' => array(
                    'pagination_type' => Arr::get($settings,'pagination_settings.pagination_type', 'none'),
                    'load_more_button_text' => sanitize_text_field(Arr::get($settings, 'pagination_settings.load_more_button_text', __('Load More', 'ninja-tiktok-feed'))),
                    'paginate'        => (int) Arr::get($settings,'pagination_settings.paginate', 6),
                ),
            ),
        );
    }

    public function getStyleElement()
    {
        return array(
            'header' => array(
                'title' => __('Header', 'ninja-tiktok-feed'),
                'key'  => 'header',
                array(
                    'title'     => __('User Name', 'ninja-tiktok-feed'),
                    'key'      => 'user_name',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Bottom Spacing', 'ninja-tiktok-feed'),
                    ),
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Description', 'ninja-tiktok-feed'),
                    'key'      => 'description',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'slider' => array(
                        'title' => __('Bottom Spacing', 'ninja-tiktok-feed'),
                    ),
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                    )
                ),
                array(
                    'title'     => __('Likes', 'ninja-tiktok-feed'),
                    'key'      => 'likes',
                    'divider' => true,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                    )
                ),
                array(
                    'title'     => __('Box', 'ninja-tiktok-feed'),
                    'key'      => 'header_box',
                    'divider' => false,
                    'typography' => false,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Background Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'content' => array(
                'title' => __('Content', 'ninja-tiktok-feed'),
                'key'  => 'content',
                array(
                    'title'     => __('Author', 'ninja-tiktok-feed'),
                    'key'      => 'author',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Post Date', 'ninja-tiktok-feed'),
                    'key'      => 'post_date',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Post Title', 'ninja-tiktok-feed'),
                    'key'      => 'post_title',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
                array(
                    'title'     => __('Post Text', 'ninja-tiktok-feed'),
                    'key'      => 'post_content',
                    'divider' => false,
                    'typography' => true,
                    'padding' => false,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
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
                            'title'      => __('Link Color:', 'ninja-tiktok-feed'),
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
                            'title'      => __('Read More Link Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                ),
            ),
            'like_and_share' => array(
                'title' => __('Like and Share Button', 'ninja-tiktok-feed'),
                'key'  => 'like_and_share',
                array(
                    'key'      => 'like_and_share',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
                    'border' => false,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                        array(
                            'title'      => __('Background Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        )
                    )
                )
            ),
            'pagination' => array(
                'title' => __('Pagination', 'ninja-tiktok-feed'),
                'key'  => 'pagination',
                array(
                    'key'      => 'tiktok_pagination',
                    'divider' => false,
                    'typography' => true,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Text Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'text_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                        array(
                            'title'      => __('Background Color:', 'ninja-tiktok-feed'),
                            'fieldKey'  => 'background_color',
                            'type'      => 'color_picker',
                            'flex'      => true,
                        ),
                    )
                )
            ),
            'item' => array(
                'title' => __('Item Box', 'ninja-tiktok-feed'),
                'key'  => 'item_box',
                array(
                    'key'      => 'item_box',
                    'divider' => false,
                    'typography' => false,
                    'padding' => true,
                    'border' => true,
                    'styles' => array(
                        array(
                            'title'      => __('Background Color:', 'ninja-tiktok-feed'),
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
        $prefix = '.wpsr-tiktok-feed-template-'.$postId;
        return [
            'styles' => array(
                'user_name' => array(
                    'selector' => $prefix.' .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a',
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
                    'selector' => $prefix.' .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p',
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
                    'selector' => $prefix.' .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics span',
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
                    'selector' => $prefix.' .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper',
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
                    'selector' => $prefix.' .wpsr-tiktok-feed-author .wpsr-tiktok-feed-author-info a',
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
                    'selector' => $prefix.' .wpsr-tiktok-feed-author .wpsr-tiktok-feed-time , .wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info .wpsr-tiktok-feed-video-statistics .wpsr-tiktok-feed-video-statistic-item',
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
                'post_title' => array(
                    'selector' => $prefix.' .wpsr-tiktok-feed-item .wpsr-tiktok-feed-video-info h3 a',
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
                'post_content' => array(
                    'selector' => $prefix.' .wpsr-tiktok-feed-item .wpsr-tiktok-feed-content',
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
                    'selector' => $prefix.' .wpsr-tiktok-feed-inner p a',
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
                'like_and_share' => array(
                    'selector' => $prefix.' .wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a',
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
                'tiktok_pagination' => array(
                    'selector' => $prefix.' .wpsr_more',
                    'color'  => array(
                        'text_color' => Arr::get($settings,'styles.tiktok_pagination.color.text_color', ''),
                        'background_color' => Arr::get($settings,'styles.tiktok_pagination.color.background_color', ''),
                    ),
                    'typography' => array(
                        'font_size'  => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.typography.font_size.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.typography.font_size.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.typography.font_size.mobile', ''),
                        ),
                        'letter_spacing'  => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.typography.letter_spacing.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.typography.letter_spacing.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.typography.letter_spacing.mobile', ''),
                        ),
                        'line_height'  => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.typography.line_height.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.typography.line_height.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.typography.line_height.mobile', ''),
                        ),
                        'font_weight'  => Arr::get($settings,'styles.tiktok_pagination.typography.font_weight', ''),
                        'font_style'  => Arr::get($settings,'styles.tiktok_pagination.typography.font_style', ''),
                        'text_transform'  => Arr::get($settings,'styles.tiktok_pagination.typography.text_transform', ''),
                        'text_decoration'  => Arr::get($settings,'styles.tiktok_pagination.typography.text_decoration', ''),
                    ),
                    'padding' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.padding.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.padding.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.padding.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.padding.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.padding.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.padding.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.padding.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.padding.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.padding.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.padding.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.padding.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.padding.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.tiktok_pagination.padding.linked', false),
                    ),
                    'border' => array(
                        'top' => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.border.top.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.border.top.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.border.top.mobile', ''),
                        ),
                        'right' => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.border.right.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.border.right.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.border.right.mobile', ''),
                        ),
                        'bottom' => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.border.bottom.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.border.bottom.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.border.bottom.mobile', ''),
                        ),
                        'left' => array(
                            'desktop' => Arr::get($settings,'styles.tiktok_pagination.border.left.desktop', ''),
                            'tablet' => Arr::get($settings,'styles.tiktok_pagination.border.left.tablet', ''),
                            'mobile' => Arr::get($settings,'styles.tiktok_pagination.border.left.mobile', ''),
                        ),
                        'linked' => Arr::get($settings,'styles.tiktok_pagination.border.linked', false),
                        'border_style' => Arr::get($settings,'styles.tiktok_pagination.border.border_style', ''),
                        'border_color' => Arr::get($settings,'styles.tiktok_pagination.border.border_color', ''),
                    ),

                ),
                'item_box' => array(
                    'selector' => $prefix.' .wpsr-tiktok-feed-item .wpsr-tiktok-feed-inner',
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