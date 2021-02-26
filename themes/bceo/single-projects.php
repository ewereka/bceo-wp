<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header();
get_template_part("partials/hero", $post_type);
?>

<div class="main">
  <div class="row section-blog-post justify-content-center my-4 py-4">
    <div class="col-11 col-lg-10">
      <div class="row blog">
        <div class="col-12">
          <?php if (have_posts()):
            while (have_posts()):

              the_post();
              $post_categories = get_the_category();
              $nice_categories = [];
              foreach ($post_categories as $post_category) {
                $nice_categories[] = $post_category->name;
              }
              $nice_categories = implode(", ", $nice_categories);
              ?>
            <article <?php post_class("blog-post"); ?>>
              
              <header class="entry-header">
                <?php if (
                  get_field("funding")
                ): ?><h4 class="my-0">Funding: <?php the_field(
  "funding"
);endif; ?>
                <?php if (
                  get_field("start_date")
                ): ?><h4 class="my-0">Funding: <?php the_field(
  "start_date"
);endif; ?>
              </header>

              <div class="entry-content my-4">
                <?php the_content(); ?>
              </div>
            </article>
          <?php
            endwhile;
          endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_template_part("partials/recent-projects"); ?>

<?php get_footer();
?>
