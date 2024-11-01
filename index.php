<?php
/*Plugin Name: Social Link Groups
	Description: Another best plugin for linking to your social media profiles in your website.
	Author: Acespritech Solutions Pvt. Ltd.
	Author URI: https://acespritech.com/
	Version: 1.1.0
	Domain Path: /languages/
  	License: GPLv2 or later
  	License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

/*
 * Add Admin Script and CSS 
*/
add_action('admin_enqueue_scripts', 'aspl_asl_admin_style');
function aspl_asl_admin_style(){    
    wp_enqueue_style('aspl_asl_admin_custom_style', plugins_url('assest/css/aspl_asl_custom_admin_css.css', __FILE__));
    wp_enqueue_script('aspl_asl_admin_custom_script', plugins_url('assest/js/aspl_asl_custom_admin_js.js', __FILE__), array('jquery'));
}

/*
 * Add User Script and CSS 
*/
add_action('wp_enqueue_scripts', 'aspl_asl_user_style');
function aspl_asl_user_style(){    
    wp_enqueue_style('aspl_asl_user_custom_style', plugins_url('assest/css/aspl_asl_custom_user_css.css', __FILE__));
    wp_enqueue_style('aspl_asl_font-icon', plugins_url('assest/css/font-awesome.min.css', __FILE__));
    wp_enqueue_script('aspl_asl_font-icon-js', plugins_url('assest/js/fontawesome.min.js', __FILE__), array('jquery'));
}

/*
 * Add Admin Menu Option 
*/
add_action('admin_menu', 'aspl_asl_custom_menu');
function aspl_asl_custom_menu()
{	
    $hook = add_menu_page('Social Links', 'Social Links', 'manage_options', 'aspl_asl_group_list', 'aspl_asl_goup_list_callback_func' , 'dashicons-whatsapp',  61);
    add_submenu_page('aspl_asl_group_list','Social Links', 'Add New', 'manage_options', 'aspl_asl_add_new_group_list', 'aspl_asl_add_new_callback_func',62 );
}

function aspl_asl_goup_list_callback_func(){
	include_once dirname( __FILE__ ) . '/templates/admin_group_list.php';
	$feedbacklisttable = new aspl_woocommerce_daily_deals_List_Table1(); ?>
	<div class="wrap">
	<h1 class="wp-heading-inline">Social Link Groups<span class="dashicons-before dashicons-email-alt"></span>
		<a href="?page=aspl_asl_add_new_group_list" class="page-title-action">Add New</a>
	</h1>
	<div id="poststuff">
		<div id="post-body" class="metabox-holder">
			<div id="post-body-content">
				<div class="meta-box-sortables ui-sortable">
					<form method="post"><?php
						$feedbacklisttable->prepare_items();
						$feedbacklisttable->display(); ?>
					</form>
				</div>
			</div>
		</div>
		<br class="clear">
	</div>
	</div><?php
}

function aspl_asl_add_new_callback_func(){
	include_once dirname( __FILE__ ) . '/templates/add_new_group.php';
}

/*Database Installer Hook*/
	function aspl_asl_installer(){
	    include('include/table.php');
	}
	register_activation_hook( __file__, 'aspl_asl_installer' );
/*End*/

/*Create a ShortCode*/

	// [footag foo="bar"] [footag foo="3"]

	function aspl_asl_footag_func( $attr ) { 

		global $wpdb;
		$idd = $attr['text'];
		$string ="";

		$table_name = $wpdb->prefix . "aspl_asl_group_data";
		$group_data = $wpdb->get_results("SELECT * FROM $table_name where shortcode = '$idd' ");
		$stikcy_class = '';
		foreach ($group_data as $key => $value) {
			$stikcy_class = $value->sticky;
		}

		if ($stikcy_class == 'default') {
			$stikcy_class = 'aspl_stikcy_position_default'; 
		}
		if ($stikcy_class == 'left') {
			$stikcy_class = 'aspl_stikcy_position_left';
		}
		if ($stikcy_class == 'right') {
			$stikcy_class = 'aspl_stikcy_position_right';
		}

		$string .= '<div class="aspl-social-link-main '. $stikcy_class .'">';

		foreach ($group_data as $key => $value) {
			$temp = $value->group_data;
			$fields_data = unserialize($temp);
			foreach ($fields_data as $fields_data_value) {
	 			$array_data = array();
	 			$array_data[] = $fields_data_value;
				foreach ($array_data as $fields_value) {
					$aspl_social_link_status = $fields_value['aspl_social_link_status'];
					$social_name = $fields_value['social_name'];
					$aspl_social_menu_image_image = $fields_value['aspl_social_menu_image_image'];
					$link = $fields_value['link'];
					$string .= aspl_asl_fields_func($aspl_social_link_status,$social_name,$aspl_social_menu_image_image,$link);
				}
			}
		}
		$string .= '</div>';
		return $string;
	}
	add_shortcode( 'aspl-asl-group', 'aspl_asl_footag_func' );

	function aspl_asl_fields_func($status , $name , $image_path , $link){

		$string = "";
		$string .= "<div class='aspl-asl-icon'>";

		if ($status == 'on') {
			if (empty($image_path)) {
				if ($name == 'facebook') {
					$image_path_default = plugin_dir_url( __FILE__ ).'assest/images/facebook.png';
					$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path_default.'" width="30px" height="30px" /></a>';
				}
				if ($name == 'tumblr') {
					$image_path_default = plugin_dir_url( __FILE__ ).'assest/images/Tumblr.png';
					$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path_default.'" width="30px" height="30px" /></a>';
				}
				if ($name == 'instagram') {
					$image_path_default = plugin_dir_url( __FILE__ ).'assest/images/insta.png';
					$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path_default.'" width="30px" height="30px" /></a>';
				}
				if ($name == 'twitter') {
					$image_path_default = plugin_dir_url( __FILE__ ).'assest/images/Twiter.png';
					$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path_default.'" width="30px" height="30px" /></a>';
				}
				if ($name == 'skype') {
					$image_path_default = plugin_dir_url( __FILE__ ).'assest/images/skype.png';
					$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path_default.'" width="30px" height="30px" /></a>';
				}
				if ($name == 'line') {
					$image_path_default = plugin_dir_url( __FILE__ ).'assest/images/line.png';
					$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path_default.'" width="30px" height="30px" /></a>';
				}
				if ($name == 'linkedin') {
					$image_path_default = plugin_dir_url( __FILE__ ).'assest/images/link.png';
					$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path_default.'" width="30px" height="30px" /></a>';
				}
				if ($name == 'youtube') {
					$image_path_default = plugin_dir_url( __FILE__ ).'assest/images/you_tube.png';
					$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path_default.'" width="30px" height="30px" /></a>';
				}
			}else{
				$string .= '<a href = "'.$link.'" title="'.ucfirst($name).'"><img src="'.$image_path.'" width="30px" height="30px" /></a>';
			}

		}
		$string .= "</div>";
		return $string;
	}
