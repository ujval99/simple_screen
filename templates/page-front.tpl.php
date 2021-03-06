<?php

/**
 * @file
 * page-front.tpl.php
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">

<head>
  <?php print $head; ?>
  <title><?php print $head_title; ?></title>
  <?php print $styles; ?>
  <?php print $scripts; ?>
  <script language="javascript" type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
</head>
<body class="<?php print $body_classes; ?>">
  <div id="page">
  <div class="header"> <!-- header -->
    <div class="wrapper"> <!-- wrapper -->
      <div class="article"> <!-- article -->
        <?php if (!empty($menu) || isset($primary_links) ): ?> <!-- menu -->
        <div id="header-region">
          <?php if (isset($primary_links)) : ?>
          <?php print theme('links', $primary_links, array('class' => 'links primary-links')) ?>
          <?php else :?>
          <?php print $menu; ?>           
          <?php endif; ?> <!-- /menu -->
        </div>
        <?php endif; ?> <!-- /menu -->
        <?php if (!empty($logo)): ?> <!-- logo -->
          <h2>
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
              <img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" />
            </a>
          </h2>
        <?php endif; ?> <!-- /logo -->
        <?php if (!empty($site_name)): ?> <!-- site_name -->
        <div class="line logo-text">
          <span class="margRight"></span>
            <h2><a href="<?php print $front_page ?>" title="<?php print t('Home'); ?>" rel="home"><?php print $site_name; ?></a></h2>
          <span class="margLeft"></span>
        </div>
        <?php endif; ?> <!-- site_name -->
        <div class="clear"></div>
        <?php if ((theme_get_setting('simple_screen_quick_show')) == 1) : ?>
          <?php simple_screen_social_links_block(); ?>
        <?php endif; ?>
        <?php if (!empty($site_slogan)): ?> <!-- site_slogan -->
          <div class="site_slogan">
          <p><?php print $site_slogan; ?></p> <!-- site_slogan -->
          </div>
        <?php endif; ?>
      </div> <!-- /article -->
    </div> <!-- /wrapper -->
  </div> <!-- /header -->


  <?php if ((theme_get_setting('simple_screen_promo_show')) == 1) : ?>
    <div id="container" class="clear-block"> <!-- container -->
    <?php  simple_screen_promotional_text_block(); ?>
    </div> <!-- /container -->
   <?php endif;?>

  <?php if ((theme_get_setting('simple_screen_testimonials_show')) == 1) : ?>
   <div id="testimonials" class="clear-block"> <!-- site_snipet -->
   <?php simple_screen_testimonial_text_block(); ?>
   </div> <!-- /testimonials -->
  <?php endif; ?>

  <div id="contacts">
    <h2><?php print theme_get_setting('simple_screen_contact_title'); ?></h2>
    <div id="contact_col_0"><figure class="google_map" style="overflow: hidden;">
    <?php print theme_get_setting('simple_screen_contact_col_0'); ?></figure>
    </div> <!-- /contact_col_0 -->
    <div id="contact_col_1">
    <?php print theme_get_setting('simple_screen_contact_col_1'); ?>
    </div> <!-- /contact_col_1 -->
  </div>

  <div id="footer-wrapper">
    <div id="footer">
	  <?php if (theme_get_setting('simple_screen_copyright_show')) : ?>
        <?php print theme_get_setting('simple_screen_copyright_text'); ?>
      <?php else :?>
        <?php print $footer_message; ?>
        <?php if (!empty($footer)): print $footer; endif; ?>  
      <?php endif; ?>
    </div> <!-- /footer -->
  </div> <!-- /footer-wrapper -->

  <?php print $closure; ?>

  </div> <!-- /page -->
</body>
</html>
