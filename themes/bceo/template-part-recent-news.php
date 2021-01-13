<?php 
if (is_front_page()) {
  $newsEnabled = get_field('latest_news_enabled', 'option');
  $legalAdsEnabled = ($newsEnabled) ? get_field('legal_ads_enabled', 'option') : false;
} else {
  $newsEnabled = true;
  $legalAdsEnabled = false;
}

$hasLegalAds = false;
$totalNews = 0;

$args =  array(
	'post_type'              => array( 'post' ),
	'post_status'            => array( 'publish' ),
  'posts_per_page'         => '3',
);

if (is_single() && $post_type === 'post') {
  $args['post__not_in'] = array(get_the_ID());
}

if (is_front_page() && $legalAdsEnabled) {
  
  $args['category__not_in'] = array(38);

  $legalAdsArgs = array(
    'post_type'              => array( 'post' ),
    'post_status'            => array( 'publish' ),
    'posts_per_page'         => '3',
    'category__in'           => array(38)
  );
  $recentLegalAds = new WP_Query( $legalAdsArgs );
  $hasLegalAds = $recentLegalAds->post_count ? true : false;
} else { $recentLegalAds = null; }

// The Query
$recentNews = new WP_Query( $args );
$totalNews = $recentNews->post_count;
$newsWrapperSize = $hasLegalAds ? "col-md-7 col-12" : "col-12";
$newsItemSize = $hasLegalAds ? "col-12 col-md-6" : "col-12 col-md-6 col-lg-4";
$legalAdsWrapperSize = "col-md-5 col-12";

$newsCount = 0;

// The Loop
if ($newsEnabled && $recentNews->have_posts()): ?>
<div class="row section-news-ads no-gutters">
  <div class="<?php echo $newsWrapperSize; ?> news-wrapper padded-area">
    <header>
      <h2 class="accent-line-blue">Latest News</h2>
    </header>
    <div class="content container-fluid px-0">
      <div class="row">
        <?php while($recentNews->have_posts()): $newsCount++; $recentNews->the_post();
          if (!($hasLegalAds && $newsCount > 2)): ?>
        <div class="<?php echo $newsItemSize; ?> <?php if ($newsCount > 2) echo "d-none d-lg-block"; ?>">
          <?php get_template_part('template-part', 'preview-post'); ?>
        </div>
        <?php endif; endwhile; wp_reset_postdata(); ?>
      </div>
    </div>
    <footer class="text-right">
      <a href="/news" class="view-more-cta">View More</a>
    </footer>
  </div>

  <?php if ($hasLegalAds): ?>
  <div class="<?php echo $legalAdsWrapperSize; ?> ads-wrapper bg-light padded-area">
    <header>
      <h2 class="accent-line-orange">Legal Ads</h2>
    </header>

    <div class="content">
      <?php while($recentLegalAds->have_posts()): $recentLegalAds->the_post(); ?>
        <?php get_template_part('template-part', 'preview-legal-ad'); ?>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>

    <footer class="text-left">
      <a href="#" class="view-more-cta">View More</a>
    </footer>
  </div>
  <?php endif; ?>
</div>
<?php endif; ?>