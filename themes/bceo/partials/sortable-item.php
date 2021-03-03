<?php
$sort_tax = get_sort_taxonomy($post_type);
$post_terms = get_the_terms($post, $sort_tax);
$nice_terms = [];
$class_terms = [];
if ($post_terms) {
  foreach ($post_terms as $post_term) {
    $nice_terms[] = $post_term->name;
    $class_terms[] = sprintf("%s-%s", $sort_tax, $post_term->slug);
  }
}

$nice_terms = implode(", ", $nice_terms);
$class_terms = implode(" ", $class_terms);

switch ($post_type) {
  case "projects":
    $spacingClass = "";
    break;
  default:
    $spacingClass = "mb-4";
}
?>
<div class="its-sortable-item <?php echo $class_terms; ?> col-lg-4 col-sm-6 col-12 <?php echo $spacingClass; ?>">
  <?php if ($post_type === "projects"):
    get_template_part("partials/preview", $post_type);
  else:
     ?>
  <article class="blog-preview rounded-0 p-2 bg-light">
    <a href="<?php the_permalink(); ?>"><figure><?php bceo_featured_image(); ?></figure></a>
    <header class="row no-gutters">
      <h5 class="order-3 col-12 mt-1 mb-3"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
      
      <div class="meta-fields order-2 col-12">
        <p class="meta category"><i class="far fa-folder"></i> <?php echo $nice_terms; ?></p>
        <p class="meta date"><i class="far fa-calendar-alt"></i> <?php the_date(
          "F j, Y"
        ); ?></p>
      </div>
    </header>

    <div class="content">
      <p><?php the_excerpt(); ?></p>
      <p><a href="<?php the_permalink(); ?>" class="view-more-cta">Read More</a></p>
    </div>
  </article>
  <?php
  endif; ?>
</div><!-- .its-sortable-item -->