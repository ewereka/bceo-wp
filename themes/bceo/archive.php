<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header();
$validSort = false;
$sort = isset($_REQUEST["sort"]) ? $_REQUEST["sort"] : null;

$post_type = $post_type ? $post_type : "post";

$all_posts = new WP_Query([
  "posts_per_page" => -1,
  "post_type" => $post_type,
]);

$sort_tax = get_sort_taxonomy($post_type);
$all_terms = get_terms($sort_tax, [
  "hide_empty" => false,
]);

if (count($all_terms) > 1) {
  foreach ($all_terms as $term) {
    if ($sort === $term->slug) {
      $validSort = true;
    }
  }
}

switch ($post_type) {
  case "projects":
    $blogClass = "projects";
    $blogListClass = "projects-list";
    break;
  case "resources":
    $blogClass = "resources";
    $blogListClass = "resources-list";
  default:
    $blogClass = "blog";
    $blogListClass = "blog-list";
}

get_template_part("partials/hero", "archive", $post_type);
?>

<div class="main">
  <div class="row section-faqs justify-content-center my-4 py-4">
    <div class="col-10 <?php echo $blogClass; ?> its-sortable">
      <?php if (count($all_terms) > 1): ?>
      <div class="row">
        <nav class="col-12">
          <ul class="nav nav-sorter its-sortable-nav" data-its-sortable-prefix="<?php echo $sort_tax; ?>">
            <li class="nav-item"><a href="#" class="its-sortable-link nav-link<?php if (
              !$validSort
            ) {
              echo " active";
            } ?>" data-its-sortable-term="*">All Posts</a></li>
            <?php foreach ($all_terms as $sort_term): ?>
            <li class="nav-item"><a href="#" class="its-sortable-link nav-link<?php if (
              $validSort &&
              $sort === $sort_term->slug
            ) {
              echo " active";
            } ?>" data-its-sortable-term="<?php echo $sort_term->slug; ?>"><?php echo $sort_term->name; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </div>
      <?php endif; ?>

      <?php if ($all_posts->have_posts()): ?>
        <div class="row <?php echo $blogListClass; ?>">
          <?php while ($all_posts->have_posts()):
            $all_posts->the_post();
            get_template_part("partials/sortable-item", $post_type);
          endwhile; ?>
        </div>
      <?php endif; ?>
      
      </div>
    </div>
  </div>
</div>

<?php get_footer();
?>
