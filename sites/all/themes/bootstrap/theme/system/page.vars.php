<?php
/**
 * @file
 * page.vars.php
 */

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function bootstrap_preprocess_page(&$variables) {
  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-sm-6"';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-sm-9"';
  }
  else {
    $variables['content_column_class'] = ' class="col-sm-12"';
  }

  // Primary nav.
  $variables['primary_nav'] = FALSE;
  if ($variables['main_menu']) {
    // Build links.
    $variables['primary_nav'] = menu_tree(variable_get('menu_main_links_source', 'main-menu'));
    // Provide default theme wrapper function.
    $variables['primary_nav']['#theme_wrappers'] = array('menu_tree__primary');
  }

  // Secondary nav.
  $variables['secondary_nav'] = FALSE;
  if ($variables['secondary_menu']) {
    // Build links.
    $variables['secondary_nav'] = menu_tree(variable_get('menu_secondary_links_source', 'user-menu'));
    // Provide default theme wrapper function.
    $variables['secondary_nav']['#theme_wrappers'] = array('menu_tree__secondary');
  }

  // Logged in
  $variables['logged_in'] = FALSE;
  watchdog("menu stuff", "variables = " . print_r($variables,TRUE));
  if ($variables['menu_logged_in']) {
    // Build links.
    $variables['menu_logged_in'] = menu_tree(variable_get('menu_logged_in_links_source', 'menu-logged-in'));
    // Provide default theme wrapper function.
    $variables['menu_logged_in']['#theme_wrappers'] = array('menu_tree__logged_in');
  }

  // Logged in
  $variables['logged_out'] = FALSE;
  if ($variables['menu_logged_out']) {
    // Build links.
    $variables['menu_logged_out'] = menu_tree(variable_get('menu_logged_out_links_source', 'menu-logged-out'));
    // Provide default theme wrapper function.
    $variables['menu_logged_out']['#theme_wrappers'] = array('menu_tree__logged_in');
  }

  $variables['navbar_classes_array'] = array('navbar');

  if (theme_get_setting('bootstrap_navbar_position') !== '') {
    $variables['navbar_classes_array'][] = 'navbar-' . theme_get_setting('bootstrap_navbar_position');
  }
  else {
    $variables['navbar_classes_array'][] = 'container';
  }
  if (theme_get_setting('bootstrap_navbar_inverse')) {
    $variables['navbar_classes_array'][] = 'navbar-inverse';
  }
  else {
    $variables['navbar_classes_array'][] = 'navbar-default';
  }
}

/**
 * Implements hook_process_page().
 *
 * @see page.tpl.php
 */
function bootstrap_process_page(&$variables) {
  $variables['navbar_classes'] = implode(' ', $variables['navbar_classes_array']);

  if(isset($vars['node'])) {
    // If the node type is "blog_madness" the template suggestion will be "page--blog-madness.tpl.php".
    $variables['theme_hook_suggestions'][] = 'page__'. $vars['node']->type;
  }

  $url = explode("?",$_SERVER['REQUEST_URI']);
  $path = explode("/",$url[0]);

  if ($path[1] == 'dashboard') {
    $variables['theme_hook_suggestions'][] = 'page__dashboard';
  }


}
