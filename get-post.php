// get post
<?php
$id=68;
$post = get_post($id);
$title = apply_filters('the_title', $post->post_title);
$content = apply_filters('the_content', $post->post_content);
echo $title;
?>

// query
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
  'posts_per_page' => 3,
  'paged' => $paged,
  'post_type' => 'event',
  'post_status' => 'publish',
  'offset' => 0,
  'orderby' => 'event_start_date',
  'order' => 'DESC',
  'category__in' => array(1)
);
$my_query = new WP_Query($args); if( $my_query->have_posts()) { 
  while ($my_query->have_posts()) : $my_query->the_post();
  if(has_post_thumbnail()) {
    
    
  }
}
endwhile;
?>
