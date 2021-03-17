<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header();

$post_type = $post_type ? $post_type : "post";
get_template_part("partials/hero", $post_type);
?>

<div class="main">
<?php if (have_posts()):
  while (have_posts()):

    the_post();
    $post_categories = get_the_terms($post, "resource_type");
    $nice_categories = [];
    foreach ($post_categories as $post_category) {
      $nice_categories[] = $post_category->name;
    }
    $nice_categories = implode(", ", $nice_categories);
    ?>
  <div class="row section-blog-post justify-content-center my-4 py-4">
    <div class="col-11 col-lg-10">
      <div class="row blog">
        <div class="col-12 col-lg-8">
            <article <?php post_class("blog-post"); ?>>
              
              <header class="entry-header">
                <h1 class="h2 entry-title"><strong><?php the_title(); ?></strong></h1>

                <div class="meta-fields">
                  <p class="meta category"><i class="far fa-folder"></i> <?php echo $nice_categories; ?></p>
                </div>
              </header>

              <div class="entry-content my-4">
                <?php the_content(); ?>
              </div>
            </article>
        </div>

        <div class="d-none d-lg-block col-lg-4">
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
        </div>
      </div>
    </div>
  </div>
  <?php if (have_rows("attachments")): ?>
  <div class="row section-attachments bg-primary no-gutters padded-area">
    <div class="col-12 text-light">
      <h2 class="accent-line-yellow">Downloads</h2>
    </div>
    <?php while (have_rows("attachments")):

      the_row();
      $file = get_sub_field("attachment");
      ?>
    <div class="col-auto">
      <?php switch ($file["mime_type"]) {
        case "application/pdf":
          $file_icon = "fas fa-file-pdf text-error";
          break;
        case "application/msword":
        case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
          $file_icon = "fas fa-file-word text-primary";
          break;
        case "application/vnd.ms-excel":
        case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
          $file_icon = "fas fa-file-excel text-success";
          break;
        case "application/zip":
          $file_icon = "fas fa-file-archive";
          break;
        case "application/vnd.ms-powerpoint":
        case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
          $file_icon = "fas fa-file-powerpoint text-warning";
          break;
        default:
          $file_icon = "fas fa-file-download";
      } ?>
      <a class="attachment-link" href="<?php echo $file["url"]; ?>">
        <i class="icon <?php echo $file_icon; ?>"></i>
        <p class="filename"><?php echo $file["title"]; ?></p>
      </a>
    </div>
  <?php
    endwhile; ?>
  </div>
    <?php endif; ?>
<?php
  endwhile;
endif; ?>

  <div class="bg-light">
  <?php get_template_part("partials/recent-news"); ?>
  </div>
</div>


<?php get_footer(); ?>
