<?php
setlocale(LC_MONETARY, 'en_US'); ?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
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
            <li class="text-lowercase divide-after"><a href="#">Employee Portal</a></li>
            
            <li class="icon"><a href="#"><i class="fab fa-twitter"></i><span class="sr-only">Twitter</span></a></li>
            <li class="icon"><a href="#"><i class="fab fa-facebook-f"></i><span class="sr-only">Facebook</span></a></li>
            <li class="icon divide-after"><a href="#"><i class="fab fa-instagram"></i><span class="sr-only">Instagram</span></a></li>
            
            <li class="icon search-toggle"><a href="#"><i class="fa fa-search"></i><span class="sr-only">Search</span></a></li>
          </ul>
        </nav>
        
      </div>
    </div>
    
    <div class="branding row justify-content-between align-items-center no-gutters">
      <div class="col-auto">
        <h1 class="text-hide logo my-0">Butler County Engineer's Office</h1>
      </div>
      <nav class="col-auto">
        <ul class="branding-links align-items-center">
          <li class="icon"><a href="mailto:hello@bceo.org" target="_blank">
            <strong><i class="far fa-envelope"></i>Email Us</strong>
            <span class="text-lowercase">hello@bceo.org</span>
          </a></li>
          
          <li class="icon">
            <strong><i class="far fa-clock"></i>Our Hours</strong>
            M-F 7am-4pm
          </li>
          
          <li><a href="tel:+1-513-867-5744" class="btn btn-primary">
            <strong>Need to call us?</strong>
            (513) 867-5744
          </a></li>
        </ul>
      </nav>
    </div>
    
    <div class="main-nav row no-gutters">
      <nav class="col-11">
      <?php 
        wp_nav_menu( array(
          'theme_location'  => 'main-menu',
          'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
          'container'       => false,
          'menu_class'      => 'flex-fill',
          'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
          'walker'          => new WP_Bootstrap_Navwalker(),
        ) ); ?>
        <ul class="flex-fill">
          <li><a href="/">
            Home
          </a></li>
          <li>
            <a href="/about">About Us</a>
            <ul>
              <li><a href="/faq">FAQs</a></li>
            </ul>
          </li>
          <li><a href="/news">
            News
          </a></li>
          <li><a href="/road-reports">
            Road Reports
          </a></li>
          <li><a href="/projects">
            Projects
          </a></li>
          <li><a href="/education">
            Education
          </a></li>
          <li><a href="http://gis.bceo.org/" target="_blank">
            Tax Map
          </a></li>
          <li><a href="/work-with-bceo">
            Work with BCEO
          </a></li>
        </ul>
      </nav>
    </div>
  </header>