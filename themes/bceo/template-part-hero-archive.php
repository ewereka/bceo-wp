<?php 
  $post_type = $post_type ? $post_type : 'post';
  $default_settings = "default_settings";
  $pt_settings = $post_type."_settings";
  $page_hero_image_id = null;

  if (have_rows($pt_settings, "option")) {
    while(have_rows($pt_settings, "option")) {
      the_row();
      $page_hero_image_id = get_sub_field('header_image');
      
    }
  }

  $page_hero_image_id = ($page_hero_image_id) ? $page_hero_image_id : get_default_header_image();
  $page_hero = $page_hero_image_id ? wp_get_attachment_image_src($page_hero_image_id, 'full') : false;
  $page_hero_style = ($page_hero && is_array($page_hero)) ? 
    sprintf("style=\"background-image: url('%s');\"", $page_hero[0]) : 
    "";

?>

<div class="page-hero" <?php echo $page_hero_style; ?>>
  <div class="content text-light text-uppercase">
    <h1 class="h2 my-0"><?php the_archive_title(); ?></h1>
    <?php echo do_shortcode('[flexy_breadcrumb]'); ?>
  </div>
</div>