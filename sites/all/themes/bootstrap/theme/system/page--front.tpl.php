<?php
/**
 * @file
 * Default theme implementation to display a single Drupal page.
 *
 * The doctype, html, head and body tags are not in this template. Instead they
 * can be found in the html.tpl.php template in this directory.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $directory: The directory the template is located in, e.g. modules/system
 *   or themes/bartik.
 * - $is_front: TRUE if the current page is the front page.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or
 *   prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $main_menu (array): An array containing the Main menu links for the
 *   site, if they have been configured.
 * - $secondary_menu (array): An array containing the Secondary menu links for
 *   the site, if they have been configured.
 * - $breadcrumb: The breadcrumb trail for the current page.
 *
 * Page content (in order of occurrence in the default page.tpl.php):
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title: The page title, for use in the actual HTML content.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 * - $messages: HTML for status and error messages. Should be displayed
 *   prominently.
 * - $tabs (array): Tabs linking to any sub-pages beneath the current page
 *   (e.g., the view and edit tabs when displaying a node).
 * - $action_links (array): Actions local to the page, such as 'Add menu' on the
 *   menu administration interface.
 * - $feed_icons: A string of all feed icons for the current page.
 * - $node: The node object, if there is an automatically-loaded node
 *   associated with the page, and the node ID is the second argument
 *   in the page's path (e.g. node/12345 and node/12345/revisions, but not
 *   comment/reply/12345).
 *
 * Regions:
 * - $page['help']: Dynamic help text, mostly for admin pages.
 * - $page['highlighted']: Items for the highlighted content region.
 * - $page['content']: The main content of the current page.
 * - $page['sidebar_first']: Items for the first sidebar.
 * - $page['sidebar_second']: Items for the second sidebar.
 * - $page['header']: Items for the header region.
 * - $page['footer']: Items for the footer region.
 *
 * @see bootstrap_preprocess_page()
 * @see template_preprocess()
 * @see template_preprocess_page()
 * @see bootstrap_process_page()
 * @see template_process()
 * @see html.tpl.php
 *
 * @ingroup themeable
 */
?>

<?php include_once('header.php'); ?>

<div class="wrapper">
<div class="row">
<div class="shadow"></div>
</div>

<div class="row toprow large-text">
  <div class="container">
    <div class="pull-left col-xs-12 col-md-6">
      <h1>Realtime Inventory Data You Can Access From Anywhere</h1>
      <p>At your desk or in the palm of your hand.</p>
    </div>
    <div class="pull-right col-xs-12 col-md-6">
      <img class="img-responsive" src="/sites/all/themes/bootstrap/images/form-factors.png" />
    </div>
  </div>
</div>

<div class="row">
<div class="barcode"></div>
<div class="shadow2"></div>
</div>

<div class="row trucks large-text">
  <div class="container">
    <div class="pull-left col-xs-12 col-md-5">
      <img class="img-responsive" src="/sites/all/themes/bootstrap/images/globe.png" />
    </div>
    <div class="pull-right col-xs-12 col-md-7">
      <h1>Track Items Inside Your Warehouse and Around The World</h1>
      <p>All of your inventory at your desk or in the palm of your hand.</p>
    </div>

  </div>
</div>

<div class="row">
<div class="barcode"></div>
<div class="shadow2"></div>
</div>

  <div class="row gradient large-text">
    <div class="container">
      <h1>Manage your inventory like never before</h1>
      <p>
        Some marketing language goes here explaining all the benefits of our systems. Maybe some bullet points? That would be cool.
      </p>
      <ul>
        <li>Cloud based inventory control</li>
        <li>Track item locations inside your warehouse</li>
        <li>Track items around the world</li>
      </ul>
    </div>
  </div>

<footer class="footer container">
  <?php print render($page['footer']); ?>
</footer>

  <div class="row">
    <div class="barcode"></div>
  </div>

</div>

