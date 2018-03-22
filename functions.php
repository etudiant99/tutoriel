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
        'before_widget' => '<div>',
        'after_widget' => "</div>",
        'before_title' => '<h2 class="widgettitle">',
        'after_title' => "</h2>"
    ));
}
// add a link to the WP Toolbar
function custom_toolbar_link($wp_admin_bar) {
    $accueil = get_home_url();
    $args = array(
        'id' => 'wpbeginner',
        'title' => 'Se connecter', 
        'href' => $accueil.'/wp-login.php', 
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

/*
* On utilise une fonction pour créer notre custom post type 'Automobiles'
*/

function wpm_custom_post_type() {

	// On rentre les différentes dénominations de notre custom post type qui seront affichées dans l'administration
	$labels = array(
		// Le nom au pluriel
		'name'                => _x( 'Automobiles', 'Post Type General Name'),
		// Le nom au singulier
		'singular_name'       => _x( 'Automobile', 'Post Type Singular Name'),
		// Le libellé affiché dans le menu
		'menu_name'           => __( 'Automobiles'),
		// Les différents libellés de l'administration
		'all_items'           => __( 'Toutes les automobiles'),
		'view_item'           => __( 'Voir les automobiles'),
		'add_new_item'        => __( 'Ajouter une nouvelle automobile'),
		'add_new'             => __( 'Ajouter'),
		'edit_item'           => __( 'Editer une automobile'),
		'update_item'         => __( 'Modifier une automobile'),
		'search_items'        => __( 'Rechercher une automobile'),
		'not_found'           => __( 'Non trouvée'),
		'not_found_in_trash'  => __( 'Non trouvée dans la corbeille'),
	);
	
	// On peut définir ici d'autres options pour notre custom post type
	
	$args = array(
		'label'               => __( 'Automobiles'),
		'description'         => __( 'Tous sur automobiles'),
		'labels'              => $labels,
        'menu_position' => 3,
		// On définit les options disponibles dans l'éditeur de notre custom post type ( un titre, un auteur...)
		'supports'            => array( 'title', 'editor','link', 'author', 'thumbnail', 'revisions', 'custom-fields', ),
		/* 
		* Différentes options supplémentaires
		*/	
		'hierarchical'        => false,
		'public'              => true,
		'has_archive'         => true,
        'exclude_from_search' => false,
		'rewrite'			  => array( 'slug' => 'automobiles'),

	);
	
	// On enregistre notre custom post type qu'on nomme ici "automobiles" et ses arguments
	register_post_type( 'automobiles', $args );

}

add_action( 'init', 'wpm_custom_post_type', 0 );



add_action( 'init', 'wpm_add_taxonomies', 0 );

//On crée 3 taxonomies personnalisées: Marque, Modèle et Année.

function wpm_add_taxonomies() {
	
	// Taxonomie Marque

	// On déclare ici les différentes dénominations de notre taxonomie qui seront affichées et utilisées dans l'administration de WordPress
	$labels_marque = array(
		'name'              			=> _x( 'Marques', 'taxonomy general name'),
		'singular_name'     			=> _x( 'Marque', 'taxonomy singular name'),
		'search_items'      			=> __( 'Chercher une marque'),
		'all_items'        				=> __( 'Toutes les marque'),
		'edit_item'         			=> __( 'Editer la marque'),
		'update_item'       			=> __( 'Mettre à jour la marque'),
		'add_new_item'     				=> __( 'Ajouter une nouvelle marque'),
		'new_item_name'     			=> __( 'Valeur de la nouvelle marque'),
		'separate_items_with_commas'	=> __( 'Séparer les marques avec une virgule'),
		'menu_name'         => __( 'Marque'),
	);

	$args_marque = array(
	// Si 'hierarchical' est défini à false, notre taxonomie se comportera comme une étiquette standard
		'hierarchical'      => false,
		'labels'            => $labels_marque,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'marques' ),
	);

	register_taxonomy( 'marques', 'automobiles', $args_marque );

	// Taxonomie Modèles
	
	$labels_modeles = array(
		'name'                       => _x( 'Modèles', 'taxonomy general name'),
		'singular_name'              => _x( 'Modèle', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher un modèle'),
		'popular_items'              => __( 'Modèles populaires'),
		'all_items'                  => __( 'Tous les modèles'),
		'edit_item'                  => __( 'Editer un modèle'),
		'update_item'                => __( 'Mettre à jour un modèle'),
		'add_new_item'               => __( 'Ajouter un nouveau modèle'),
		'new_item_name'              => __( 'Nom du nouveau modèle'),
		'separate_items_with_commas' => __( 'Séparer les modèles avec une virgule'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer un modèle'),
		'choose_from_most_used'      => __( 'Choisir parmi les plus utilisés'),
		'not_found'                  => __( 'Pas de modèles trouvés'),
		'menu_name'                  => __( 'Modèles'),
	);

	$args_modeles = array(
		'hierarchical'          => false,
		'labels'                => $labels_modeles,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var'             => true,
        'hierarchical'          => true,
		'rewrite'               => array( 'slug' => 'modeles' ),
	);

	register_taxonomy( 'modeles', 'automobiles', $args_modeles );
	
	// Année

	$labels_annees = array(
		'name'                       => _x( 'Années', 'taxonomy general name'),
		'singular_name'              => _x( 'Année', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher une année'),
		'popular_items'              => __( 'Années populaires'),
		'all_items'                  => __( 'Toutes les années'),
		'edit_item'                  => __( 'Editer une année'),
		'update_item'                => __( 'Mettre à jour une année'),
		'add_new_item'               => __( 'Ajouter une nouvelle année'),
		'new_item_name'              => __( 'Nom de la nouvelle année'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer une année'),
		'choose_from_most_used'      => __( 'Choisir parmi les années les plus utilisées'),
		'not_found'                  => __( 'Pas d\' année trouvées'),
		'menu_name'                  => __( 'Années'),
	);

	$args_annees = array(
	// Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
		'hierarchical'          => true,
		'labels'                => $labels_annees,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'annees' ),
	);

	register_taxonomy( 'annees', 'automobiles', $args_annees );

	// Type

	$labels_types = array(
		'name'                       => _x( 'Types', 'taxonomy general name'),
		'singular_name'              => _x( 'Type', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher un type'),
		'popular_items'              => __( 'Types populaires'),
		'all_items'                  => __( 'Tous les types'),
		'edit_item'                  => __( 'Editer un type'),
		'update_item'                => __( 'Mettre à jour un type'),
		'add_new_item'               => __( 'Ajouter un nouveau type'),
		'new_item_name'              => __( 'Nom du nouveau type'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer un type'),
		'choose_from_most_used'      => __( 'Choisir parmi les types les plus utilisés'),
		'not_found'                  => __( 'Pas de type trouvés'),
		'menu_name'                  => __( 'Types'),
	);

	$args_types = array(
	// Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
		'hierarchical'          => true,
		'labels'                => $labels_types,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'types' ),
	);

	register_taxonomy( 'types', 'automobiles', $args_types );
    
	// Options

	$labels_options = array(
		'name'                       => _x( 'Options', 'taxonomy general name'),
		'singular_name'              => _x( 'Option', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher une option'),
		'popular_items'              => __( 'Options populaires'),
		'all_items'                  => __( 'Toutes les options'),
		'edit_item'                  => __( 'Editer une option'),
		'update_item'                => __( 'Mettre à jour une option'),
		'add_new_item'               => __( 'Ajouter une nouvelle option'),
		'new_item_name'              => __( 'Nom de la nouvelle option'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer une option'),
		'choose_from_most_used'      => __( 'Choisir parmi les options les plus utilisées'),
		'not_found'                  => __( 'Pas d\'options trouvées'),
		'menu_name'                  => __( 'Options'),
	);

	$args_options = array(
	// Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
		'hierarchical'          => true,
		'labels'                => $labels_options,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'options' ),
	);

	register_taxonomy( 'options', 'automobiles', $args_options );

	// Pneus

	$labels_pneus = array(
		'name'                       => _x( 'Pneus', 'taxonomy general name'),
		'singular_name'              => _x( 'Pneu', 'taxonomy singular name'),
		'search_items'               => __( 'Rechercher un pneu'),
		'popular_items'              => __( 'Pneus populaires'),
		'all_items'                  => __( 'Tous les pneus'),
		'edit_item'                  => __( 'Editer un pneu'),
		'update_item'                => __( 'Mettre à jour un pneu'),
		'add_new_item'               => __( 'Ajouter un nouveau pneu'),
		'new_item_name'              => __( 'Nom du nouveau pneu'),
		'add_or_remove_items'        => __( 'Ajouter ou supprimer un pneu'),
		'choose_from_most_used'      => __( 'Choisir parmi les pneus les plus utilisés'),
		'not_found'                  => __( 'Pas de pneus trouvés'),
		'menu_name'                  => __( 'Pneus'),
	);

	$args_pneus = array(
	// Si 'hierarchical' est défini à true, notre taxonomie se comportera comme une catégorie standard
		'hierarchical'          => true,
		'labels'                => $labels_pneus,
		'show_ui'               => true,
		'show_admin_column'     => true,
		'query_var'             => true,
		'rewrite'               => array( 'slug' => 'pneus' ),
	);

	register_taxonomy( 'pneus', 'automobiles', $args_pneus );

}

function wpc_cpt_in_home($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_home) {
      $query->set('post_type', array('post', 'automobiles'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_home');

function wpc_cpt_in_search($query) {
  if (! is_admin() && $query->is_main_query()) {
    if ($query->is_search) {
      $query->set('post_type', array('post', 'automobiles'));
    }
  }
}

add_action('pre_get_posts','wpc_cpt_in_search');

function my_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['automobiles'] = array(
    0 => '', 
    1 => sprintf( __('automobile mis à jour <a href="%s">Voir l\'automobile</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Champ personnalisé mis à jour.'),
    3 => __('Champ personnalisé supprimé.'),
    4 => __('automobile mis à jour.'),
    5 => isset($_GET['revision']) ? sprintf( __('Automobile restauré à la révision de %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Automobile publiée <a href="%s">Voir l\'automobile</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Automobile enregistrée'),
    8 => sprintf( __('Automobile soumise <a target="_blank" href="%s">Aperçu de l\'automobile</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Automobile prévue pour: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Aperçu de l\'automobile</a>'), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Version de l\'automobile mise à jour <a target="_blank" href="%s">Aperçu de l\'automobile</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
add_filter( 'post_updated_messages', 'my_updated_messages' );

function my_contextual_help( $contextual_help, $screen_id, $screen ) { 
  if ( 'automobile' == $screen->id ) {

    $contextual_help = '<h2>Automobiles</h2>
    <p>Les automobiles montrent les détails des articles que nous vendons sur le site Web. Vous pouvez en voir une liste dans l\'ordre chronologique inverse - la dernière que nous avons ajoutée est la première.</p> 
    <p>Vous pouvez afficher / modifier les détails de chaque automobile en cliquant sur son nom, ou vous pouvez effectuer des actions groupées en utilisant le menu déroulant et en sélectionnant plusieurs éléments.</p>';

  } elseif ( 'edit-automobile' == $screen->id ) {

    $contextual_help = '<h2>Modification d\' automobiles</h2>
    <p>Cette page vous permet d\'afficher / modifier les détails de l\'automobile. Veuillez vous assurer de remplir les cases disponibles avec les détails appropriés (marque de l\'automobile, modèle, etc) et <strong> ne pas </ strong> ajouter ces détails à la description de l\'automobile.</p>';

  }
  return $contextual_help;
}
add_action( 'contextual_help', 'my_contextual_help', 10, 3 );