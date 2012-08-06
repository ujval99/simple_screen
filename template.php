<?php
// $Id$

function simple_screen_preprocess_page(&$vars) {
	$theme_path = drupal_get_path('theme', 'simple_screen');
	drupal_add_css($theme_path . '/css/themes/' . theme_get_setting('community_style') . '.css', 'theme');
	$vars['styles'] = drupal_get_css();
}


function simple_screen_social_links_block() {
	global $base_path;
	$theme_path = $base_path.'/'.drupal_get_path('theme', 'simple_screen');
	$output .= '<ul id="follow-icon">';
	if ((theme_get_setting('simple_screen_quick_fb'))):	   
		$output .= '<li>';
		$output .=  l("<img src=".$theme_path."/img/facebook.png>", theme_get_setting('simple_screen_quick_fb'), array('attributes' => array('title' => 'facebook'),'html' => true)); 
		$output .= '</li>';
	endif;
	if ((theme_get_setting('simple_screen_quick_tw'))):
		$output .= '<li>';
		$output .= l("<img src=".$theme_path."/img/twitter.png>", theme_get_setting('simple_screen_quick_tw'), array('attributes' => array('title' => 'twitter'),'html' => true)); 
		$output .= '</li>';
	endif;
	if ((theme_get_setting('simple_screen_quick_gp'))):
		$output .= '<li>';
		$output .= l("<img src=".$theme_path."/img/google-plus.png>", theme_get_setting('simple_screen_quick_gp'), array('attributes' => array('title' => 'google-plus'),'html' => true));
		$output .= '</li>';
	endif;
	if ((theme_get_setting('simple_screen_quick_feed'))):
		$output .= '<li>';
		$output .= l("<img src=".$theme_path."/img/feed.png>", theme_get_setting('simple_screen_quick_feed'), array('attributes' => array('title' => 'feed'),'html' => true));
		$output .= '</li>';
	endif;
    $output .= '</ul>';
	print $output;
}


function simple_screen_promotional_text_block() {
	$output .= '<div class="promo-content">'; 
	if ((theme_get_setting('simple_screen_quick_fb'))):	
	$output .= '<div class="block">';
		$output .= '<h2>';
		$output .= theme_get_setting('simple_screen_promo_1_title');
		$output .= '</h2>';
		$output .= '<div class="content">';
		$output .= theme_get_setting('simple_screen_promo_1');
		$output .= '</div>';
	$output .= '</div>'; 
	endif;
	if ((theme_get_setting('simple_screen_quick_fb'))):	
	$output .= '<div class="block">';
		$output .= '<h2>';
		$output .= theme_get_setting('simple_screen_promo_2_title');
		$output .= '</h2>';
		$output .= '<div class="content">';
		$output .= theme_get_setting('simple_screen_promo_2');
		$output .= '</div>';
	$output .= '</div>'; 
	endif;
	if ((theme_get_setting('simple_screen_quick_fb'))):	
	$output .= '<div class="block">';
		$output .= '<h2>';
		$output .= theme_get_setting('simple_screen_promo_3_title');
		$output .= '</h2>';
		$output .= '<div class="content">';
		$output .= theme_get_setting('simple_screen_promo_3');
		$output .= '</div>';
	$output .= '</div>'; 
	endif;
	$output .= '</div>'; 
	print $output;
}








function simple_screen_testimonial_text_block() {
	$output .= '<div id="quotes">'; 
	if ((theme_get_setting('simple_screen_testimonials_title'))):	
	$output .= '<h2>';
	$output .= theme_get_setting('simple_screen_testimonials_title');
	$output .= '</h2>';
	endif;
	if ((theme_get_setting('simple_screen_testimonials_1'))):	
	$output .= '<div class="textItem">';
	$output .= theme_get_setting('simple_screen_testimonials_1');
	$output .= '</div>'; 
	endif;
	if ((theme_get_setting('simple_screen_testimonials_2'))):	
	$output .= '<div class="textItem">';
	$output .= theme_get_setting('simple_screen_testimonials_2');
	$output .= '</div>'; 
	endif;
	if ((theme_get_setting('simple_screen_testimonials_3'))):	
	$output .= '<div class="textItem">';
	$output .= theme_get_setting('simple_screen_testimonials_3');
	$output .= '</div>'; 
	endif;
	$output .= '</div>'; 
	print $output;
}
