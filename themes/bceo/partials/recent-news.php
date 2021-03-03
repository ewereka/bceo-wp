<?php
if (is_front_page()) {
  $newsEnabled = get_field("latest_news_enabled", "option");
  $announcementsEnabled = $newsEnabled
    ? get_field("announcements_enabled", "option")
    : false;
} else {
  $newsEnabled = true;
  $announcementsEnabled = false;
}

$hasAnnouncements = false;
$totalNews = 0;

$args = [
  "post_type" => ["post"],
  "post_status" => ["publish"],
  "posts_per_page" => "3",
];

if (is_single() && $post_type === "post") {
  $args["post__not_in"] = [get_the_ID()];
}

if (is_front_page() && $announcementsEnabled) {
  $args["category__not_in"] = [38];

  $announcementsArgs = [
    "post_type" => ["post"],
    "post_status" => ["publish"],
    "posts_per_page" => "3",
    "category__in" => [38],
  ];
  $recentAnnouncements = new WP_Query($announcementsArgs);
  $hasAnnouncements = $recentAnnouncements->post_count ? true : false;
} else {
  $recentAnnouncements = null;
}

// The Query
$recentNews = new WP_Query($args);
$totalNews = $recentNews->post_count;
$newsWrapperSize = $hasAnnouncements ? "col-md-7 col-12" : "col-12";
$newsItemSize = $hasAnnouncements
  ? "col-12 col-md-6"
  : "col-12 col-md-6 col-lg-4";
$announcementsWrapperSize = "col-md-5 col-12";

$newsCount = 0;

// The Loop
if ($newsEnabled && $recentNews->have_posts()): ?>
<div class="row section-news-ads no-gutters">
  <div class="<?php echo $newsWrapperSize; ?> news-wrapper padded-area">
    <header>
      <h2 class="accent-line-blue"><?php the_field(
        "latest_news_heading",
        "option",
        __("Latest News", "com.ewereka.bceo.theme")
      ); ?></h2>
    </header>
    <div class="content container-fluid px-0">
      <div class="row">
        <?php
        while ($recentNews->have_posts()):
          $newsCount++;
          $recentNews->the_post();
          if (!($hasAnnouncements && $newsCount > 2)): ?>
        <div class="<?php echo $newsItemSize; ?> <?php if ($newsCount > 2) {
   echo "d-none d-lg-block";
 } ?>">
          <?php get_template_part("partials/preview-post"); ?>
        </div>
        <?php endif;
        endwhile;
        wp_reset_postdata();
        ?>
      </div>
    </div>
    <footer class="text-right">
      <a href="<?php echo get_post_type_archive_link(
        "post"
      ); ?>" class="view-more-cta"><?php _e(
  "View More",
  "com.ewereka.bceo.theme"
); ?></a>
    </footer>
  </div>

  <?php if ($hasAnnouncements): ?>
  <div class="<?php echo $announcementsWrapperSize; ?> ads-wrapper bg-light padded-area">
    <header>
      <h2 class="accent-line-orange"><?php the_field(
        "announcements_heading",
        "option",
        __("Announcements", "com.ewereka.bceo.theme")
      ); ?></h2>
    </header>

    <div class="content">
      <?php
      while ($recentAnnouncements->have_posts()):
        $recentAnnouncements->the_post(); ?>
        <?php get_template_part("partials/preview-announcement"); ?>
      <?php
      endwhile;
      wp_reset_postdata();
      ?>
    </div>

    <footer class="text-left">
      <a href="<?php echo get_post_type_archive_link(
        "post"
      ); ?>?sort=announcements" class="view-more-cta"><?php _e(
  "View More",
  "com.ewereka.bceo.theme"
); ?></a>
    </footer>
  </div>
  <?php endif; ?>
</div>
<?php endif;
?>
