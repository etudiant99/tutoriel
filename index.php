<?php get_header(); ?>
	<div id="main" class="row">
		<div class="col-sm-8 blog-main">
			<?php
            $args = array(
                'post_type' => 'automobiles'
                
            );
            $automobiles = new WP_Query( $args );
            if( $automobiles->have_posts() ) {
                while( $automobiles->have_posts() ) {
                    $automobiles->the_post();?>
                    <div class='content'>
                        <h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
                        par <?php the_author(); ?>
                    </div><?php
                }
            }
            else {
                echo 'Oh oh rien n\' est enttré!';
            }
			?>
        </div> <!-- /.blog-main -->
		<?php get_sidebar(); ?>
	</div> <!-- /.row -->
<?php get_footer(); ?>