<?php
use WPSocialReviews\Framework\Support\Arr;
?>
<span class="wpsr-tiktok-feed-time">
    <?php
    $created_at = Arr::get($feed, 'created_at', '');
    echo sprintf(__('%s ago'), human_time_diff($created_at));
    ?>
</span>