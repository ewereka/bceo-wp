<?php
/**
 * Template Name: Full Width
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header();
get_template_part("partials/hero", $post_type);
?>

<div class="main">
  <div class="row section-blog-post justify-content-center my-4 py-4">
    <div class="col-11 col-lg-10">
      <div class="row">
        <div class="col-12">
          <?php if (have_posts()):
            while (have_posts()):
              the_post(); ?>
            <article <?php post_class("blog-post"); ?>>
              
              <header class="entry-header">
                <h1 class="entry-title"><strong><?php the_title(); ?></strong></h1>
              </header>

              <div class="entry-content my-4">
                <?php the_content(); ?>
              </div>
            </article>
          <?php
            endwhile;
          endif; ?>
        </div>
        <!-- <div class="col-lg-4 col-12">
          <?php if (has_post_thumbnail()): ?>
          <figure>
            <?php the_post_thumbnail("full", [
              "class" => "entry-featured-img img-fluid",
            ]); ?>
          </figure>
          <?php endif; ?>

          <?php if (is_active_sidebar("sidebar-widget-area-page")): ?>
          <div class="sidebar-widget-area" id="footer-widget-area-page">
            <?php dynamic_sidebar("footer-widget-area-page"); ?>
          </div>
          <?php endif; ?>
        </div> -->
      </div>
    </div>
  </div>
</div>

<?php get_footer();
?>
