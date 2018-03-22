<?php

get_header(); ?>

<?php
            $args = array(
                'post_type' => 'automobiles'
                
            );
            $automobiles = new WP_Query( $args );
?>
<div class="wrap">

	<?php if ( $automobiles->have_posts() ) : ?>
		<header class="page-header">
			<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="taxonomy-description">', '</div>' );
			?>
		</header><!-- .page-header -->
	<?php endif; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( $automobiles->have_posts() ) : ?>
			<?php
			/* Start the Loop */
			while ( $automobiles->have_posts() ) : the_post();
                $automobiles->the_post();?>
                <h1><?php the_title() ?></h1>
                <div class='content'>
                    <?php the_content() ?>
                </div><?php
			endwhile;
		else :
            echo 'Oh oh rien n\' est enttré!';
		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
	<?php get_sidebar(); ?>
</div><!-- .wrap -->

<?php get_footer();
