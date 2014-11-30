<?php if(has_post_thumbnail()) {
    $attr = array('class'	=> 'img-responsive img-thumbnail');    
    $cover_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
    $thumb_img = get_post(get_post_thumbnail_id());
    $video_1 = get_post_meta(get_the_ID(), 'video_1', true);
    $video_2 = get_post_meta(get_the_ID(), 'video_2', true);
    $video_3 = get_post_meta(get_the_ID(), 'video_3', true);
    $szlug = the_slug();
    echo '<a class="img-fancybox" data-fancybox-group="'.the_slug().'" alt="'.the_title_attribute('echo=0').'" title="'.the_title_attribute('echo=0').'" href="'.$cover_url[0].'">';
        ?>
        
        <div class="subtitle-box ani">
          <div class="subtitle ani">
            <h2 class="galeria"><?php the_title(); ?></h2>
            <h4 class="galeria"><?php the_time('j/n/Y'); ?></h4>
          </div>
        </div>
        
        <?php 
    the_post_thumbnail('galeria', $attr);
    echo '</a>';
        ?>
        
        <?php if(!empty($video_1)) { ?>
        <a class="img-fancybox" data-fancybox-group="<?php echo $szlug; ?>" alt="<?php the_title_attribute('echo=0'); ?>" title="<?php the_title_attribute('echo=0'); ?>" href="<?php echo $video_1; ?>"></a>
        <?php } ?>
        
        <?php
    if(get_post_gallery()) :
    $gallery = get_post_gallery( $post, false );
    $ids = explode( ",", $gallery['ids'] );
    foreach( $ids as $id ) {
      $link = wp_get_attachment_url( $id );
        ?>
        
        <a class="img-fancybox" data-fancybox-group="<?php echo $szlug; ?>" alt="<?php echo $thumb_img->post_content; ?>" title="<?php echo $thumb_img->post_content; ?>"  href="<?php echo $link; ?>"></a>
