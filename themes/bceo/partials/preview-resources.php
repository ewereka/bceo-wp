<?php
if (have_rows("attachments")) {
  the_row();
  $first_attachments = get_sub_field("attachment");
  $icon = "fas fa-file-download";
} else {
  $icon = "far fa-file";
} ?>
<a href="<?php the_permalink(); ?>" class="article summary resources">
  <i class="icon <?php echo $icon; ?>"></i>
  <h5><?php the_title(); ?></h5>
  <i class="arrow fas fa-arrow-right"></i>
</a>