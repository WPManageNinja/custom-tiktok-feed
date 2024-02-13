<?php
use WPSocialReviews\Framework\Support\Arr;

if (!defined('ABSPATH')) {
    exit;
}

$mediaUrl = Arr::get($feed, 'media.url', '');
?>
<div class="wpsr-feed-description-link">
    <p>
        <?php
        if ($trim_title_words) {
            echo esc_html(wp_trim_words($message, $trim_title_words, '...'));
        } else {
            echo esc_html($message);
        }
        ?>
    </p>
</div>