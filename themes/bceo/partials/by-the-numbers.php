<?php

$enabled = get_field("by_the_numbers_enabled", "option");
if ($enabled):
  $blockCount = count(get_field("by_the_numbers_blocks", "option"));
  if ($blockCount > 0 && $blockCount <= 4):

    $heading = get_field("by_the_numbers_heading", "option");
    $theme = get_field("by_the_numbers_theme", "option");
    switch ($blockCount) {
      case 3:
        $blockClass = "col-12 col-sm-6 col-md-4";
        break;
      case 4:
        $blockClass = "col-12 col-sm-6 col-md-3";
        break;
      case 1:
      case 2:
      default:
        $blockClass = "col-12 col-sm-6";
    }

    switch ($theme) {
      case "blue":
      default:
        $sectionClass = "bg-primary text-white";
        $headingClass = "text-white accent-line-yellow";
    }
    ?>


<div class="row section-numbers no-gutters justify-content-center">
  <div class="col-12 padded-area <?php echo $sectionClass; ?>">
    <?php if ($heading): ?>
    <header>
      <h2 class="<?php echo $headingClass; ?>"><?php echo $heading; ?></h2>
    </header>
    <?php endif; ?>
    
    <div class="col-12 content justify-content-center number-blocks"><div class="row">
      <?php while (have_rows("by_the_numbers_blocks", "option")):

        the_row();
        $icon = get_sub_field("icon");
        $title = get_sub_field("title");
        $number = get_sub_field("number");
        $is_currency = get_sub_field("is_currency");
        $is_currency = is_bool($is_currency) ? $is_currency : false;
        $numberClass = "number-blocks--block--number";
        $numberClass .= $is_currency ? " currency" : "";
        ?>
      <div class="number-blocks--block <?php echo $blockClass; ?> m-auto text-center">
        <?php if ($icon): ?>
        <figure class="number-blocks--block--icon">
          <?php echo wp_get_attachment_image($icon, "medium", true, [
            "class" => "img-fluid",
          ]); ?>
        </figure>
        <?php endif; ?>
        <span class="<?php echo $numberClass; ?>"><?php echo $number; ?></span>
        <?php if (
          $title
        ): ?><span class="number-blocks--block--title"><?php echo $title; ?></span><?php endif; ?>
      </div>
      <?php
      endwhile; ?>
    </div></div>
  </div>
</div>
<?php
  endif;
endif;
?>
