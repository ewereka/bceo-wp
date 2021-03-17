<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header();

$all_posts = new WP_Query([
  "posts_per_page" => -1,
  "post_type" => $post_type,
]);

get_template_part("partials/hero", "archive", $post_type);
?>

<div class="main">
  <div class="row section-contracts justify-content-center my-4 py-4">
    <div class="col-12 col-lg-10 staff">
      <?php if ($all_posts->have_posts()): ?>
        <h1 class="entry-title">Staff Directory</h1>

        <div class="row staff-list">
          <?php while ($all_posts->have_posts()):
            $all_posts->the_post(); ?>
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
              <div class="card staff-list-card p-0">
                <figure class="card-img-top staff-list-avatar">

                </figure>
                <div class="card-body p-2 text-center">
                  <h6 class="card-title"><strong><?php the_title(); ?></strong></h6>
                </div>
              </div>
            </div>
            <?php
          endwhile; ?>
        </div>
      <?php endif; ?>
      
      </div>
    </div>
  </div>
</div>

<?php get_footer();
?>
