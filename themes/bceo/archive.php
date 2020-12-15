<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header(); 
$post_type = $post_type ? $post_type : 'post';

$all_posts = new WP_Query(
  array(
      'posts_per_page' => -1,
      'post_type' => $post_type
  )
);

$sort_tax = get_sort_taxonomy($post_type);
$all_terms = get_terms($sort_tax, array(
  'hide_empty' => false
));

get_template_part('template-part-hero', 'archive', $post_type); ?>

<div class="main">
  <div class="row section-faqs justify-content-center my-4 py-4">
    <div class="col-10 blog its-sortable">
      <?php if (count($all_terms) > 1): ?>
      <div class="row">
        <nav class="col-12">
          <ul class="nav nav-sorter its-sortable-nav" data-its-sortable-prefix="<?php echo $sort_tax; ?>">
            <li class="nav-item"><a href="#" class="its-sortable-link nav-link" data-its-sortable-term="*">All Posts</a></li>
            <?php foreach ($all_terms as $sort_term): ?>
            <li class="nav-item"><a href="#" class="its-sortable-link nav-link" data-its-sortable-term="<?php echo $sort_term->slug; ?>"><?php echo $sort_term->name; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </nav>
      </div>
      <?php endif; ?>

      <?php if ($all_posts->have_posts()): ?>
        <div class="row blog-list">
          <?php while ($all_posts->have_posts()): $all_posts->the_post(); 
            $post_terms = get_the_terms($post, $sort_tax);
            $nice_terms = [];
            $class_terms = [];
            if ($post_terms) {
              foreach ($post_terms as $post_term) {
                $nice_terms[] = $post_term->name;
                $class_terms[] = sprintf('%s-%s', $sort_tax, $post_term->slug);
              }
            }
            
            $nice_terms = implode(", ", $nice_terms);
            $class_terms = implode(" ", $class_terms);
          ?>

            <div class="its-sortable-item <?php echo $class_terms; ?> col-lg-4 col-sm-6 col-12 mb-4">
              <article class="blog-preview rounded-0 p-2 bg-light">
                <?php if ( has_post_thumbnail() ): ?><figure><?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?></figure><?php endif; ?>
                <header class="row no-gutters">
                  <h5 class="order-3 col-12 mt-1 mb-3"><?php the_title(); ?></h5>
                  
                  <div class="meta-fields order-2 col-12">
                    <p class="meta category"><i class="far fa-folder"></i> <?php echo $nice_terms; ?></p>
                    <p class="meta date"><i class="far fa-calendar-alt"></i> <?php the_date('F j, Y'); ?></p>
                  </div>
                </header>

                <div class="content">
                  <p><?php the_excerpt(); ?></p>
                  <p><a href="<?php the_permalink(); ?>" class="view-more-cta">Read More</a></p>
                </div>
              </article>
            </div><!-- .its-sortable-item -->
          <?php endwhile; ?>
        </div>
      <?php endif; ?>
                
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>