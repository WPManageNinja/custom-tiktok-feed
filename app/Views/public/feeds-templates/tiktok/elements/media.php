<div class="wpsr-tiktok-feed-image">
    <a href="https://www.tiktok.com/@<?php echo $feed['user']['id']; ?>/video/<?php echo $feed['id']; ?>" class="wpsr-tiktok-feed-video-preview wpsr-tiktok-feed-video-playmode wpsr-feed-link" target="_blank" rel="nofollow">
        <img src="<?php echo $feed['media']['preview_image_url']; ?>" alt="<?php echo $feed['description']; ?>"/>
        <?php if ($template_meta['post_settings']['display_play_icon'] === 'true'): ?>
            <div class="wpsr-tiktok-feed-video-play">
                <div class="wpsr-tiktok-feed-video-play-icon"></div>
            </div>
        <?php endif; ?>
    </a>
</div>
