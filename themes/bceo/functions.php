<?php
require_once dirname(__FILE__) . "/inc/class.wp-bootstrap-navwalker.php";
require_once dirname(__FILE__) . "/inc/_inc_helpers.php";
require_once dirname(__FILE__) . "/inc/_inc_gutenberg_mods.php";
require_once dirname(__FILE__) . "/inc/_inc_image_sizes.php";
require_once dirname(__FILE__) . "/inc/_inc_customizer.php";
require_once dirname(__FILE__) . "/inc/_inc_shortcodes.php";

add_action("after_setup_theme", "ewereka_setup");
function ewereka_setup()
{
  load_theme_textdomain(
    "com.ewereka.bceo.theme",
    get_template_directory() . "/languages"
  );
  add_theme_support("title-tag");
  add_theme_support("automatic-feed-links");

  add_theme_support("post-formats", [
    "link",
    "aside",
    "gallery",
    "image",
    "quote",
    "status",
    "video",
    "audio",
    "chat",
  ]);

  add_theme_support("post-thumbnails");

  add_theme_support("html5", [
    "search-form",
    "comment-form",
    "comment-list",
    "gallery",
    "caption",
    "style",
    "script",
    "navigation-widgets",
  ]);

  add_theme_support("responsive-embeds");
  add_theme_support("customize-selective-refresh-widgets");
  add_theme_support("wp-block-styles");
  add_theme_support("align-wide");

  add_theme_support("custom-logo", [
    "width" => 280,
    "flex-height" => true,
    "header-text" => ["site-title"],
    "unlink-homepage-logo" => true,
  ]);

  global $content_width;
  if (!isset($content_width)) {
    $content_width = 1920;
  }
  register_nav_menus([
    "main-menu" => esc_html__("Main Menu", "com.ewereka.bceo.theme"),
  ]);
}

add_action("wp_enqueue_scripts", "ewereka_load_scripts");
function ewereka_load_scripts()
{
  wp_enqueue_style("style", get_stylesheet_uri());
  wp_enqueue_style(
    "ewereka-icons",
    get_template_directory_uri() . "/font/vendor/fontawesome/css/all.min.css",
    ["style"]
  );
  wp_enqueue_style(
    "ewereka-style",
    get_template_directory_uri() . "/css/main.css",
    ["style", "ewereka-icons"]
  );
  wp_enqueue_script("jquery");
  wp_enqueue_script(
    "ewereka-scripts",
    get_template_directory_uri() . "/js/dist/main.js",
    ["jquery"],
    null,
    true
  );
}
add_action("wp_footer", "ewereka_footer_scripts");
function ewereka_footer_scripts()
{
  ?>
  <script>
  jQuery(document).ready(function ($) {
    var deviceAgent = navigator.userAgent.toLowerCase();
    if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
      $("html").addClass("ios");
      $("html").addClass("mobile");
    }
    if (navigator.userAgent.search("MSIE") >= 0) {
      $("html").addClass("ie");
    }
    else if (navigator.userAgent.search("Chrome") >= 0) {
      $("html").addClass("chrome");
    }
    else if (navigator.userAgent.search("Firefox") >= 0) {
      $("html").addClass("firefox");
    }
    else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
      $("html").addClass("safari");
    }
    else if (navigator.userAgent.search("Opera") >= 0) {
      $("html").addClass("opera");
    }
  });
  </script>
  <?php
}
add_filter("document_title_separator", "ewereka_document_title_separator");
function ewereka_document_title_separator($sep)
{
  $sep = "|";
  return $sep;
}
add_filter("the_title", "ewereka_title");
function ewereka_title($title)
{
  if ($title == "") {
    return "...";
  } else {
    return $title;
  }
}
add_filter("the_content_more_link", "ewereka_read_more_link");
function ewereka_read_more_link()
{
  if (!is_admin()) {
    return ' <a href="' .
      esc_url(get_permalink()) .
      '" class="more-link">...</a>';
  }
}
add_filter("excerpt_more", "ewereka_excerpt_read_more_link");
function ewereka_excerpt_read_more_link($more)
{
  if (!is_admin()) {
    global $post;
    return ' <a href="' .
      esc_url(get_permalink($post->ID)) .
      '" class="more-link">...</a>';
  }
}
add_filter(
  "intermediate_image_sizes_advanced",
  "ewereka_image_insert_override"
);
function ewereka_image_insert_override($sizes)
{
  unset($sizes["medium_large"]);
  return $sizes;
}
add_action("widgets_init", "ewereka_widgets_init");
function ewereka_widgets_init()
{
  register_sidebar([
    "name" => esc_html__("Pages Sidebar", "com.ewereka.bceo.theme"),
    "id" => "sidebar-widget-area-page",
    "class" => "sidebar-widget-area",
    "before_widget" => '<div id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</div>",
    "before_title" => '<h5 class="widget-title">',
    "after_title" => "</h5>",
  ]);

  register_sidebar([
    "name" => esc_html__("News Sidebar", "com.ewereka.bceo.theme"),
    "id" => "sidebar-widget-area-post",
    "class" => "sidebar-widget-area",
    "before_widget" => '<div id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</div>",
    "before_title" => '<h5 class="widget-title">',
    "after_title" => "</h5>",
  ]);

  register_sidebar([
    "name" => esc_html__("Projects Sidebar", "com.ewereka.bceo.theme"),
    "id" => "sidebar-widget-area-projects",
    "class" => "sidebar-widget-area",
    "before_widget" => '<div id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</div>",
    "before_title" => '<h5 class="widget-title">',
    "after_title" => "</h5>",
  ]);

  register_sidebar([
    "name" => esc_html__("Resources Sidebar", "com.ewereka.bceo.theme"),
    "id" => "sidebar-widget-area-resources",
    "class" => "sidebar-widget-area",
    "before_widget" => '<div id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</div>",
    "before_title" => '<h5 class="widget-title">',
    "after_title" => "</h5>",
  ]);

  register_sidebar([
    "name" => esc_html__("Footer Widget Area 1", "com.ewereka.bceo.theme"),
    "id" => "footer-widget-area-1",
    "class" => "footer-widget-area",
    "before_widget" => '<div id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</div>",
    "before_title" => '<h5 class="widget-title">',
    "after_title" => "</h5>",
  ]);

  register_sidebar([
    "name" => esc_html__("Footer Widget Area 2", "com.ewereka.bceo.theme"),
    "id" => "footer-widget-area-2",
    "class" => "footer-widget-area",
    "before_widget" => '<div id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</div>",
    "before_title" => '<h5 class="widget-title">',
    "after_title" => "</h5>",
  ]);

  register_sidebar([
    "name" => esc_html__("Footer Widget Area 3", "com.ewereka.bceo.theme"),
    "id" => "footer-widget-area-3",
    "class" => "footer-widget-area",
    "before_widget" => '<div id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</div>",
    "before_title" => '<h5 class="widget-title">',
    "after_title" => "</h5>",
  ]);

  register_sidebar([
    "name" => esc_html__("Footer Widget Area 4", "com.ewereka.bceo.theme"),
    "id" => "footer-widget-area-4",
    "class" => "footer-widget-area",
    "before_widget" => '<div id="%1$s" class="widget-container %2$s">',
    "after_widget" => "</div>",
    "before_title" => '<h5 class="widget-title">',
    "after_title" => "</h5>",
  ]);
}
add_action("wp_head", "ewereka_pingback_header");
function ewereka_pingback_header()
{
  if (is_singular() && pings_open()) {
    printf(
      '<link rel="pingback" href="%s" />' . "\n",
      esc_url(get_bloginfo("pingback_url"))
    );
  }
}
add_action("comment_form_before", "ewereka_enqueue_comment_reply_script");
function ewereka_enqueue_comment_reply_script()
{
  if (get_option("thread_comments")) {
    wp_enqueue_script("comment-reply");
  }
}
function ewereka_custom_pings($comment)
{
  ?>
    <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo comment_author_link(); ?></li>
    <?php
}
add_filter("get_comments_number", "ewereka_comment_count", 0);
function ewereka_comment_count($count)
{
  if (!is_admin()) {
    global $id;
    $get_comments = get_comments("status=approve&post_id=" . $id);
    $comments_by_type = separate_comments($get_comments);
    return count($comments_by_type["comment"]);
  } else {
    return $count;
  }
}

add_filter("get_the_archive_title", function ($title) {
  if (is_category()) {
    $title = single_cat_title("", false);
  } elseif (is_tag()) {
    $title = single_tag_title("", false);
  } elseif (is_author()) {
    $title = '<span class="vcard">' . get_the_author() . "</span>";
  } elseif (is_tax()) {
    //for custom post types
    $title = sprintf(__('%1$s'), single_term_title("", false));
  } elseif (is_post_type_archive()) {
    $title = post_type_archive_title("", false);
  }
  return $title;
});
