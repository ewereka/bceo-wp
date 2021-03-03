<?php
$page_hero_image_id = get_page_header_image(false);

$page_hero_image_id = $page_hero_image_id
  ? $page_hero_image_id
  : get_default_header_image();
$page_hero = $page_hero_image_id
  ? wp_get_attachment_image_src($page_hero_image_id, "full")
  : false;
$page_hero_style =
  $page_hero && is_array($page_hero)
    ? sprintf("style=\"background-image: url('%s');\"", $page_hero[0])
    : "";
?>

<div class="page-hero" <?php echo $page_hero_style; ?>>
  <div class="content text-light text-uppercase">
    <h1 class="h2 my-0"><?php the_title(); ?></h1>
    <?php echo do_shortcode("[flexy_breadcrumb]"); ?>
  </div>
</div>