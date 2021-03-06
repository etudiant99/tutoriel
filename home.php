<?php get_header(); ?> <!-- ouvrir header,php -->
    <div id="main" class="row">
            <div class="col-sm-8">
            <?php
            $args = array(
                'post_type' => 'automobiles',
                'post_id' => '44'
            );
            $query = new WP_Query( $args );
            //var_dump($query);
            ?>            
                <?php if($query->have_posts()) : ?>
                    <?php while(have_posts()) : the_post(); ?>
                        <div class="post" id="post-<?php the_ID(); ?>">
                        <h2><a href="<?php the_permalink($monlien); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
                        <p class="postmetadata">
                            <?php the_time('j F Y') ?> par <?php the_author() ?>
                            <?php if ( comments_open() ) : ?>
                                | <?php comments_popup_link('Pas de commentaires', '1 Commentaire', '% Commentaires'); ?>
                            <?php endif; ?>
                            <?php edit_post_link('Editer', ' &#124; ', ''); ?>
                        </p>
                        <div class="post_content">
                            <?php wp_list_categories( array( 'taxonomy'=>'automobiles', 'marques'=>'marques' ) ) ?>
                            <?php the_terms( $post->ID, 'marques', 'Marque : ' ); ?>
                            <?php the_terms( $post->ID, 'modeles', 'Modèle : ' ); ?>
                            <?php the_terms( $post->ID, 'annees', 'Année : ' ); ?>
                            <?php the_terms( $post->ID, 'pneus', 'Pneu : ' ); ?>
                        </div>
                    </div>
                    <?php endwhile; ?>
                    <div class="navigation">
                        <?php posts_nav_link(' - ','page suivante','page pr&eacute;c&eacute;dente'); ?>
                    </div>
                    <?php else : ?>
                        <h2>Oooopppsss...</h2>
                        <p>Désolé, mais vous cherchez quelque chose qui ne se trouve pas ici .</p>
                        <?php include (TEMPLATEPATH . "/searchform.php"); ?>
                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>
