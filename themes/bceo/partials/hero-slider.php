<?php
$hero_shortcode = get_field("hero_shortcode", "option");
$hero_slider_html = $hero_shortcode ? do_shortcode($hero_shortcode) : false;
if ($hero_slider_html): ?>
<div class="hero-slider"><?php echo $hero_slider_html; ?></div>
<?php else: ?>
<div class="hero">
  <div class="content  text-light text-uppercase">
    <h2 class="h1 mb-4">Safety, Integrity,<br>Sound Engineering</h2>
    <p class="mb-4">Roadyway solutions for a better commute.<br>
      Learn more about BCEO&lsquo;s newest<br>
      Double Diamond Interchange Projects</p>
    <p class="mb-0">
      <button href="#" class="btn btn-warning btn-bceo">Learn More</button>
    </p>
  </div>
</div>
<?php endif;
