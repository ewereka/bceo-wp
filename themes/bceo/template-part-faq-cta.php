<?php

$enabled = get_field('faq_cta_enabled', 'option');
if ($enabled):
  $link = get_field('faq_cta_link', 'option');
  if ($link):
    $link_url = $link['url'];
    $link_title = $link['title'];
    $link_target = $link['target'] ? $link['target'] : '_self';
    $color = get_field('faq_cta_color', 'option');
    $bg = get_field('faq_cta_bg', 'option');
    if ($bg) {
      $bgArray = wp_get_attachment_image_src($bg, 'full');
    }
    $bgAttr = 'style="padding-top: 6rem; padding-bottom: 6rem;"';
    $bgAttr .= ($bg && $bgArray) ? sprintf('data-parallax="scroll" data-speed="0.75" data-image-src="%s"', $bgArray[0]) : '';
    $bgClass = ($bg && $bgArray) ? ' parallax-window' : '';

    switch ($color) {
      case "orange":
        $btnClass = "btn-secondary";
        break;
      case "yellow":
        $btnClass = "btn-warning";
        break;
      case "grey":
        $btnClass = "btn-dark";
        break;
      case "blue":
      default:
        $btnClass = "btn-primary";
    }

    $link_tag = sprintf('<a href="%s" target="%s" class="btn btn-faq-cta btn-block %s"><i class="far fa-question-circle mr-2" role="img"></i>%s</a>', esc_attr($link_url), esc_attr($link_target), $btnClass, esc_html($link_title));
?>
  <br>
  <div class="row section-faq-cta no-gutters justify-content-center<?php echo $bgClass; ?>" <?php echo $bgAttr; ?>>
    <div class="col-12 col-lg-10 col-xl-8 padded-area">
      <?php echo $link_tag; ?>
    </div>
  </div>
<?php endif; endif; ?>