

// WPML Language Selector
function language_selector() {
  $languages = icl_get_languages('skip_missing=0&orderby=code');
  if(!empty($languages)) {
    foreach($languages as $l) {
      if(!$l['active']) echo '<a class="btn btn-default" href="'.$l['url'].'">'.$l['language_code'].'</a>';
      if($l['active']) echo '<a class="btn btn-default" disabled="disabled">'.$l['language_code'].'</a>';
    }
  }
}

// Custom post type
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

// Dashicons
add_action( 'wp_enqueue_scripts', 'load_dashicons_front_end' );
function load_dashicons_front_end() {
  wp_enqueue_style( 'dashicons' );
}

// Show admin bar
show_admin_bar( false );

// Register custom navigation walker
require_once('wp_bootstrap_navwalker.php');

// Register menu
function register_ba_navigation() {
  $locations = array(
    'header-menu' => __( 'Header Menu', 'BoardAdvisors' ),
  );
  register_nav_menus( $locations );
}
add_action( 'init', 'register_ba_navigation' );

// The slug
function the_slug() {
  $post_data = get_post($post->ID, ARRAY_A);
  $slug = $post_data['post_name'];
  return $slug; 
}

// === excerpt manager ===
function youth_excerpt($length = '', $more = ''){
  global $post;
  if (function_exists($length)) {
    add_filter('excerpt_length', $length);
  }
  if (function_exists($more)) {
    add_filter('excerpt_more', $more);
  }
  $output = get_the_excerpt();
  $output = apply_filters('wptexturize', $output);
  $output = apply_filters('convert_chars', $output);
  $output = '<p>' . $output . '</p>';
  echo $output;
}
function youth_excerpt_index($length) {
  return 999;
}
function youth_excerpt_report($length) {
  return 50;
}
function youth_excerpt_more($more) {
  return ' <a class="more-link" href="' . get_permalink($post->ID) . '">' . __('... Czytaj dalej &raquo;', '4youth') . '</a>';
}

// === styling pagination ===
function kriesi_pagination($pages = '', $range = 2)
{  
  $showitems = ($range * 2)+1;  
  global $paged;
  if(empty($paged)) $paged = 1;
  if($pages == '')
  {
    global $wp_query;
    $pages = $wp_query->max_num_pages;
    if(!$pages)
    {
      $pages = 1;
    }
  }
  
  if(1 != $pages)
  {
    echo "<ul class='pagination'>";
    if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link(1)."'>&laquo;</a></li>";
    if($paged > 1 && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a></li>";
    for ($i=1; $i <= $pages; $i++)
    {
      if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
      {
        echo ($paged == $i)? "<li class='active'><span class='current'>".$i."</span></li>":"<li><a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a></li>";
      }
    }
    if ($paged < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a></li>";
    if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>&raquo;</a></li>";
    echo "</ul>\n";
  }
}

// === First p bold ===
function first_paragraph($content) 
{
  $page = get_query_var('page');
  if ($page < 2) {
    return preg_replace('/<p([^>]+)?>/', '<p$1 class="lead">', $content, 1);
  }
  else {
    return $content;
  }
}
add_filter('the_content', 'first_paragraph');

// === post thumbnail support ===
if ( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
  set_post_thumbnail_size( 300, 300, true );
  // default Post Thumbnail dimensions   
}
if ( function_exists( 'add_image_size' ) ) {
  add_image_size( 'index', '300', '300', true );
  add_image_size( 'full', '823', '400', true );
  add_image_size( 'post', '200', '200', true );
  add_image_size( 'menu', '300', '300', true );
  add_image_size( 'feat', '100', '150', true );
  add_image_size( 'list', '150', '150', true );
}
