<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if ( ! empty( $settings->tt_header_bg_color ) ) {
?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper {
    background-color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->tt_header_bg_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_header_account_name_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a {
    color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->tt_header_account_name_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_header_description_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p {
    color: <?php echo esc_attr( FLBuilderColor::hex_or_rgb( $settings->tt_header_description_color )); ?>;
}
<?php } ?>
<?php if ( ! empty( $settings->tt_header_statistics_count_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics span {
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_header_statistics_count_color )); ?>;
}
<?php } ?>


<?php if ( ! empty( $settings->tt_feed_follow_button_text_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a {
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_feed_follow_button_text_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_feed_follow_button_background_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a {
    background-color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_feed_follow_button_background_color )); ?>;
}
<?php } ?>


<?php if ( ! empty( $settings->tt_content_author_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-tiktok-feed-author-name {
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_content_author_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_content_date_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-tiktok-feed-time{
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_content_date_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_post_content_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-feed-description-link .wpsr-feed-description-text{
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_post_content_color )); ?>;
<?php } ?>

<?php if ( ! empty( $settings->tt_post_statistics_count_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-tiktok-feed-statistics .wpsr-tiktok-feed-reaction-count{
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_post_statistics_count_color )); ?>;
<?php } ?>

<?php if ( ! empty( $settings->tt_post_content_rm_link_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_add_read_more .wpsr_read_more, .wpsr_add_read_more .wpsr_read_less{
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_post_content_rm_link_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_load_more_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_load_more_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_load_more_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_load_more_hover_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_load_more_bg_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more {
    background-color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_load_more_bg_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_load_more_bg_hover_color ) ) { ?>
.fl-node-<?php echo esc_attr($id); ?> .wpsr_more:hover {
    background-color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_load_more_bg_hover_color )); ?>;
}
<?php } ?>

<?php if ( ! empty( $settings->tt_box_bg_color ) ) { ?>
    .fl-node-<?php echo esc_attr($id); ?> .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-tiktok-feed-inner{
        background-color: <?php echo esc_attr(FLBuilderColor::hex_or_rgb( $settings->tt_box_bg_color )); ?>;
<?php } ?>

<?php
// Header PageName Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_header_account_name_typography',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-name-wrapper a",
) );

// Header Description Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_header_account_description_typography',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-info-description p",
) );

// Header Likes Counter Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_header_account_statistics_counter_typography',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-header .wpsr-tiktok-feed-user-info-wrapper .wpsr-tiktok-feed-user-info-head .wpsr-tiktok-feed-header-info .wpsr-tiktok-feed-user-info .wpsr-tiktok-feed-user-statistics span",
) );


// Like and Share button Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_feed_follow_button_typography',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-follow-button-group .wpsr-tiktok-feed-btn a",
) );

// Post Author Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_content_author_typography',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-tiktok-feed-author-name",
) );

// Post Date Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_content_date_typography',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-tiktok-feed-time",
) );

// Post Content Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_post_content_typography',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-feed-description-link .wpsr-feed-description-text",
) );

// Post Statistics Count Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_post_statistics_count_typography',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-tiktok-feed-statistics .wpsr-tiktok-feed-reaction-count",
) );

// Load More Typography
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_load_more_typography',
	'selector' 		=> ".fl-node-$id .wpsr_more",
) );

// Box Background Color
FLBuilderCSS::typography_field_rule( array(
	'settings'		=> $settings,
	'setting_name' 	=> 'tt_box_bg_color',
	'selector' 		=> ".fl-node-$id .wpsr-tiktok-feed-wrapper .wpsr-tiktok-feed-item .wpsr-tiktok-feed-inner",
) );