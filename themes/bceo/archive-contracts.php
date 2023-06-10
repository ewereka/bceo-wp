<?php
/**
 * @package bceo-wp
 * @since bceo-wp 1.0.0
 */
get_header();

$all_posts = new WP_Query([
  "posts_per_page" => -1,
  "post_type" => $post_type,
]);

get_template_part("partials/hero", "archive", $post_type);
?>

<div class="main">
  <div class="row section-contracts justify-content-center my-4 py-4">
    <div class="col-10 contracts">
      <?php if ($all_posts->have_posts()): ?>
        <h1 class="entry-title">Current Bids & Contracts</h1>

        <div class="contracts-list">
          <?php while ($all_posts->have_posts()):

            // Info
            $all_posts->the_post();
            $subtitle = get_field("subtitle");
            $url = get_field("url");
            $location = get_field("location");

            // Details
            $funding = get_field("funding");
            $construction_start = get_field("construction_start");
            $construction_complete = get_field("construction_complete");
            $details = get_field("details");

            // Status
            $status = get_field("status");
            $cost_of_plans = get_field("cost_of_plans");
            $bidding_opens = get_field("bidding_opens");
            $bid_amount = get_field("bid_amount");
            $awarded_date = get_field("awarded_date");
            $awarded_to = get_field("awarded_to");

            switch ($status) {
              case "pending":
                $awarded_date = false;
                $cost_of_plans = false;
                $bidding_opens = false;
                $awarded_to_label = "Apparent Lowest Bidder";
                break;
              case "awarded":
                $cost_of_plans = false;
                $bidding_opens = false;
                $awarded_to_label = "Awarded To";
                break;
              case "open":
              default:
                $awarded_date = false;
                $awarded_to = false;
                break;
            }
            ?>
            <article class="contract row">
              <div class="col-12 col-md-4 contract-info">
                <?php if ($url) printf("<a href=\"%s\" target=\"_blank\">", $url); ?>
                <h5 class="mb-0"><?php the_title(); ?></h5>
                <?php if ($subtitle) {
                  printf("<p class=\"contract-subtitle\">%s</p>", $subtitle);
                } ?>
                <?php if ($url) printf("</a>"); ?>
                <?php if ($location) {
                  printf("<p class=\"contract-location\">%s</p>", $location);
                } ?>
              </div>
              <div class="col-12 col-md-4 contract-summary">
                <?php if ($funding) {
                  printf(
                    "<p class=\"contract-funding\"><strong>Funding:</strong> %s</p>",
                    $funding
                  );
                } ?>
                <?php if ($construction_start) {
                  printf(
                    "<p class=\"contract-details\"><strong>Construction Start:</strong> %s</p>",
                    $construction_start
                  );
                } ?>
                <?php if ($construction_complete) {
                  printf(
                    "<p class=\"contract-details\"><strong>Construction Complete:</strong> %s</p>",
                    $construction_complete
                  );
                } ?>
                <?php if ($details) {
                  printf("<p class=\"contract-details\">%s</p>", $details);
                } ?>
              </div>
              <div class="col-12 col-md-4 contract-status">
                <?php if ($bidding_opens) {
                  printf(
                    "<p class=\"contract-details\"><strong>Bidding Opens:</strong> %s</p>",
                    $bidding_opens
                  );
                } ?>
                <?php if ($cost_of_plans) {
                  printf(
                    "<p class=\"contract-details\"><strong>Cost of Plans:</strong> %s</p>",
                    $cost_of_plans
                  );
                } ?>
                <?php if ($awarded_date) {
                  printf(
                    "<p class=\"contract-details\"><strong>Awarded:</strong> %s</p>",
                    $awarded_date
                  );
                } ?>
                <?php if ($awarded_to) {
                  printf(
                    "<p class=\"contract-details\"><strong>%s:</strong> %s</p>",
                    $awarded_to_label,
                    $awarded_to
                  );
                } ?>
                <?php if ($bid_amount) {
                  printf(
                    "<p class=\"contract-details\"><strong>Bid Amount:</strong> %s</p>",
                    $bid_amount
                  );
                } ?>
              </div>
            </article>
            <?php
          endwhile; ?>
        </div>
      <?php endif; ?>
      
      </div>
    </div>
  </div>
</div>

<?php get_footer();
?>
