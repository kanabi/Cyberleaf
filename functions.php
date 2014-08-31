

// === WPML Language Selector ===
function language_selector() {
  $languages = icl_get_languages('skip_missing=0&orderby=code');
  if(!empty($languages)) {
    foreach($languages as $l) {
      if(!$l['active']) echo '<a class="btn btn-default" href="'.$l['url'].'">'.$l['language_code'].'</a>';
      if($l['active']) echo '<a class="btn btn-default" disabled="disabled">'.$l['language_code'].'</a>';
    }
  }
}

// custom post type
function project_post_type() {
  $labels = array(
    'name'                => _x( 'Project', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Project', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Project', 'text_domain' ),
    'parent_item_colon'   => __( 'Parent Project:', 'text_domain' ),
    'all_items'           => __( 'All Projects', 'text_domain' ),
    'view_item'           => __( 'View Projects', 'text_domain' ),
    'add_new_item'        => __( 'Add new Projects', 'text_domain' ),
    'add_new'             => __( 'New Project', 'text_domain' ),
    'edit_item'           => __( 'Edit Project', 'text_domain' ),
    'update_item'         => __( 'Update Project', 'text_domain' ),
    'search_items'        => __( 'Project Search', 'text_domain' ),
    'not_found'           => __( 'Project not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Project not found in trash', 'text_domain' ),
  );
  $args = array(
    'menu_icon' 				  => 'dashicons-clipboard',
    'label'               => __( 'project', 'text_domain' ),
    'description'         => __( 'project', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'custom-fields', ),
    'taxonomies'          => array( 'category', 'post_tag' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 5,
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'page',
  );
  register_post_type( 'project', $args );
}
add_action( 'init', 'project_post_type', 0 );

// === Dashicons ===
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
  wp_enqueue_style( 'dashicons' );
}

// show admin bar
show_admin_bar( false );
