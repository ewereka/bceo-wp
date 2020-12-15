$(document).ready(function () {
  $(".its-sortable").each(function () {
    var $parent = $(this);
    var $sorter = $parent.find(".its-sortable-nav");
    var prefix = $parent.data("its-sortable-prefix") || "category";

    $sorter.find(".its-sortable-link").on("click", function (e) {
      e.preventDefault();
      var $this = $(this);

      var term = $this.data("its-sortable-term");
      if (term === "*") {
        $parent.find(".its-sortable-item").fadeIn(100);
      } else {
        console.log(".its-sortable-item:not(." + prefix + "-" + term + ")");
        $parent
          .find(".its-sortable-item:not(." + prefix + "-" + term + ")")
          .fadeOut(100);
        $parent.find(".its-sortable-item." + prefix + "-" + term).fadeIn(100);
      }
    });
  });
});
