<?php

/**
* Implementation of THEMEHOOK_settings() function.
*
* @param $saved_settings
*   array An array of saved settings for this theme.
* @return
*   array A form array.
*/

function simple_screen_settings($saved_settings) {
  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the template.php file.
   */
  $defaults = array(
    'garland_happy' => 1,
    'garland_shoes' => 0,
  );

  // Merge the saved variables and their default values
  $settings = array_merge($defaults, $saved_settings);
	
	$path = drupal_get_path('theme', 'simple_screen');
	drupal_add_css($path . '/css/theme_settings.css');
	drupal_add_js($path . '/js/theme_settings.js');
	
	$form['style-switcher'] = array(
	'#type' => 'fieldset',
	'#title' => t('Style switcher'),
	'#description' => t('Choose your default style of your Community theme'),
	'#prefix' => '<div id="community-style"><div class="community-settings">',
	'#suffix' => '</div></div>',
	);

	$style_options = array(
	'669933' => 'Chartreuse green',
	'64A0AA' => 'Grayish arctic blue',
	'7C283F' => 'Dark crimson',
	'4C5E91' => 'Grayish sapphire blue',
	'885B24' => 'Moderate orange',
	'E572A6' => 'Light rose',
	'F16450' => 'Brilliant scarlet',
	'BCA474' => 'Grayish gamboge',
	'556270' => 'Dark azureish gray',
	'77AC92' => 'Grayish spring green',
	'8A3586' => 'Moderate magenta ',
	'01B8F1' => 'Vivid cerulean',
	);
	
	// set style options to use later on templte files
	if (count(variable_get('community_style_options', array())) == 0) {
		variable_set('community_style_options', $style_options);
	}
	
	$default_style = isset($settings['community_style']) ? $settings['community_style'] : '64A0AA';
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
	
	$form['style-switcher']['community_style'] = array(
	'#type' => 'radios',
	'#options' => $options,
	'#default_value' => isset($settings['community_style']) ? $settings['community_style'] : '_64A0AA',
	);
	
	
	$form['simple_screen_promo'] = array(
	'#type' => 'fieldset',
	'#title' => t('Promotional Information'),
	'#description' => t('Provide your information'),
	'#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
	'#suffix' => '</div></div>',
	);
	
	
	$form['simple_screen_promo']['simple_screen_promo_show'] = array(
	  '#type' => 'checkbox',
	  '#title' => t('Display Promotion Blocks'),
	  '#default_value' => $settings['simple_screen_promo_show'],
  	);
  	
	$form['simple_screen_promo']['simple_screen_promo_1_title'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Subject'),
	  '#default_value' => $settings['simple_screen_promo_1_title'],
	  '#size' => 60,
	  '#maxlength' => 128,
   );

	$form['simple_screen_promo']['simple_screen_promo_1'] = array(
	  '#type' => 'textarea',
	  '#title' => t('promo 1 text'),
	  '#default_value' =>$settings['simple_screen_promo_1'],
	);
	
	$form['simple_screen_promo']['simple_screen_promo_2_title'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Subject'),
	  '#default_value' => $settings['simple_screen_promo_2_title'],
	  '#size' => 60,
	  '#maxlength' => 128,
   );

	$form['simple_screen_promo']['simple_screen_promo_2'] = array(
	  '#type' => 'textarea',
	  '#title' => t('promo 2 text'),
	  '#default_value' =>$settings['simple_screen_promo_2'],
	);
	
	$form['simple_screen_promo']['simple_screen_promo_3_title'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Subject'),
	  '#default_value' => $settings['simple_screen_promo_3_title'],
	  '#size' => 60,
	  '#maxlength' => 128,
   );

	$form['simple_screen_promo']['simple_screen_promo_3'] = array(
	  '#type' => 'textarea',
	  '#title' => t('promo 3 text'),
	  '#default_value' =>$settings['simple_screen_promo_3'],
	);
	
	
	
	$form['simple_screen_testimonials'] = array(
	'#type' => 'fieldset',
	'#title' => t('Testimonials'),
	'#description' => t('Provide your information'),
	'#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
	'#suffix' => '</div></div>',
	);
	
	$form['simple_screen_testimonials']['simple_screen_testimonials_show'] = array(
	  '#type' => 'checkbox',
	  '#title' => t('Display testimonials Blocks'),
	  '#default_value' => $settings['simple_screen_testimonials_show'],
  	);
  	
	$form['simple_screen_testimonials']['simple_screen_testimonials_title'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Title '),
	  '#default_value' =>$settings['simple_screen_testimonials_title'],
	  '#size' => 60,
	  '#maxlength' => 128,
	);
	
	$form['simple_screen_testimonials']['simple_screen_testimonials_1'] = array(
	  '#type' => 'textarea',
	  '#title' => t('testimonials 1 text'),
	  '#default_value' =>$settings['simple_screen_testimonials_1'],
	);
	
	$form['simple_screen_testimonials']['simple_screen_testimonials_2'] = array(
	  '#type' => 'textarea',
	  '#title' => t('testimonials 2 text'),
	  '#default_value' =>$settings['simple_screen_testimonials_2'],
	);
	
	$form['simple_screen_testimonials']['simple_screen_testimonials_3'] = array(
	  '#type' => 'textarea',
	  '#title' => t('testimonials 3 text'),
	  '#default_value' =>$settings['simple_screen_testimonials_3'],
	);
	
	$form['simple_screen_contact'] = array(
	'#type' => 'fieldset',
	'#title' => t('Contact Information'),
	'#description' => t('Provide your information'),
	'#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
	'#suffix' => '</div></div>',
	);
	
	$form['simple_screen_contact']['simple_screen_contact_title'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Subject'),
	  '#default_value' => $settings['simple_screen_contact_title'],
	  '#size' => 60,
	  '#maxlength' => 128,
   );

	$form['simple_screen_contact']['simple_screen_contact_col_0'] = array(
	  '#type' => 'textarea',
	  '#title' => t('contact map'),
	  '#default_value' =>$settings['simple_screen_contact_col_0'],
	  '#description' => '<i>'.t('Standard Width - 470px').'</i>',
	);
	
	$form['simple_screen_contact']['simple_screen_contact_col_1'] = array(
	  '#type' => 'textarea',
	  '#title' => t('contact text'),
	  '#default_value' =>$settings['simple_screen_contact_col_1'],
	);
	
	$form['simple_screen_quick'] = array(
	  '#type' => 'fieldset',
	  '#title' => t('Contact Information'),
	  '#description' => t('Provide your information'),
	  '#prefix' => '<div id="simple_screen-style"><div class="simple_screen-settings">',
	  '#suffix' => '</div></div>',
	);
	
	$form['simple_screen_quick']['simple_screen_quick_show'] = array(
	  '#type' => 'checkbox',
	  '#title' => t('Display Quick Contact Links'),
	  '#default_value' => $settings['simple_screen_quick_show'],
  	);

	$form['simple_screen_quick']['simple_screen_quick_fb'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Facebook URL'),
	  '#default_value' => $settings['simple_screen_quick_fb'],
	  '#size' => 60,
	  '#maxlength' => 128,
	  '#description' => '<i>'.t('use http://, Example :http://xyz.com').'</i>',
   );

	$form['simple_screen_quick']['simple_screen_quick_tw'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Twitter '),
	  '#default_value' =>$settings['simple_screen_quick_tw'],
	  '#size' => 60,
	  '#maxlength' => 128,
	  '#description' => '<i>'.t('use http://, Example :http://xyz.com').'</i>',
	);
	
	$form['simple_screen_quick']['simple_screen_quick_gp'] = array(
	  '#type' => 'textfield',
	  '#title' => t('Google Plus URL'),
	  '#default_value' =>$settings['simple_screen_quick_gp'],
	  '#size' => 60,
	  '#maxlength' => 128,
	  '#description' => '<i>'.t('use http://, Example :http://xyz.com').'</i>',
	);
	
	$form['simple_screen_quick']['simple_screen_quick_feed'] = array(
	  '#type' => 'textfield',
	  '#title' => t('RSS Feed URL'),
	  '#default_value' =>$settings['simple_screen_quick_feed'],
	  '#size' => 60,
	  '#maxlength' => 128,
	  '#description' => '<i>'.t('use http://, Example :http://xyz.com').'</i>',
	);
	
	
  // Return the additional form widgets
  return $form;
}
?>
