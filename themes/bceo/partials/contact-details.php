<?php
$enabled = get_field("contact_details_enabled", "option");
if ($enabled):
  $heading = get_field("contact_details_heading", "option");
  $theme = get_field("contact_details_theme", "option");

  switch ($theme) {
    case "orange":
    case "yellow":
    case "grey":
    case "white":
    case "blue":
    default:
      $sectionClass = "bg-primary text-white";
      $headingClass = "text-white accent-line-yellow";
  }

  $image = get_field("contact_details_image", "option");
  $image = $image ? wp_get_attachment_image_src($image, "full") : false;

  if ($image && $heading): ?>
<div class="row section-contact-details no-gutters">
  <div class="col-md-7 col-12 map-wrapper order-md-2">
    <figure class="map h-100" style="background-image: url(<?php echo $image[0]; ?>);"></figure>
  </div>
  <div class="col-md-5 col-12 info-wrapper padded-area order-md-1">
    <header>
      <h2 class="accent-line-orange"><?php echo $heading; ?></h2>
    </header>
    <div class="content font-weight-bold">
      <?php the_field("contact_details_content", "option"); ?>
    </div>
  </div>
</div>
<?php endif;
endif;
?>
