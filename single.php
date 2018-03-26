<?php get_header(); ?> <!-- ouvrir header,php -->
    <div id="main" class="row">
            <div class="col-sm-8">
                <?php if(have_posts()) : ?>
                    <?php while(have_posts()) : the_post(); ?>
                        <div class="post" id="post-<?php the_ID(); ?>">
                            <h2><?php the_title(); ?></h2>
                            <p class="postmetadata">
                                <?php the_time('j F Y') ?> par <?php the_author() ?> | Catégorie: <?php the_category(', ') ?>
                                <?php edit_post_link('Editer', ' &#124; ', ''); ?>
                            </p>
                            <div class="post_content">
                                <?php the_content(); ?>
                            </div>
                        </div>
                        <div class="comments-template">
                            <?php comments_template(); ?>
                        </div>
                    <?php endwhile; ?>
                    <?php previous_post_link() ?> <?php next_post_link() ?>
                    <?php else : ?>
                        <p>Désolé, aucun article ne correspond à vos critères.</p>
                <?php endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
        <?php get_footer(); ?>