<?php

if (!defined('ABSPATH')) exit;


if (file_exists(get_template_directory() . '/header.php')) {

    get_header();

} else {

	wp_head();

    echo do_blocks('<!-- wp:template-part {"slug":"header"} /-->');

}




?>


<main id="primary" class="site-main" style="max-width: 800px; margin: 2rem auto; padding: 1rem;">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


        <article <?php post_class(); ?> id="post-single-slot">

			<img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="Slot Image">

            
            <h1><?php the_title(); ?></h1>

			<div class="WRSP_stars">
				<?php for($i = 1; $i <= 5; $i++) { ?>
					<i class="fa-solid fa-star <?php echo $i <= get_post_meta(get_the_ID(), 'WRSP_rating', true) ? 'active' : ''; ?>"></i>
				<?php } ?>
			</div>

			<?php 
				$tax = get_the_terms(get_the_ID(), 'provider');
				if ($tax) {
					echo '<h2>' . $tax[0]->name . '</h2>';
				}
			?>

			<div class="ReturnToPlayerPercentage">
				<span> <?php echo __('Return to Player Percentage', 'WRSP') . ':' . get_post_meta(get_the_ID(), 'WRSP_RTP', true) . '%'; ?></span>
			</div>

			<div class="MinimumMaximumWager">
				<span> <?php echo __('Minimum/Maximum Wager', 'WRSP') . ':' . get_post_meta(get_the_ID(), 'WRSP_MinimumWager', true) . ' / ' . get_post_meta(get_the_ID(), 'WRSP_MaximumWager', true); ?></span>
			</div>

            <div class="entry-content">
                <?php the_content(); ?>
            </div>

        </article>


    <?php endwhile; endif; ?>
</main>

<?php

if (file_exists(get_template_directory() . '/footer.php')) {

    get_footer();

} else {

	wp_footer();

	echo do_blocks('<!-- wp:template-part {"slug":"footer"} /-->');

}

?>
