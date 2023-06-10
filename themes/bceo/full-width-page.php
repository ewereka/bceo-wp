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
<?php if (have_posts()):
  while (have_posts()):
    the_post();
    if (!empty(get_the_content())): ?>
  <div class="row section-blog-post justify-content-center my-4 py-4">
    <div class="col-11 col-lg-10">
      <article <?php post_class("blog-post"); ?>>
        <!--
        <header class="entry-header">
          <h1 class="entry-title"><strong><?php the_title(); ?></strong></h1>
        </header>
        -->

        <div class="entry-content my-4">
          <?php the_content(); ?>
        </div>
      </article>
    </div>
  </div>
  <?php endif;
  endwhile;
endif; ?>
  <?php get_template_part("partials/attachments"); ?>
</div>

<?php get_footer();
?>
