<?php
/**
 * BCEO Customizations Class
 *
 * @version 1.0.0
 * @package bceo
 * @subpackage customizations
 */
class BCEO_Customizations
{
  // Declarations
  private static $initiated = false;

  private static $staff_type_name = "staff";

  private static $faq_type_name = "faq";
  private static $faq_collection_taxonomy_name = "collection";

  private static $projects_type_name = "projects";
  private static $project_status_taxonomy_name = "project_status";
  private static $project_status_taxonomy_slug = "status";
  private static $project_location_taxonomy_name = "project_location";
  private static $project_location_taxonomy_slug = "location";

  private static $resources_type_name = "resources";
  private static $resource_type_taxonomy_name = "resource_type";
  private static $resource_type_taxonomy_slug = "type";

  /**
   * Method executed by the init hook in the main plugin file
   *
   * @since 1.0.0
   * @return void
   */
  public static function init()
  {
    // Check to see if it's initialized
    if (!static::$initiated) {
      // If not, let's get started!
      static::init_hooks();
    }

    return;
  }

  /**
   * Method executed by register_activation_hook in the main plugin file
   *
   * @since 1.0.0
   * @return void
   */
  public static function activate()
  {
    // Nothing right now
    return;
  }

  // BEGIN Private Methods

  private static function init_hooks()
  {
    static::$initiated = true;

    static::change_post_object();
    static::create_post_types();
    static::create_acf_pages();
  }

  private static function create_acf_pages()
  {
    if (function_exists("acf_add_options_page")) {
      acf_add_options_page([
        "page_title" => "BCEO Theme Settings",
        "menu_title" => "BCEO Settings",
        "menu_slug" => "bceo-theme-settings",
        "capability" => "edit_posts",
        "redirect" => false,
      ]);
    }
  }

  private static function change_post_object()
  {
    global $wp_post_types;
    $labels = &$wp_post_types["post"]->labels;
    $labels->name = "News";
    $labels->singular_name = "News";
    $labels->add_new = "Add News";
    $labels->add_new_item = "Add News";
    $labels->edit_item = "Edit News";
    $labels->new_item = "News";
    $labels->view_item = "View News";
    $labels->search_items = "Search News";
    $labels->not_found = "No News found";
    $labels->not_found_in_trash = "No News found in Trash";
    $labels->all_items = "All News";
    $labels->menu_name = "News";
    $labels->name_admin_bar = "News";

    unregister_taxonomy_for_object_type("post_tag", "post");
  }
  private static function create_post_types()
  {
    global $wp_rewrite;

    $staff_type_name = static::$staff_type_name;
    $staff_slug = static::$staff_type_name;
    $staff_type_labels = [
      "name" => _x(
        "Staff",
        "staff type general name",
        "com.ewereka.bceo.plugin"
      ),
      "singular_name" => _x(
        "Staff",
        "Staff type singular name",
        "com.ewereka.bceo.plugin"
      ),
      "menu_name" => _x("Staff", "admin menu", "com.ewereka.bceo.plugin"),
      "name_admin_bar" => _x(
        "Staff",
        "add new on admin bar",
        "com.ewereka.bceo.plugin"
      ),
      "add_new" => _x("Add Staff Member", "com.ewereka.bceo.plugin"),
      "add_new_item" => __("Add Staff Member", "com.ewereka.bceo.plugin"),
      "new_item" => __("New Staff Member", "com.ewereka.bceo.plugin"),
      "edit_item" => __("Edit Staff Member", "com.ewereka.bceo.plugin"),
      "view_item" => __("View Staff Member", "com.ewereka.bceo.plugin"),
      "all_items" => __("All Staff Members", "com.ewereka.bceo.plugin"),
      "search_items" => __("Search Staff Members", "com.ewereka.bceo.plugin"),
      "parent_item_colon" => __(
        "Parent Staff Member:",
        "com.ewereka.bceo.plugin"
      ),
      "not_found" => __("No Staff Members found.", "com.ewereka.bceo.plugin"),
      "not_found_in_trash" => __(
        "No Staff Members found in trash.",
        "com.ewereka.bceo.plugin"
      ),
      "archives" => __("Staff Members", "com.ewereka.bceo.plugin"),
      "featured_image" => __("Photo", "com.ewereka.bceo.plugin"),
      "set_featured_image" => __("Set photo", "com.ewereka.bceo.plugin"),
      "remove_featured_image" => __("Remove photo", "com.ewereka.bceo.plugin"),
      "use_featured_image" => __("Use as photo", "com.ewereka.bceo.plugin"),
    ];

    $staff_type_args = [
      "labels" => $staff_type_labels,
      "exclude_from_search" => true,
      "public" => false,
      "publicly_queryable" => false,
      "show_ui" => true,
      "show_in_nav_menus" => true,
      "show_in_menu" => true,
      "show_in_admin_bar" => true,
      "query_var" => true,
      "rewrite" => ["slug" => $staff_slug, "with_front" => false],
      "capability_type" => "post",
      "has_archive" => false,
      "hierarchical" => false,
      "menu_position" => 20,
      "menu_icon" => "dashicons-groups",
      "supports" => ["title", "thumbnail", "revisions"],
    ];

    $faq_type_name = static::$faq_type_name;
    $faq_slug = static::$faq_type_name;
    $faq_type_labels = [
      "name" => _x("FAQ", "faq type general name", "com.ewereka.bceo.plugin"),
      "singular_name" => _x(
        "FAQ",
        "faq type singular name",
        "com.ewereka.bceo.plugin"
      ),
      "menu_name" => _x("FAQ", "admin menu", "com.ewereka.bceo.plugin"),
      "name_admin_bar" => _x(
        "FAQ",
        "add new on admin bar",
        "com.ewereka.bceo.plugin"
      ),
      "add_new" => _x("Add FAQ", "com.ewereka.bceo.plugin"),
      "add_new_item" => __("Add FAQ", "com.ewereka.bceo.plugin"),
      "new_item" => __("New FAQ", "com.ewereka.bceo.plugin"),
      "edit_item" => __("Edit FAQ", "com.ewereka.bceo.plugin"),
      "view_item" => __("View FAQ", "com.ewereka.bceo.plugin"),
      "all_items" => __("All FAQs", "com.ewereka.bceo.plugin"),
      "search_items" => __("Search FAQs", "com.ewereka.bceo.plugin"),
      "parent_item_colon" => __("Parent FAQ:", "com.ewereka.bceo.plugin"),
      "not_found" => __("No FAQs found.", "com.ewereka.bceo.plugin"),
      "not_found_in_trash" => __(
        "No FAQs found in trash.",
        "com.ewereka.bceo.plugin"
      ),
      "archives" => __("FAQs", "com.ewereka.bceo.plugin"),
    ];

    $faq_type_args = [
      "labels" => $faq_type_labels,
      "exclude_from_search" => false,
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "show_in_nav_menus" => true,
      "show_in_menu" => true,
      "show_in_admin_bar" => true,
      "query_var" => true,
      "rewrite" => ["slug" => $faq_slug, "with_front" => false],
      "capability_type" => "post",
      "has_archive" => true,
      "hierarchical" => false,
      "menu_position" => 20,
      "menu_icon" => "dashicons-editor-help",
      "supports" => ["title", "editor", "revisions"],
    ];

    $projects_type_name = static::$projects_type_name;
    $projects_slug = static::$projects_type_name;
    $projects_type_labels = [
      "name" => _x(
        "Projects",
        "projects type general name",
        "com.ewereka.bceo.plugin"
      ),
      "singular_name" => _x(
        "Project",
        "projects type singular name",
        "com.ewereka.bceo.plugin"
      ),
      "menu_name" => _x("Projects", "admin menu", "com.ewereka.bceo.plugin"),
      "name_admin_bar" => _x(
        "Projects",
        "add new on admin bar",
        "com.ewereka.bceo.plugin"
      ),
      "add_new" => _x("Add Project", "com.ewereka.bceo.plugin"),
      "add_new_item" => __("Add Project", "com.ewereka.bceo.plugin"),
      "new_item" => __("New Project", "com.ewereka.bceo.plugin"),
      "edit_item" => __("Edit Project", "com.ewereka.bceo.plugin"),
      "view_item" => __("View Project", "com.ewereka.bceo.plugin"),
      "all_items" => __("All Projects", "com.ewereka.bceo.plugin"),
      "search_items" => __("Search Projects", "com.ewereka.bceo.plugin"),
      "parent_item_colon" => __("Parent Project:", "com.ewereka.bceo.plugin"),
      "not_found" => __("No projects found.", "com.ewereka.bceo.plugin"),
      "not_found_in_trash" => __(
        "No projects found in trash.",
        "com.ewereka.bceo.plugin"
      ),
      "archives" => __("Projects", "com.ewereka.bceo.plugin"),
    ];
    $projects_type_args = [
      "labels" => $projects_type_labels,
      "exclude_from_search" => false,
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "show_in_nav_menus" => true,
      "show_in_menu" => true,
      "show_in_admin_bar" => true,
      "query_var" => true,
      "rewrite" => ["slug" => $projects_slug, "with_front" => false],
      "capability_type" => "post",
      "has_archive" => true,
      "hierarchical" => false,
      "menu_position" => 21,
      "menu_icon" => "dashicons-location",
      "show_in_rest" => true,
      "supports" => ["title", "editor", "excerpt", "thumbnail", "revisions"],
    ];

    $resources_type_name = static::$resources_type_name;
    $resources_slug = static::$resources_type_name;
    $resources_type_labels = [
      "name" => _x(
        "Resources",
        "projects type general name",
        "com.ewereka.bceo.plugin"
      ),
      "singular_name" => _x(
        "Resource",
        "projects type singular name",
        "com.ewereka.bceo.plugin"
      ),
      "menu_name" => _x("Resources", "admin menu", "com.ewereka.bceo.plugin"),
      "name_admin_bar" => _x(
        "Resources",
        "add new on admin bar",
        "com.ewereka.bceo.plugin"
      ),
      "add_new" => _x("Add Resource", "com.ewereka.bceo.plugin"),
      "add_new_item" => __("Add Resource", "com.ewereka.bceo.plugin"),
      "new_item" => __("New Resource", "com.ewereka.bceo.plugin"),
      "edit_item" => __("Edit Resource", "com.ewereka.bceo.plugin"),
      "view_item" => __("View Resource", "com.ewereka.bceo.plugin"),
      "all_items" => __("All Resources", "com.ewereka.bceo.plugin"),
      "search_items" => __("Search Resources", "com.ewereka.bceo.plugin"),
      "parent_item_colon" => __("Parent Resource:", "com.ewereka.bceo.plugin"),
      "not_found" => __("No resources found.", "com.ewereka.bceo.plugin"),
      "not_found_in_trash" => __(
        "No resources found in trash.",
        "com.ewereka.bceo.plugin"
      ),
      "archives" => __("Resources", "com.ewereka.bceo.plugin"),
    ];
    $resources_type_args = [
      "labels" => $resources_type_labels,
      "exclude_from_search" => false,
      "public" => true,
      "publicly_queryable" => true,
      "show_ui" => true,
      "show_in_nav_menus" => true,
      "show_in_menu" => true,
      "show_in_admin_bar" => true,
      "query_var" => true,
      "rewrite" => ["slug" => $resources_slug, "with_front" => false],
      "capability_type" => "post",
      "has_archive" => true,
      "hierarchical" => false,
      "menu_position" => 21,
      "menu_icon" => "dashicons-download",
      "show_in_rest" => true,
      "supports" => ["title", "editor", "excerpt", "thumbnail", "revisions"],
    ];

    register_post_type($staff_type_name, $staff_type_args);
    register_post_type($faq_type_name, $faq_type_args);
    register_post_type($projects_type_name, $projects_type_args);
    register_post_type($resources_type_name, $resources_type_args);

    /** Taxonomies */
    $faq_collection_taxonomy_name = static::$faq_collection_taxonomy_name;
    $faq_collection_taxonomy_labels = [
      "name" => _x(
        "Collections",
        "taxonomy general name",
        "com.ewereka.bceo.plugin"
      ),
      "singular_name" => _x(
        "Collection",
        "taxonomy singular name",
        "com.ewereka.bceo.plugin"
      ),
      "search_items" => __("Search Collections", "com.ewereka.bceo.plugin"),
      "all_items" => __("All Collections", "com.ewereka.bceo.plugin"),
      "parent_item" => __("Parent Collection", "com.ewereka.bceo.plugin"),
      "parent_item_colon" => __(
        "Parent Collection:",
        "com.ewereka.bceo.plugin"
      ),
      "edit_item" => __("Edit Collection", "com.ewereka.bceo.plugin"),
      "update_item" => __("Update Collection", "com.ewereka.bceo.plugin"),
      "add_new_item" => __("Add New Collection", "com.ewereka.bceo.plugin"),
      "new_item_name" => __("New Collection Name", "com.ewereka.bceo.plugin"),
      "menu_name" => __("Collections", "com.ewereka.bceo.plugin"),
    ];

    $faq_collection_taxonomy_args = [
      "hierarchical" => true,
      "labels" => $faq_collection_taxonomy_labels,
      "show_ui" => true,
      "show_admin_column" => true,
      "query_var" => true,
      "rewrite" => ["slug" => $faq_collection_taxonomy_name],
    ];

    $project_status_taxonomy_name = static::$project_status_taxonomy_name;
    $project_status_taxonomy_slug = static::$project_status_taxonomy_slug;
    $project_status_taxonomy_labels = [
      "name" => _x(
        "Status",
        "taxonomy general name",
        "com.ewereka.bceo.plugin"
      ),
      "singular_name" => _x(
        "Status",
        "taxonomy singular name",
        "com.ewereka.bceo.plugin"
      ),
      "search_items" => __("Search Statuses", "com.ewereka.bceo.plugin"),
      "all_items" => __("All Statuses", "com.ewereka.bceo.plugin"),
      "parent_item" => __("Parent Status", "com.ewereka.bceo.plugin"),
      "parent_item_colon" => __("Parent Status:", "com.ewereka.bceo.plugin"),
      "edit_item" => __("Edit Status", "com.ewereka.bceo.plugin"),
      "update_item" => __("Update Status", "com.ewereka.bceo.plugin"),
      "add_new_item" => __("Add New Status", "com.ewereka.bceo.plugin"),
      "new_item_name" => __("New Status Name", "com.ewereka.bceo.plugin"),
      "menu_name" => __("Statuses", "com.ewereka.bceo.plugin"),
    ];

    $project_status_taxonomy_args = [
      "hierarchical" => true,
      "labels" => $project_status_taxonomy_labels,
      "show_ui" => true,
      "show_admin_column" => true,
      "query_var" => true,
      "rewrite" => ["slug" => $project_status_taxonomy_slug],
    ];

    $project_location_taxonomy_name = static::$project_location_taxonomy_name;
    $project_location_taxonomy_slug = static::$project_location_taxonomy_slug;
    $project_location_taxonomy_labels = [
      "name" => _x(
        "Location",
        "taxonomy general name",
        "com.ewereka.bceo.plugin"
      ),
      "singular_name" => _x(
        "Location",
        "taxonomy singular name",
        "com.ewereka.bceo.plugin"
      ),
      "search_items" => __("Search Locations", "com.ewereka.bceo.plugin"),
      "all_items" => __("All Locations", "com.ewereka.bceo.plugin"),
      "parent_item" => __("Parent Location", "com.ewereka.bceo.plugin"),
      "parent_item_colon" => __("Parent Location:", "com.ewereka.bceo.plugin"),
      "edit_item" => __("Edit Location", "com.ewereka.bceo.plugin"),
      "update_item" => __("Update Location", "com.ewereka.bceo.plugin"),
      "add_new_item" => __("Add New Location", "com.ewereka.bceo.plugin"),
      "new_item_name" => __("New Location Name", "com.ewereka.bceo.plugin"),
      "menu_name" => __("Locations", "com.ewereka.bceo.plugin"),
    ];

    $project_location_taxonomy_args = [
      "hierarchical" => true,
      "labels" => $project_location_taxonomy_labels,
      "show_ui" => true,
      "show_admin_column" => true,
      "query_var" => true,
      "rewrite" => ["slug" => $project_location_taxonomy_slug],
    ];

    $resource_type_taxonomy_name = static::$resource_type_taxonomy_name;
    $resource_type_taxonomy_slug = static::$resource_type_taxonomy_slug;
    $resource_type_taxonomy_labels = [
      "name" => _x(
        "Resource Types",
        "taxonomy general name",
        "com.ewereka.bceo.plugin"
      ),
      "singular_name" => _x(
        "Resource Type",
        "taxonomy singular name",
        "com.ewereka.bceo.plugin"
      ),
      "search_items" => __("Search Resource Types", "com.ewereka.bceo.plugin"),
      "all_items" => __("All Resource Types", "com.ewereka.bceo.plugin"),
      "parent_item" => __("Parent Resource Type", "com.ewereka.bceo.plugin"),
      "parent_item_colon" => __(
        "Parent Resource Type:",
        "com.ewereka.bceo.plugin"
      ),
      "edit_item" => __("Edit Resource Type", "com.ewereka.bceo.plugin"),
      "update_item" => __("Update Resource Type", "com.ewereka.bceo.plugin"),
      "add_new_item" => __("Add New Resource Type", "com.ewereka.bceo.plugin"),
      "new_item_name" => __(
        "New Resource Type Name",
        "com.ewereka.bceo.plugin"
      ),
      "menu_name" => __("Resource Types", "com.ewereka.bceo.plugin"),
      "back_to_items" => __("Go to Resource Types", "com.ewereka.bceo.plugin"),
    ];

    $resource_type_taxonomy_args = [
      "hierarchical" => true,
      "labels" => $resource_type_taxonomy_labels,
      "show_ui" => true,
      "show_admin_column" => true,
      "query_var" => true,
      "rewrite" => ["slug" => $resource_type_taxonomy_slug],
    ];

    register_taxonomy(
      $faq_collection_taxonomy_name,
      [$faq_type_name],
      $faq_collection_taxonomy_args
    );
    register_taxonomy(
      $project_status_taxonomy_name,
      [$projects_type_name],
      $project_status_taxonomy_args
    );
    register_taxonomy(
      $project_location_taxonomy_name,
      [$projects_type_name],
      $project_location_taxonomy_args
    );
    register_taxonomy(
      $resource_type_taxonomy_name,
      [$resources_type_name],
      $resource_type_taxonomy_args
    );

    //Enable Featured Images
    add_theme_support("post-thumbnails");

    flush_rewrite_rules();
  }

  private static function flush_rewrites(): bool
  {
    $execution_state = false;

    if (function_exists("flush_rewrite_rules")) {
      flush_rewrite_rules();
      $execution_state = true;
    }

    return $execution_state;
  }
  // END Private Methods
}
