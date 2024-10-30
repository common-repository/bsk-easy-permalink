<?php

/*
Plugin Name: BSK Easy Permalink
Plugin URI: http://www.bannersky.com
Description: A plugin that let you insert URL or permalink into posts or pages.
Version: 1.0.0
Author: bannersky
Author URI: http://www.bannersky.com
*/




class BSKEasyPermalink {

	public function __construct(){
	
		register_deactivation_hook( __FILE__, array( &$this, 'BSKEasyPermalink_deactivate' ) );
		register_uninstall_hook( __FILE__, array( &$this, 'BSKEasyPermalink_uninstall' ) );
		register_activation_hook( __FILE__, array( &$this, 'BSKEasyPermalink_activate' ) );
	}


	function BSKEasyPermalink_activate(){
	}


	function BSKEasyPermalink_deactivate(){
	
	}


	function BSKEasyPermalink_uninstall(){
	
	}
	
	function BSKEasyPermalink_show_permalink($atts, $content = null){
		$atts = shortcode_atts(array('id' => '0', 'title' => '', 'hyperlink' => 'true'), $atts);
		$id = $atts['id'];
		$title = $atts['title'];
		$showAsHyperlink = $atts['hyperlink'];
		$permalink = $id == 0 ? get_bloginfo( 'home' ) : get_permalink( $id );
		if ($showAsHyperlink && $showAsHyperlink != 'false'){
			if (!$title){
				$title = $id == 0 ? get_bloginfo( 'name' ) : get_the_title ( $id );
			}
			return '<a href="'.$permalink.'">'.esc_html( $title ).'</a>';
		}
		return $permalink;
	}
}

$BSK_easy_permalink = new BSKEasyPermalink();
add_shortcode( 'BSKEasyPermalink', array(&$BSK_easy_permalink, 'BSKEasyPermalink_show_permalink') );