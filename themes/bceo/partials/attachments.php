<?php if (have_rows("attachments")): ?>
  <div id="attachments" class="row section-attachments bg-primary no-gutters padded-area">
    <div class="col-12 text-light">
      <h2 class="accent-line-yellow">Downloads</h2>
    </div>
    <?php while (have_rows("attachments")):

      the_row();
      $file = get_sub_field("attachment");
      ?>
    <div class="col-auto">
      <?php switch ($file["mime_type"]) {
        case "application/pdf":
          $file_icon = "fas fa-file-pdf text-error";
          break;
        case "application/msword":
        case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
          $file_icon = "fas fa-file-word text-primary";
          break;
        case "application/vnd.ms-excel":
        case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
          $file_icon = "fas fa-file-excel text-success";
          break;
        case "application/zip":
          $file_icon = "fas fa-file-archive";
          break;
        case "application/vnd.ms-powerpoint":
        case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
          $file_icon = "fas fa-file-powerpoint text-warning";
          break;
        default:
          $file_icon = "fas fa-file-download";
      } ?>
      <a class="attachment-link" href="<?php echo $file["url"]; ?>">
        <i class="icon <?php echo $file_icon; ?>"></i>
        <p class="filename"><?php echo $file["title"]; ?></p>
      </a>
    </div>
  <?php
    endwhile; ?>
  </div>
<?php endif;
?>
