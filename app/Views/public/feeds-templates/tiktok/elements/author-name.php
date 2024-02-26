<?php
use WPSocialReviews\Framework\Support\Arr;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

if(Arr::get($template_meta, 'post_settings.display_author_name') === 'true'){
    $userName = Arr::get($account, 'name', '');
    $profileUrl = Arr::get($account, 'profile_url', '');
    ?>
    <a class="wpsr-tiktok-feed-author-name" href="<?php echo esc_url($profileUrl); ?>" target="_blank" rel="nofollow">
        <?php echo esc_html($userName); ?>
    </a>
<?php }