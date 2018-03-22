<?php get_header(); ?>
	<div class="row">
        <div class="col-sm-12">
			<?php 
			if ( have_posts() ) : while ( have_posts() ) : the_post();
                ?>
                <div id="main" class="blog-post">
	               <h2 class="blog-post-title"><?php the_title(); ?></h2>
	               <p class="blog-post-meta"><?php the_date(); ?> par <?php the_author(); ?></p>
                    <?php the_content(); ?>
                    
                    <?php the_terms( $post->ID, 'marques', 'Marque : ' ); ?> <br />
                    <?php the_terms( $post->ID, 'modeles', 'Modèle : ' );?> <br />
                    <?php the_terms( $post->ID, 'annees', 'Année : ' );?> <br />
                    <?php the_terms( $post->ID, 'types', 'Type : ' );?> <br />
                    <?php the_terms( $post->ID, 'options', 'Options : ' );?> <br />
                    <?php the_terms( $post->ID, 'pneus', 'Pneu : ' );?> <br />
                </div><!-- /.blog-post -->
                <?php
			endwhile; endif; 
			?>
		</div> <!-- /.blog-main -->
	</div> <!-- /.row -->
<?php get_footer(); ?>