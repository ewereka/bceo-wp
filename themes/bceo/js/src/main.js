(function ($) {
  /**
   * Copyright 2012, Digital Fusion
   * Licensed under the MIT license.
   * http://teamdf.com/jquery-plugins/license/
   *
   * @author Sam Sehnert
   * @desc A small plugin that checks whether elements are within
   *     the user visible viewport of a web browser.
   *     only accounts for vertical position, not horizontal.
   */

  $.fn.visible = function (partial) {
    var $t = $(this),
      $w = $(window),
      viewTop = $w.scrollTop(),
      viewBottom = viewTop + $w.height(),
      _top = $t.offset().top,
      _bottom = _top + $t.height(),
      compareTop = partial === true ? _bottom : _top,
      compareBottom = partial === true ? _top : _bottom;

    return compareBottom <= viewBottom && compareTop >= viewTop;
  };
})(jQuery);

function animateNumberBlocks($parent) {
  $parent.find(".number-blocks--block--number").each(function () {
    jQuery(this)
      .prop("Counter", 0)
      .animate(
        {
          Counter: jQuery(this).text(),
        },
        {
          duration: 4000,
          easing: "swing",
          step: function (now) {
            jQuery(this).text(Math.ceil(now));
          },
        }
      );
  });
}

var debugState = false;

jQuery(function () {
  document.addEventListener("keydown", function (event) {
    if (event.code === "Backquote" && event.ctrlKey) {
      if (debugState) {
        jQuery(".debug").removeClass("debug").addClass("debug-on");
        debugState = false;
      } else {
        jQuery(".debug-on").removeClass("debug-on").addClass("debug");
        debugState = true;
      }
      console.log(debugState);
    }
  });

  jQuery(".its-sortable").each(function () {
    var $parent = jQuery(this);
    var $sorter = $parent.find(".its-sortable-nav");
    var prefix = $sorter.data("its-sortable-prefix") || "category";
    var $sorterLinks = $sorter.find(".its-sortable-link");
    $sorterLinks
      .on("click", function (e) {
        e.preventDefault();
        var $this = jQuery(this);

        $sorterLinks.removeClass("active");
        $this.addClass("active");

        var term = $this.data("its-sortable-term");
        if (term === "*") {
          $parent.find(".its-sortable-item").fadeIn(100);
        } else {
          $parent
            .find(".its-sortable-item:not(." + prefix + "-" + term + ")")
            .fadeOut(100);
          $parent.find(".its-sortable-item." + prefix + "-" + term).fadeIn(100);
        }
      })
      .filter(".active")
      .trigger("click");
  });

  var $win = jQuery(window);
  var $numberBlocks = jQuery(".number-blocks:not(.animated)").addClass(
    "can-animate"
  );
  var $mainNav = jQuery(".main-nav").eq(0);
  var mainNavSticky = $mainNav.offset().top;

  $win
    .on("scroll", (e) => {
      $numberBlocks.each((i, el) => {
        var $el = jQuery(el);
        if (!$el.hasClass("animated") && $el.visible(true)) {
          $el.addClass("animated");
          animateNumberBlocks($el);
        }
      });
      console.log(mainNavSticky);
      if ($mainNav) {
        if (window.pageYOffset >= mainNavSticky) {
          $mainNav.addClass("sticky");
        } else {
          $mainNav.removeClass("sticky");
        }
      }
    })
    .trigger("scroll");
});
