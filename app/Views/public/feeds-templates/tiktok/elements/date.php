<?php
use WPSocialReviews\Framework\Support\Arr;
$createdAt = Arr::get($feed, 'created_at', '');
?>
<span class="wpsr-tiktok-feed-time">
    <?php
    $created_at = $createdAt;
    echo sprintf(__('%s ago'), human_time_diff($created_at));
    ?>
</span>