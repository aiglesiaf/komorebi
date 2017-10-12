<?php
/*
Plugin Name: Bloglovin Button
Plugin URI: https://wordpress.org/plugins/bloglovin-button/
Version: 1.3.4
Author: pipdig
Description: Easily add the Bloglovin Button to your WordPress blog.
Text Domain: bloglovin-button
Author URI: https://www.pipdig.co/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Copyright 2017 pipdig Ltd.

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
*/

if ( ! defined( 'ABSPATH' ) ) exit;

class bloglovin_button_widget extends WP_Widget {
 
  public function __construct() {
     $widget_ops = array('classname' => 'bloglovin_button_widget', 'description' => __("Display the official Bloglovin' button.", 'bloglovin-button') );
     parent::__construct('bloglovin_button_widget', __("Bloglovin' Button", 'bloglovin-button'), $widget_ops);
  }
  
  function widget($args, $instance) {
    // PART 1: Extracting the arguments + getting the values
    extract($args, EXTR_SKIP);
    $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
    $links = get_option('pipdig_links');
	if (isset($instance['bloglovin_url'])) {
		$bloglovin_url = esc_url($instance['bloglovin_url']);
	} elseif (isset($links['bloglovin'])) { // pull from p3 if available
		$bloglovin_url = esc_url($links['bloglovin']);
	} else {
		$bloglovin_url = '';
	}
	$style_select = empty($instance['style_select']) ? '' : $instance['style_select'];
	
    // Before widget code, if any
    echo (isset($before_widget)?$before_widget:'');
   
    // PART 2: The title and the text output
    if (!empty($title)) {
		echo $before_title . $title . $after_title;
	}
	
	switch ($style_select) {
		case '1':
			$counter = 'true';
			$button = 'button';
		break;
		case '2':
			$counter = 'false';
			$button = 'button';
		break;
		case '3':
			$counter = 'false';
			$button = '';
		break;
	}

    if (!empty($bloglovin_url)) {
		if ($url = parse_url($bloglovin_url)) {
			$bloglovin_url =  'https://'.$url['host'].$url['path'];
			$bloglovin_url = rtrim($bloglovin_url,"/");
		}
		echo '<a data-blsdk-counter="'.$counter.'" data-blsdk-type="'.$button.'" target="_blank" href="'.$bloglovin_url.'" class="blsdk-follow">Follow</a><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s);js.id = id;js.src = "https://www.bloglovin.com/widget/js/loader.js?v=1";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "bloglovin-sdk"))</script>';
	} else {
		_e("Setup not complete. Please add your Bloglovin' URL to the Bloglovin' Button in the dashboard.", 'bloglovin-button');
	}
    // After widget code, if any
    echo (isset($after_widget)?$after_widget:'');
  }
 
  public function form( $instance ) {
   
    // PART 1: Extract the data from the instance variable
    $instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
    $title = $instance['title'];
	if (isset($instance['bloglovin_url'])) {
		$bloglovin_url = esc_url($instance['bloglovin_url']);
	}
	$links = get_option('pipdig_links');
	if (isset($instance['bloglovin_url'])) {
		$bloglovin_url = esc_url($instance['bloglovin_url']);
	} elseif (isset($links['bloglovin'])) { // pull from p3 if available
		$bloglovin_url = esc_url($links['bloglovin']);
	} else {
		$bloglovin_url = '';
	}
	$style_select = ( isset( $instance['style_select'] ) && is_numeric( $instance['style_select'] ) ) ? (int) $instance['style_select'] : 1;
 
   
    // PART 2-3: Display the fields
    ?>
	<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title:', 'bloglovin-button'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
	</p>

	<p>
		<label for="<?php echo $this->get_field_id('bloglovin_url'); ?>"><?php _e("Bloglovin' URL:", 'bloglovin-button'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('bloglovin_url'); ?>" name="<?php echo $this->get_field_name('bloglovin_url'); ?>" type="url" value="<?php echo esc_url($bloglovin_url); ?>" required />
	</p>
	
	<p style="font-size: 90%"><?php _e("You should use your full Bloglovin' URL. For example:", 'bloglovin-widget'); ?><br /><em>https://www.bloglovin.com/blogs/inthefrow-4177899</em></p>
	
	<p>
		<legend><h4><?php _e('Button style:', 'bloglovin-widget'); ?></h4></legend>
		
		<input type="radio" id="<?php echo ($this->get_field_id( 'style_select' ) . '-1') ?>" name="<?php echo ($this->get_field_name( 'style_select' )) ?>" value="1" <?php checked( $style_select == 1, true) ?>>
		<label for="<?php echo ($this->get_field_id( 'style_select' ) . '-1' ) ?>"><img src="<?php echo plugins_url( 'img/button_with_count.png', __FILE__ ) ?>" style="position:relative;top:5px;" /></label>
<br /><br />
		<input type="radio" id="<?php echo ($this->get_field_id( 'style_select' ) . '-2') ?>" name="<?php echo ($this->get_field_name( 'style_select' )) ?>" value="2" <?php checked( $style_select == 2, true) ?>>
		<label for="<?php echo ($this->get_field_id( 'style_select' ) . '-2' ) ?>"><img src="<?php echo plugins_url( 'img/button_no_count.png', __FILE__ ) ?>" style="position:relative;top:5px;" /></label>
<br /><br />
		<input type="radio" id="<?php echo ($this->get_field_id( 'style_select' ) . '-3') ?>" name="<?php echo ($this->get_field_name( 'style_select' )) ?>" value="3" <?php checked( $style_select == 3, true) ?>>
		<label for="<?php echo ($this->get_field_id( 'style_select' ) . '-3' ) ?>"><img src="<?php echo plugins_url( 'img/bloglovin-button-full.png', __FILE__ ) ?>" style="position:relative;top:5px;" /></label>
	</p>
	
	<p><?php _e("You can also add your Bloglovin' button to any post/page by using the shortcode [bloglovin_button]", 'bloglovin-button'); ?></p>
	<?php //printf( __( 'Has this free plugin helped you? Please consider leaving a %s&#9733;&#9733;&#9733;&#9733;&#9733;%s rating on wordpress.org. It means we can keep adding new features :)', 'bloglovin-button' ), '<a href="https://goo.gl/GQAeiJ" target="_blank" style="text-decoration:none">', '</a>' ); ?>
    <?php
   
  }
 
  function update($new_instance, $old_instance) {
	if (!is_customize_preview()) {
		update_option('pipdig_bloglovin_btn_url', $new_instance['bloglovin_url']);
	}
	$instance = $old_instance;
	$instance['title'] = sanitize_text_field($new_instance['title']);
	$instance['bloglovin_url'] = esc_url($new_instance['bloglovin_url']);
	$instance['style_select'] = ( isset( $new_instance['style_select'] ) && $new_instance['style_select'] > 0 && $new_instance['style_select'] < 4 ) ? (int) 	$new_instance['style_select'] : 0; // 4 is total radio +1
	
	return $instance;
  }
  
}
add_action( 'widgets_init', create_function('', 'return register_widget("bloglovin_button_widget");') );




function bloglovin_button_shortcode( $atts ) {
	extract( shortcode_atts(
		array(
			'email' => '',
		), $atts )
	);
	
	if (get_option('pipdig_bloglovin_btn_url')) {
		$bloglovin_url = get_option('pipdig_bloglovin_btn_url');
	} else {
		$links = get_option('pipdig_links');
		if (isset($links['bloglovin'])) { // pull from p3 if available
			$bloglovin_url = $links['bloglovin'];
		}
	}
	
	$output = '';
	
	if (empty($bloglovin_url)) {
		return $output;
	}
	
	if ($email == 'true') {
		$output = '<div style="text-align:center;max-width:320px;margin:0 auto"><a title="'.__('Follow on Bloglovin', 'bloglovin-button').'" class="blsdk-follow" href="'.esc_url($bloglovin_url).'" target="_blank" rel="nofollow" data-blsdk-type="" data-blsdk-counter="false">'.__('Follow on Bloglovin', 'bloglovin-button').'</a><script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s);js.id = id;js.src = "//widget.bloglovin.com/assets/widget/loader.js";fjs.parentNode.insertBefore(js, fjs);}(document, "script", "bloglovin-sdk"))</script></div>';
	} else {
		$output = '
		<a title="'.esc_attr(__('Follow on Bloglovin', 'bloglovin-button')).'" target="_blank" class="bl_button_shortcode nopin" rel="nofollow" href="'.esc_url($bloglovin_url).'"><img src="https://pipdigz.co.uk/plugins/bl_btn.png" style="width: 120px; height: auto" class="nopin" data-pin-nopin="true" alt="'.esc_attr(__('Follow on Bloglovin', 'bloglovin-button')).'" /></a>
		';
	}
	
	return $output;
}
add_shortcode( 'bloglovin_button', 'bloglovin_button_shortcode' );