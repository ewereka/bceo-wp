<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header(); 

$collections = get_terms( array(
  "taxonomy" => "collection",
) );
$expanded = true;

get_template_part('template-part-hero', 'archive', $post_type);

?>
  <div class="main">
    <div class="row section-faqs justify-content-center my-4 py-4">
      <div class="col-10">
        <h2 class="p-2 text-center bg-warning text-dark"><i class="fa fa-search"></i> How Do I?</h2>

        <div class="accordion" id="faqsAccordion">
          <?php foreach($collections as $collection): 
            $faqs = new WP_Query(
              array(
                  'posts_per_page' => -1,
                  'post_type' => 'faq',
                  'tax_query' => array(
                      array(
                          'taxonomy' => 'collection',
                          'field' => 'slug',
                          'terms' => $collection->slug,
                      )
                  )
              )
            );  

            if ($faqs->have_posts()): ?>
            <div class="card card-faq-category rounded-0">
              <button class="btn btn-primary btn-block text-left rounded-0" id="faqs-<?php echo $collection->slug; ?>-heading" data-toggle="collapse" data-target="#faqs-<?php echo $collection->slug; ?>" aria-expanded="<?php echo $expanded ? "true" : "false"; ?>">
                <h2 class="h3 mb-0 card-title"><?php echo $collection->name; ?></h2>
              </button>

              <div id="faqs-<?php echo $collection->slug; ?>" class="collapse <?php echo $expanded ? "show" : ""; ?>" aria-labelledby="faqs-<?php echo $collection->slug; ?>-heading" data-parent="#faqsAccordion">
                <div class="card-body">
                  <?php while($faqs->have_posts()): $faqs->the_post(); ?>
                  <article class="faq">
                    <header><h4><?php the_title(); ?><h4></header>

                    <div class="content">
                      <?php the_content(); ?>
                    </div>

                    <!-- <footer class="meta-fields">
                      <p><a href="#" class="meta cta">Permits</a></p>
                    </footer> -->
                  </article>
                  <?php endwhile; ?>
                </div>
              </div>
            </div>
          <?php 
              $faqs = null;
            endif;
            $expanded = false;
          endforeach; wp_reset_query(); ?>

        </div><!-- .accordion -->

      </div>
    </div>
  </div>

<?php get_footer(); ?>