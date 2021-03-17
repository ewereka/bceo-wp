<?php

function ewereka_customizer_settings($wp_customize)
{
  $wp_customize->add_setting("footer_logo");
  // Add a control to upload the logo
  $wp_customize->add_control(
    new WP_Customize_Image_Control($wp_customize, "footer_logo", [
      "label" => esc_html__("Footer Logo", "com.ewereka.bceo.theme"),
      "section" => "title_tagline",
      "settings" => "footer_logo",
    ])
  );

  $wp_customize->add_setting("mobile_logo");
  // Add a control to upload the logo
  $wp_customize->add_control(
    new WP_Customize_Image_Control($wp_customize, "mobile_logo", [
      "label" => esc_html__("Mobile Logo", "com.ewereka.bceo.theme"),
      "section" => "title_tagline",
      "settings" => "mobile_logo",
    ])
  );
}
add_action("customize_register", "ewereka_customizer_settings");
