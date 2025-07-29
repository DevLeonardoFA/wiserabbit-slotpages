<?php

/**
 * 
 * template for SlotCard
 * 
 */

$img = get_the_post_thumbnail_url();
$title = get_the_title();
$description = get_the_excerpt();

?>

<div class="SlotCard">

    <div class="image">
        <img src="<?php echo $img; ?>" alt="slot_img">
    </div>

    <div class="content">
        <h2><?php echo $title; ?></h2>
        <p><?php echo $description; ?></p>
    </div>

</div>