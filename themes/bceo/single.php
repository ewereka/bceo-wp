<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header(); ?>

<?php // page_hero('News Release', 'img/photos/blog-hero.jpg'); ?>

<div class="main">
  <div class="row section-blog-post justify-content-center my-4 py-4">
    <div class="col-11 col-lg-10">
      <div class="row blog">
        <div class="col-12 col-md-8 col-lg-9">
          <?php if (have_posts()): while(have_posts()): the_post(); 
            $post_categories = get_the_category();
            $nice_categories = [];
            foreach ($post_categories as $post_category) {
              $nice_categories[] = $post_category->name;
            }
            $nice_categories = implode(", ", $nice_categories);
          ?>
            <article <?php post_class('blog-post'); ?>>
              
              <header class="entry-header">
                <?php if ( has_post_thumbnail() ): ?><figure><?php the_post_thumbnail('full', ['class' => 'img-fluid']); ?></figure><?php endif; ?>

                <h1 class="h2 entry-title"><strong><?php the_title(); ?></strong></h1>

                <div class="meta-fields">
                  <p class="meta category"><i class="far fa-folder"></i> <?php echo $nice_categories; ?></p>
                  <p class="meta date"><i class="far fa-calendar-alt"></i> <?php the_date('F j, Y'); ?></p>
                </div>
              </header>

              <div class="entry-content my-4">
                <?php the_content(); ?>
              </div>

              <div class="entry-contact-information mt-5">
                  <h5 style="text-transform: none;">For more information, contact:</h5>

                  <ul class="no-bullets">
                    <li><a href="#">Betsy Horton</a>, BCEO Public Information Specialist</li>
                    <li><a href="#">Greg Wilkens, P.E., P.S.</a>, Butler County Engineer</li>
                    <li>Phone: <a href="tel:+1-513-867-5744">(513) 867-5744</a></li>
                  </ul>
                </div>
            </article>
          <?php endwhile; endif; ?>
        </div>

        <div class="d-none d-md-block col-md-4 col-lg-3">
          <form class="sidebar-search">
            <input class="d-inline" type="text" placeholder="Search" name="query">
            <button type="button" class="btn d-inline" title="Search"><i class="fa fa-search"></i></button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php get_footer(); ?>
