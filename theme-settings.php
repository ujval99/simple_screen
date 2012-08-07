<?php
/**
 * @file
 * theme-settings.php
 * Implementation of THEMEHOOK_settings() function.
 *
 * @param $saved_settings
 *   array An array of saved settings for this theme.
 * @return
 *   array A form array.
 */
 
/**
 * Theme setting defaults
 */ 
function simple_screen_default_theme_settings() {
  // Add site-wide theme settings
  $defaults = array();
  $defaults = array_merge($defaults, theme_get_settings());

  return $defaults;
}

/**
 * Initialize theme settings if needed
 */
function simple_screen_initialize_theme_settings($theme_name) {
  $theme_settings = theme_get_settings($theme_name);
  
    static $registry_rebuilt = false;   // avoid multiple rebuilds per page

    // Retrieve saved or site-wide theme settings
    $theme_setting_name = str_replace('/', '_', 'theme_'. $theme_name .'_settings');
    $settings = (variable_get($theme_setting_name, FALSE)) ? theme_get_settings($theme_name) : theme_get_settings();

    // Skip toggle_node_info_ settings
    if (module_exists('node')) {
      foreach (node_get_types() as $type => $name) {
        unset($settings['toggle_node_info_'. $type]);
      }
    }

    // Combine default theme settings from .info file & theme-settings.php
    $theme_data = list_themes();   // get theme data for all themes
    $info_theme_settings = ($theme_name && isset($theme_data[$theme_name]->info['settings'])) ? $theme_data[$theme_name]->info['settings'] : array();
    $defaults = array_merge(simple_screen_default_theme_settings(), $info_theme_settings);

    // Set combined default & saved theme settings
    variable_set($theme_setting_name, array_merge($defaults, $settings));

    // Force theme settings refresh
    theme_get_setting('', TRUE);
 
}

function phptemplate_settings($saved_settings) {
  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the template.php file.
   */
  $defaults = array(
    'garland_happy' => 1,
    'garland_shoes' => 0,
    'simple_screen_testimonials_show' => 1,
    'simple_screen_promo_show' => 1,
    'simple_screen_promo_1_title' => 'Web',
    'simple_screen_promo_1' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    'simple_screen_promo_2_title' => 'Mobile',
    'simple_screen_promo_2' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    'simple_screen_promo_3_title' => 'Cloud',
    'simple_screen_promo_3' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    'simple_screen_testimonials_title' => 'testimonials',
    'simple_screen_testimonials_1' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    'simple_screen_testimonials_2' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    'simple_screen_testimonials_3' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.Lorem Ipsum is simply dummy text of the printing and typesetting industry.',
    'simple_screen_contact_title' => 'contact us',
    'simple_screen_contact_col_0' => '<img src="http://localhost/hu//sites/all/themes/simple_screen/img/facebook.png">',
    'simple_screen_contact_col_1' => 'Name Of the Location,<br/>Street Name, City<br/>State, Country<br/>Freephone: +0 000 000 0000<br/>Telephone:+0 000 000 0000<br/>FAX:+0 000 000 0000<br/>E-mail: mail@demolink.org<br/>Skype: <a class="color" href="#">@skypename</a>',
    'simple_screen_quick_show' => 1,
    'simple_screen_quick_fb' => 'http://facebook.com/',
    'simple_screen_quick_tw' => 'http://twitter.com/',
    'simple_screen_quick_gp' => 'http://google.com/',
    'simple_screen_quick_feed' => 'http://google.com/',
    'site_slogan' => 'Leader in all Technologies',
  );
  // Merge the saved variables and their default values
  global $base_url;

  // Get theme name from url (admin/.../theme_name)
  $theme_name = arg(count(arg()) - 1);

  // Combine default theme settings from .info file & theme-settings.php
  $theme_data = list_themes();   // get data for all themes
  $info_theme_settings = ($theme_name && isset($theme_data[$theme_name]->info['settings'])) ? $theme_data[$theme_name]->info['settings'] : array();
  $defaults = array_merge(simple_screen_default_theme_settings(), $info_theme_settings);
  
  $settings = array_merge($defaults, $saved_settings);

  $path = drupal_get_path('theme', 'simple_screen');
  drupal_add_css($path . '/css/theme_settings.css');

  $form['style-switcher'] = array(
  '#type' => 'fieldset',
  '#title' => t('Style switcher'),
  '#description' => t('Choose your default style of your simple screen theme'),
  '#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
  '#suffix' => '</div></div>',
  );

  $style_options = array(
  '669933' => 'Green',
  '64A0AA' => 'Blue',
  '7C283F' => 'Crimson',
  '4C5E91' => 'Grayish blue',
  '885B24' => 'English orange',
  'E572A6' => 'Sweet rose',
  'F16450' => 'Scarlet',
  'BCA474' => 'Gamboge',
  '556270' => 'Dark gray',
  '77AC92' => 'Grayish green',
  '8A3586' => 'Magenta ',
  '01B8F1' => 'Cerulean',
  '000000' => 'Black',
  );

  // set style options to use later on templte files
  if (count(variable_get('simple_screen_style_options', array())) == 0) {
    variable_set('simple_screen_style_options', $style_options);
  }

  $default_style = isset($settings['simple_screen_style']) ? $settings['simple_screen_style'] : '64A0AA';
  $options = array();
  foreach ($style_options as $color => $color_name) {
    $color = '_' . $color;
    $class = $color;

    if ($color == $default_style) {
      $class .= ' default_item';
    }

    $options[$color] = '<span class="icon ' . $class . '"><span>&nbsp;</span></span>'
    . '<span class="name">'
    . $color_name
    . '</span>';
  }

  $form['style-switcher']['simple_screen_style'] = array(
  '#type' => 'radios',
  '#options' => $options,
  '#default_value' => isset($settings['simple_screen_style']) ? $settings['simple_screen_style'] : '_64A0AA',
  );

  $form['simple_screen_promo'] = array(
  '#type' => 'fieldset',
  '#title' => t('Promotional Information'),
  '#description' => t('Fill your Promotional information. If you have enabled the "Display Promotional Blocks" Settings, It is recommended to fill the Subject and Text Both.'),
  '#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
  '#suffix' => '</div></div>',
  );

  $form['simple_screen_promo']['simple_screen_promo_show'] = array(
    '#type' => 'checkbox',
    '#title' => t('Display Promotional Blocks'),
    '#description' => t('Enable To Display Promotional Block'),
    '#default_value' => $settings['simple_screen_promo_show'],
    );

  $form['simple_screen_promo']['simple_screen_promo_1_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Promotional Subject'),
    '#default_value' => $settings['simple_screen_promo_1_title'],
    '#size' => 60,
    '#maxlength' => 128,
  );

  $form['simple_screen_promo']['simple_screen_promo_1'] = array(
    '#type' => 'textarea',
    '#title' => t('Promotional Text - 1'),
    '#default_value' => $settings['simple_screen_promo_1'],
  );

  $form['simple_screen_promo']['simple_screen_promo_2_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Promotional Subject'),
    '#default_value' => $settings['simple_screen_promo_2_title'],
    '#size' => 60,
    '#maxlength' => 128,
  );

  $form['simple_screen_promo']['simple_screen_promo_2'] = array(
    '#type' => 'textarea',
    '#title' => t('Promotional text - Text '),
    '#default_value' => $settings['simple_screen_promo_2'],
  );

  $form['simple_screen_promo']['simple_screen_promo_3_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Promotional Subject'),
    '#default_value' => $settings['simple_screen_promo_3_title'],
    '#size' => 60,
    '#maxlength' => 128,
  );

  $form['simple_screen_promo']['simple_screen_promo_3'] = array(
    '#type' => 'textarea',
    '#title' => t('Promotional text - 3'),
    '#default_value' => $settings['simple_screen_promo_3'],
  );

  $form['simple_screen_testimonials'] = array(
  '#type' => 'fieldset',
  '#title' => t('Testimonials'),
  '#description' => t('Fill your Testimonials'),
  '#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
  '#suffix' => '</div></div>',
  );

  $form['simple_screen_testimonials']['simple_screen_testimonials_show'] = array(
    '#type' => 'checkbox',
    '#title' => t('Display Testimonial Blocks'),
    '#description' => t('Enable To Display Testimonial Block'),
    '#default_value' => $settings['simple_screen_testimonials_show'],
  );

  $form['simple_screen_testimonials']['simple_screen_testimonials_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Testimonial Block Title '),
    '#default_value' => $settings['simple_screen_testimonials_title'],
    '#description' => t('Provide your Testimonial Block Title, Example - Testimonials, Client Speaks'),
    '#size' => 60,
    '#maxlength' => 128,
  );

  $form['simple_screen_testimonials']['simple_screen_testimonials_1'] = array(
    '#type' => 'textarea',
    '#title' => t('Testimonial 1'),
    '#default_value' => $settings['simple_screen_testimonials_1'],
  );

  $form['simple_screen_testimonials']['simple_screen_testimonials_2'] = array(
    '#type' => 'textarea',
    '#title' => t('Testimonial 2'),
    '#default_value' => $settings['simple_screen_testimonials_2'],
  );

  $form['simple_screen_testimonials']['simple_screen_testimonials_3'] = array(
    '#type' => 'textarea',
    '#title' => t('Testimonial 3'),
    '#default_value' => $settings['simple_screen_testimonials_3'],
  );

  $form['simple_screen_contact'] = array(
  '#type' => 'fieldset',
  '#title' => t('Contact Information'),
  '#description' => t('Provide your Contact information'),
  '#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
  '#suffix' => '</div></div>',
  );

  $form['simple_screen_contact']['simple_screen_contact_title'] = array(
    '#type' => 'textfield',
    '#title' => t('Contact Subject'),
    '#default_value' => $settings['simple_screen_contact_title'],
    '#description' => t('Provide your Contact Block Title, Example - Contact, Contact Us'),
    '#size' => 60,
    '#maxlength' => 128,
  );

  $form['simple_screen_contact']['simple_screen_contact_col_0'] = array(
    '#type' => 'textarea',
    '#title' => t('Contact Map'),
    '#default_value' => $settings['simple_screen_contact_col_0'],
    '#description' => 'Use Static Image or Google Map. <i>' . t('Standard Width - 470px') . '</i>',
  );

  $form['simple_screen_contact']['simple_screen_contact_col_1'] = array(
    '#type' => 'textarea',
    '#title' => t('Contact Text'),
    '#default_value' => $settings['simple_screen_contact_col_1'],
  );

  $form['simple_screen_quick'] = array(
    '#type' => 'fieldset',
    '#title' => t('Social Media Information'),
    '#description' => t('Provide your Social Media information'),
    '#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
    '#suffix' => '</div></div>',
  );

  $form['simple_screen_quick']['simple_screen_quick_show'] = array(
    '#type' => 'checkbox',
    '#title' => t('Display Social Media Information'),
    '#description' => t('Enable To Display Social Media Information'),
    '#default_value' => $settings['simple_screen_quick_show'],
  );

  $form['simple_screen_quick']['simple_screen_quick_fb'] = array(
    '#type' => 'textfield',
    '#title' => t('Facebook URL'),
    '#default_value' => $settings['simple_screen_quick_fb'],
    '#size' => 60,
    '#maxlength' => 128,
    '#description' => '<i>' . t('use http://, Example :http://xyz.com') . '</i>',
  );

  $form['simple_screen_quick']['simple_screen_quick_tw'] = array(
    '#type' => 'textfield',
    '#title' => t('Twitter URL'),
    '#default_value' => $settings['simple_screen_quick_tw'],
    '#size' => 60,
    '#maxlength' => 128,
    '#description' => '<i>' . t('use http://, Example :http://xyz.com') . '</i>',
  );

  $form['simple_screen_quick']['simple_screen_quick_gp'] = array(
    '#type' => 'textfield',
    '#title' => t('Google Plus URL'),
    '#default_value' => $settings['simple_screen_quick_gp'],
    '#size' => 60,
    '#maxlength' => 128,
    '#description' => '<i>' . t('use http://, Example :http://xyz.com') . '</i>',
  );

  $form['simple_screen_quick']['simple_screen_quick_feed'] = array(
    '#type' => 'textfield',
    '#title' => t('RSS Feed URL'),
    '#default_value' => $settings['simple_screen_quick_feed'],
    '#size' => 60,
    '#maxlength' => 128,
    '#description' => '<i>' . t('use http://, Example :http://xyz.com') . '</i>',
  );
  
  $form['simple_screen_copyright'] = array(
  '#type' => 'fieldset',
  '#title' => t('Copyright Information'),
  '#description' => t('Provide your Copyright information'),
  '#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
  '#suffix' => '</div></div>',
  );

  $form['simple_screen_copyright']['simple_screen_copyright_show'] = array(
    '#type' => 'checkbox',
    '#title' => t('Display Copyright Blocks'),
    '#description' => t('Enable To Display Copyright Block, NOTE : If you enable this feature, Footer message added at site-information will not be displayed. '),
    '#default_value' => $settings['simple_screen_copyright_show'],
  );
  
  $form['simple_screen_copyright']['simple_screen_copyright_text'] = array(
    '#type' => 'textfield',
    '#title' => t('Contact Subject'),
    '#default_value' => $settings['simple_screen_copyright_text'],
    '#description' => t('Provide your Contact Block Title, Example - Contact, Contact Us'),
    '#size' => 60,
    '#maxlength' => 128,
  );


  // Return the additional form widgets
  return $form;
}
