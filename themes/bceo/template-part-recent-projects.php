<?php 

$args =  array(
	'post_type'              => array( 'projects' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page'         => '3',
);

if (is_single() && $post_type === 'projects') {
  $args['post__not_in'] = array(get_the_ID());
}

// The Query
$recentProjects = new WP_Query( $args );
$projectCount = 0;

// The Loop
if ( $recentProjects->have_posts() ): ?>
<div class="row section-recent-projects no-gutters">
  <div class="col-12 recent-projects-wrapper bg-dark text-light padded-area parallax">
    <header>
      <h2 class="accent-line-yellow">Recent Projects</h2>
    </header>
    <div class="content container-fluid px-0">
      <div class="row">
        <?php while ( $recentProjects->have_posts() ): $projectCount++; $recentProjects->the_post(); ?>
        <div class="col-md-6 col-xl-4 <?php if ($projectCount > 2) echo 'd-none d-xl-block'; ?>">
          <?php get_template_part('template-part', 'preview-projects'); ?>
        </div>  
        <?php endwhile; ?>
      </div>
    </div>
    <?php if (is_front_page()): ?>
    <footer class="text-right text-light">
      <a href="/projects" class="view-more-cta text-light">View More</a>
    </footer>
    <?php endif; ?>
  </div>
</div>
<?php endif; wp_reset_postdata(); ?>