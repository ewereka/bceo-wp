<?php
setlocale(LC_MONETARY, "en_US"); ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo("charset"); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>

  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<header class="site-header container-fluid">
    <div class="pre-header">
      <div class="row bg-light py-2 px-2 justify-content-between align-items-center">
        <div class="col-auto">
          <address class="my-0">1921 Fairgrove Avenue (Ohio 4) Hamilton, OH 45011</address>
        </div>
        
        <nav class="col-auto">
          <ul class="pre-header-links justify-content-end my-0">            
            <?php if (have_rows("social_media", "option")):
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
                    '<li class="%s"><a href="%s" target="_blank"><i class="%s"></i><span class="sr-only">%s</span></a></li>',
                    $lastSocialIndex === get_row_index()
                      ? "icon divide-after"
                      : "icon",
                    $url,
                    $icon,
                    $label
                  );
                }
                ?>
            <?php
              endwhile;
            endif; ?>
            
            <li class="icon search-toggle"><a href="#"><i class="fa fa-search"></i><span class="sr-only">Search</span></a></li>
          </ul>
        </nav>
        
      </div>
    </div>
    
    <div class="branding row justify-content-between align-items-top no-gutters">
      <div class="col-auto">
        <?php if (function_exists("the_custom_logo")) {
          the_custom_logo();
        } ?>
      </div>
      <nav class="col-auto">
        <ul class="branding-links align-items-top">
          <?php
          $contactEmail = get_field("contact_email", "option");
          if ($contactEmail): ?>
          <li class="icon"><a href="<?php printf(
            "mailto:%s",
            $contactEmail
          ); ?>" target="_blank">
            <strong><i class="far fa-envelope"></i>Email Us</strong>
            <span class="text-lowercase"><?php echo $contactEmail; ?></span>
          </a></li>
          <?php endif;
          ?>
          
          <?php
          $contactHours = get_field("contact_hours", "option");
          if ($contactHours): ?>
          <li class="icon"><a href="<?php printf(
            "mailto:%s",
            $contactEmail
          ); ?>" target="_blank">
            <strong><i class="far fa-clock"></i>Our Hours</strong>
            <?php echo $contactHours; ?>
          </a></li>
          <?php endif;
          ?>

          <?php
          $contactPhone = get_field("contact_phone", "option");
          if ($contactPhone): ?>
          <li><a href="<?php printf(
            "tel:%s",
            $contactPhone
          ); ?>" class="btn btn-primary">
            <strong><i class="fas fa-phone-alt"></i> Need to call us?</strong>
            (513) 867-5744
          </a></li>
          <?php endif;
          ?>          
        </ul>
      </nav>
    </div>
    
    <div class="main-nav row no-gutters">
      <nav class="col-12 col-xl-11">
      <?php wp_nav_menu([
        "theme_location" => "main-menu",
        "depth" => 2, // 1 = no dropdowns, 2 = with dropdowns.
        "container" => false,
        "menu_class" => "flex-fill",
        // 'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
        // 'walker'          => new WP_Bootstrap_Navwalker(),
      ]); ?>
      </nav>
    </div>
  </header>