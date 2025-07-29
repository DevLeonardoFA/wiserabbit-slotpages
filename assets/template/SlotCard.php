<?php

/**
 * 
 * template for SlotCard
 * 
 */

$img = get_the_post_thumbnail_url();
$title = get_the_title();
$description = get_the_excerpt();

$stars = get_post_meta(get_the_ID(), 'WRSP_rating', true);


?>

<div class="SlotCard" data-post="<?php echo get_the_ID(); ?>">

    <div class="image">
        <img src="<?php echo $img; ?>" alt="slot_img">
    </div>

    <div class="content">
        <h2><?php echo $title; ?></h2>
        <div class="WRSP_stars" style="--stars: <?php echo $stars; ?>">
            <?php for($i = 1; $i <= 5; $i++) { ?>
                <i class="fa-solid fa-star <?php echo $i <= $stars ? 'active' : ''; ?>"></i>
            <?php } ?>
        </div>
        <a href="<?php echo get_the_permalink(); ?>" target="_blank" class="button">More Info</a>
    </div>

</div>