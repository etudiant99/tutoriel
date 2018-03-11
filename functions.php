<?php
register_nav_menus( array( 
        'menu-principal' => 'Menu principal'
) );
add_action('widgets_init','zero_add_sidebar');
function zero_add_sidebar()
{
    register_sidebar(array(
        'id' => 'my_custom_zone',
        'name' => 'Zone de droite',
        'description' => 'Apparait à droite du site',
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
        'after_widget' => "</li>",
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => "</h2>"
    ));
}
// add a link to the WP Toolbar
function custom_toolbar_link($wp_admin_bar) {
    $args = array(
        'id' => 'wpbeginner',
        'title' => 'Se connecter', 
        'href' => 'http://localhost/tutoriel/wp-login.php', 
        'meta' => array(
            'class' => 'wpbeginner', 
            'title' => 'Search WPBeginner Tutorials'
            )
    );
    if (!is_user_logged_in())
        $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'custom_toolbar_link', 999);
show_admin_bar(true);