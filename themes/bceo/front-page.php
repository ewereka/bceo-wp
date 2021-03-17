<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header(); ?>

<?php get_template_part("partials/hero-slider"); ?>

<div class="main">
  <!-- <div class="row section-projects no-gutters">
    <div class="col-7 map-wrapper padded-area">
      <figure class="map"><img class="img-fluid" src="<?php theme_asset(
        "img/map/static.jpg"
      ); ?>"></figure>
      <a href="#"><h2 class="text-light">Interactive Project Map</h2></a>
    </div>
    <div class="col-5 info-wrapper padded-area">
      <header>
        <h2 class="accent-line-orange">Road Closing and Traffic Advisories</h2>
      </header>
      <div class="content font-weight-bold">
        <p>Check out our interactive project map to find recent closures and advisories in your area.</p>
        <p>To learn more about these projects and previous work, visit our in-depth project map through the link below.</p>
      </div>
      <footer>
        <p><a href="#" class="btn btn-bceo btn-primary">Access Project Map</a></p>
      </footer>
    </div>
  </div> -->
  
  <?php get_template_part("partials/recent-news"); ?>
  <?php get_template_part("partials/faq-cta"); ?>
  <?php get_template_part("partials/by-the-numbers"); ?>
  <?php get_template_part("partials/contact-details"); ?>
</div>


<?php get_footer();
?>
