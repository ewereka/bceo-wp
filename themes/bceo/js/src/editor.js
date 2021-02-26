wp.domReady(() => {
  // wp.blocks.unregisterBlockStyle( 'core/button', 'fill' );
  // wp.blocks.unregisterBlockStyle( 'core/button', 'outline' );

  wp.blocks.registerBlockStyle("core/button", {
    name: "primary",
    label: "Blue (Solid)",
  });
  wp.blocks.registerBlockStyle("core/button", {
    name: "outline-primary",
    label: "Blue (Outline)",
  });
  wp.blocks.registerBlockStyle("core/button", {
    name: "secondary",
    label: "Orange (Solid)",
  });
  wp.blocks.registerBlockStyle("core/button", {
    name: "outline-secondary",
    label: "Orange (Outline)",
  });
  wp.blocks.registerBlockStyle("core/button", {
    name: "info",
    label: "Yellow (Solid)",
  });
  wp.blocks.registerBlockStyle("core/button", {
    name: "outline-info",
    label: "Yellow (Outline)",
  });
  wp.blocks.registerBlockStyle("core/button", {
    name: "dark",
    label: "Dark Grey (Solid)",
  });
  wp.blocks.registerBlockStyle("core/button", {
    name: "outline-dark",
    label: "Dark Grey (Outline)",
  });
});
