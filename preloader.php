<?php

/*
Plugin Name: Custom Preloader
Plugin URI: http://plugins.nikostsolakos.com/custom-preloader/
Description: Custom Preloader it's a plugin that it shows to you something, and behind that your website is loading. When your website it's ready then Custom Preloader Goes Off
Version: 1.4
Author: NikosTsolakos
Author URI: https://profiles.wordpress.org/nikostsolakos
License: GPLv2
*/

/*
	1. Plugin Activation and Deactivation
	2. Admin Init
	3. Admin Panel (Settings > Custom Preloader)
	4. Frontend
*/


// Set plugin URL
define( 'AP_PATH', plugin_dir_url(__FILE__) );


// =====
// 1. Plugin Activation and Deactivation
// =====

// Activation
register_activation_hook( __FILE__, "pr_activated");

function pr_activated() {
    
	$default_settings = array(
        'enabled_settings' 			=> '',
        'bg_color_settings' 		=> '#eeeeee',
		'bg_gradient_enabled' 		=> '',
		'bg_gradient_code' 			=> 'background: -webkit-linear-gradient(45deg, hsla(340, 100%, 55%, 1) 0%, hsla(340, 100%, 55%, 0) 70%), -webkit-linear-gradient(315deg, hsla(225, 95%, 50%, 1) 10%, hsla(225, 95%, 50%, 0) 80%), -webkit-linear-gradient(225deg, hsla(140, 90%, 50%, 1) 10%, hsla(140, 90%, 50%, 0) 80%), -webkit-linear-gradient(135deg, hsla(35, 95%, 55%, 1) 100%, hsla(35, 95%, 55%, 0) 70%); background: linear-gradient(45deg, hsla(340, 100%, 55%, 1) 0%, hsla(340, 100%, 55%, 0) 70%), linear-gradient(135deg, hsla(225, 95%, 50%, 1) 10%, hsla(225, 95%, 50%, 0) 80%), linear-gradient(225deg, hsla(140, 90%, 50%, 1) 10%, hsla(140, 90%, 50%, 0) 80%), linear-gradient(315deg, hsla(35, 95%, 55%, 1) 100%, hsla(35, 95%, 55%, 0) 70%);',
        'image_settings' 			=> 'http://i.imgur.com/Z11v1Ar.png',
        'image_width_settings' 		=> '150px',
        'image_height_settings' 	=> '150px',
		'image_margin_top' 			=> 'auto',
		'image_margin_left' 		=> 'auto',
		'image_margin_right' 		=> 'auto',
		'image_margin_bottom' 		=> 'auto'
    );

	add_option("pr_settings", $default_settings);
}

// Deactivation
register_deactivation_hook(__FILE__, 'pr_deactivated');

function pr_deactivated() {
	delete_option('pr_settings');
}

$plugin_dir = plugin_dir_path( __FILE__ );

// =====
// 2. Admin Init
// =====

function pr_settings_init(){
	register_setting('pr_settings', 'pr_settings', 'pr_settings_validate');
	// Main Section
	add_settings_section('main_section', '<div id="advanced">Settings</div>', 'main_section_text', __FILE__);
    // Fields Of Main Section
	add_settings_field('bg_color_settings', 'Background Color', 'bg_color_settings', __FILE__, 'main_section');
	add_settings_field('image_settings', 'Set Image', 'image_settings', __FILE__, 'main_section');
	add_settings_field('bg_gradient_code', 'Set ColorFul Background', 'bg_gradient_code', __FILE__, 'main_section');
	// Gradient Color
	add_settings_section('gradient_section', '<div id="gradient"><a href="#colorful_bg">ColorFul Background</a></div>', 'gradient_section_text', gradient_section_text);		// Advanced Section
	// Fields Of Gradient Color
	add_settings_field('bg_gradient_enabled', '', 'bg_gradient_enabled', __FILE__, 'gradient_section');
		
	add_settings_section('advanced_section', '<div id="advanced"><a href="#positions">Positions</a></div>', 'advanced_section_text', advanced_section_text);
	// Fields Of Advanced Section
	add_settings_field('image_width_settings', '', 'image_width_settings', __FILE__, 'advanced_section');
	add_settings_field('image_height_settings', '', 'image_height_settings', __FILE__, 'advanced_section');
	add_settings_field('image_margin_top', '', 'image_margin_top', __FILE__, 'advanced_section');
	add_settings_field('image_margin_left', '', 'image_margin_left', __FILE__, 'advanced_section');
	add_settings_field('image_margin_right', '', 'image_margin_right', __FILE__, 'advanced_section');
	add_settings_field('image_margin_bottom', '', 'image_margin_bottom', __FILE__, 'advanced_section');
}
add_action('admin_init', 'pr_settings_init' );

function main_section_text(){
}

include('include/functions.php');

// Options' HTML output

add_action('admin_menu', 'ap_admin_actions');

function cp_admin_panel()
{
	if ( !current_user_can( 'manage_options' ) ) 
	{
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	$options = get_option('pr_settings');
?>
	
	<div class="wrap" id="custom_preloader">
		<form action="options.php" method="post">
			<div id="poststuff">
				<div class="title_box">
					<h1 style="font-size: 2.3em;">Custom Preloader</h1>						
				</div>	
				<div class="postbox" style="">
					<h3><div id="advanced">Active / De-Active</div></h3>
					<div style="margin: 10px !important;">
						<span>	
							<section style=" margin-bottom: -30px !important; ">
								<p>Simple Background: </p>
									<div class="slideThree">
										<?php enabled_settings();?>
										<label for="slideThree" id="gettooltip"></label>
									</div>
							</section>
							<section style=" margin-bottom: -30px !important; ">
								<p>ColorFul Background: </p>
									<div class="slideThree">
										<?php bg_gradient_enabled();?>
										<label for="bg_gradient_enabled" id="gettooltip_s"></label>
									</div>
							</section>
						</span>
					</div>
				</div>					
				<div class="postbox">
					<?php settings_fields('pr_settings'); ?>
					<?php do_settings_sections(__FILE__); ?>
					<?php do_settings_sections(gradient_section_text); ?>
					<?php do_settings_sections(advanced_section_text); ?>
					<style>
						<?php
							$style_path = $plugin_dir . 'css/style.css';
							include($style_path);
						?>
					</style>
					<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
					<script src="<?php echo plugins_url( '/js/dd_tabs.js', __FILE__ );?>"></script>

					
					<p class="submit" style="margin-left: 10px;">
						<input id="submit-cp-options" name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
					</p>
					<div class="submit" style="margin-left: 130px;margin-top: -72px;">
						<a href="https://wordpress.org/support/view/plugin-reviews/custom-preloader" target="_blank" class="button-secondary">Rate Plugin</a>
					</div>
					<div class="submit" style="margin-left: 230px;margin-top: -72px;">
						<a href="https://wordpress.org/support/plugin/custom-preloader" style="background: #D51E1E;border-color: #9E1B1B;" target="_blank" class="button-primary">Support</a>
					</div>
				</div>
			</div>
		</form>
		<div class="submit postbox" style="margin-left: 310px;margin-top: -95px;background: transparent;min-width: none;border: 0;box-shadow: 0 0 0 transparent;">
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
							<input type="hidden" name="cmd" value="_s-xclick">
							<input type="hidden" name="hosted_button_id" value="MM7GG79LVV4T8">
							<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
						</form>
					</div>
			<script type="text/javascript">
			/* ColorFul Bg Button */
			$('#bg_gradient_enabled').change(function() {
				
				if($("#bg_gradient_enabled").prop('checked') == false) {
					document.getElementById("slideThree").removeAttribute('disabled');
					document.getElementById("smplbg").removeAttribute('disabled');
						$('#smplbg').removeAttr('style');
						$('#bg_img').removeAttr('style');
						$('#tooltip_bg_g').remove();
				} else {
					document.getElementById("bg_img").setAttribute("style", <?php echo json_encode($options['bg_gradient_code']);?>);
					document.getElementById("slideThree").setAttribute('disabled', 'disabled');
					document.getElementById("smplbg").setAttribute('disabled', 'disabled');
					document.getElementById("smplbg").style.cursor = 'no-drop';
						$('#gettooltip').append('<div id="tooltip_bg_g" class="tool-tip slideIn top tltp">Set <b style="color: red">OFF</b> <b>ColorFul Background</b></div>');
				}
			});

			/* Simple Bg Button */
			$('#slideThree').change(function() {
									
				if($("#slideThree").prop('checked') == false) {
					document.getElementById("bg_gradient_enabled").removeAttribute('disabled');
					document.getElementById("bg_gradient_code").removeAttribute('disabled');
						$('#bg_gradient_code').removeAttr('style');
						$('#bg_img').removeAttr('style');
						$('#tooltip_sbg').remove();
				} else {
					//document.getElementById("bg_img").setAttribute("style", "background: " + document.getElementById("smplbg").value);
					document.getElementById("bg_gradient_code").style.cursor = 'no-drop';
					document.getElementById("bg_gradient_code").setAttribute('disabled', 'disabled');
					document.getElementById("bg_gradient_enabled").setAttribute('disabled', 'disabled');
						$('#gettooltip_s').append('<div id="tooltip_sbg" class="tool-tip slideIn top tltp">Set <b style="color: red">OFF</b> <b>Simple Background</b></div>');
				}
			});
			</script>
	</div>
<?php }

function ap_admin_actions() {
	add_options_page("Preloader Options", "Custom Preloader", 'manage_options', "Custom_Preloader", "cp_admin_panel");
}

function settings_page_link($links) { 
  $settings_link = '<a href="options-general.php?page=Custom_Preloader">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'settings_page_link' );
// =====
// 4. Frontend
// =====
include('include/frontend.php');
?>