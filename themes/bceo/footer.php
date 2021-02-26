<footer class="site-footer container-fluid text-white">
  <div class="row padded-area align-items-top">
    <div class="col-12 col-lg-3">
      <?php if (function_exists("the_custom_logo")) {
        the_custom_logo();
      } ?>

      <?php if (is_active_sidebar("footer-widget-area-1")): ?>
      <div class="footer-widget-area" id="footer-widget-area-1>
        <?php dynamic_sidebar("footer-widget-area-1"); ?>
      </div>
      <?php endif; ?>
    </div>
    
    <div class="col-12 col-sm-6 col-lg-3">
      <h5>Contact</h5>
      <small>
        <address class="text mb-0">1921 Fairgrove Avenue (Ohio 4)
          Hamilton, OH 45011</address>
          <p class="mb-0"><a href="tel:+1-513-867-5744">(513) 867-5744</a></p>
          <p><a href="mailto:hello@bceo.org">hello@bceo.org</a></p>
        </address>
      </small>

      <?php if (is_active_sidebar("footer-widget-area-2")): ?>
      <div class="footer-widget-area" id="footer-widget-area-2>
        <?php dynamic_sidebar("footer-widget-area-2"); ?>
      </div>
      <?php endif; ?>
    </div>
    
    <div class="col-12 col-sm-6 col-lg-3">
      <h5>Resources</h5>
      <small>
        <p class="text-uppercase;">
          Butler County, Ohio<br>
          <a href="#">Visit &raquo;</a>
        </p>
        <p class="text-uppercase;">
          County Commissioner<br>
          <a href="#">Visit &raquo;</a>
        </p>
      </small>

      <?php if (is_active_sidebar("footer-widget-area-3")): ?>
      <div class="footer-widget-area" id="footer-widget-area-3">
        <?php dynamic_sidebar("footer-widget-area-3"); ?>
      </div>
      <?php endif; ?>
    </div>
    
    <div class="col-12 col-sm-6 col-lg-3">
      <!-- <h5 class="mb-4">Search the Site <i class="fa fa-search"></i></h5> -->
      
      <?php if (have_rows("social_media", "option")): ?>
      <h5>Follow Us</h5>
      <ul class="social-icons">
      <?php
      $lastSocialIndex = count(get_field("social_media", "option"));
      while (have_rows("social_media", "option")):

        the_row();
        $socialLayout = get_row_layout();
        switch ($socialLayout) {
          case "linkedin":
            $icon = "fab fa-linkedin";
            $url = get_sub_field("url");
            $label = "LinkedIn";
            break;
          case "youtube":
            $icon = "fab fa-youtube";
            $url = get_sub_field("url");
            $label = "YouTube";
            break;
          case "facebook":
            $icon = "fab fa-facebook-f";
            $url = get_sub_field("url");
            $label = "Facebook";
            break;
          case "twitter":
          case "instagram":
            $icon = sprintf("fab fa-%s", $socialLayout);
            $url = sprintf(
              "https://%s.com/%s",
              $socialLayout,
              trim(get_sub_field("handle"), ' @\n\r\t\v\0')
            );
            $label = ucfirst($socialLayout);
            break;
          default:
            $url = false;
        }
        if ($url) {
          printf(
            '<li class="icon"><a href="%s" target="_blank"><i class="%s"></i><span class="sr-only">%s</span></a></li>',
            $url,
            $icon,
            $label
          );
        }
        ?>
      <?php
      endwhile;
      ?>
      </ul>
      <?php endif; ?>

      <?php if (is_active_sidebar("footer-widget-area-4")): ?>
      <div class="footer-widget-area" id="footer-widget-area-4">
        <?php dynamic_sidebar("footer-widget-area-4"); ?>
      </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="sub-footer row px-5 bg-warning text-dark">
    <div class="col-auto"><a href="#" class="text-dark text-lowercase"><small><?php _e(
      "Employee Portal",
      "com.ewereka.bceo.theme"
    ); ?></small></a></a>
  </div>
</footer>

<a href="#" class="btn btn-primary btn-back-to-top" rel="nofollow">
  <i class="fas fa-chevron-up" role="img"></i>
  <span class="hover-text">Back to Top</a>
</a>

<?php wp_footer(); ?>
</body>
</html>
