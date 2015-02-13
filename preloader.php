<?php

/*
Plugin Name: Custom Preloader
Plugin URI: https://wordpress.org/plugins/custom-preloader/
Description: Custom Preloader it's a plugin that it shows to you something, and behind that your website is loading. When your website it's ready then Custom Preloader Goes Off
Version: 1.2
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
        'enabled_settings' 			=> 'checked',
        'bg_color_settings' 		=> '#eeeeee',
		'bg_gradient_enabled' 		=> 'checked',
		'bg_gradient_code' 			=> '',
        'image_settings' 			=> '',
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
	add_settings_field('image_width_settings', 'Image Width', 'image_width_settings', __FILE__, 'main_section');
	add_settings_field('image_height_settings', 'Image Height', 'image_height_settings', __FILE__, 'main_section');
	// Gradient Color
	add_settings_section('gradient_section', '<div id="gradient"><a href="#collapse2">ColorFul Background</a></div>', 'gradient_section_text', gradient_section_text);		// Advanced Section
	// Fields Of Gradient Color
	add_settings_field('bg_gradient_enabled', '', 'bg_gradient_enabled', __FILE__, 'gradient_section');
		
	add_settings_section('advanced_section', '<div id="advanced"><a href="#collapse1">Advanced</a></div>', 'advanced_section_text', advanced_section_text);
	// Fields Of Advanced Section
	add_settings_field('image_margin_top', '', 'image_margin_top', __FILE__, 'advanced_section');
	add_settings_field('image_margin_left', '', 'image_margin_left', __FILE__, 'advanced_section');
	add_settings_field('image_margin_right', '', 'image_margin_right', __FILE__, 'advanced_section');
	add_settings_field('image_margin_bottom', '', 'image_margin_bottom', __FILE__, 'advanced_section');
}
add_action('admin_init', 'pr_settings_init' );

function main_section_text(){
}

function bg_gradient_enabled(){
	$options = get_option('pr_settings');
	if(!isset($options['bg_gradient_enabled']))
	{
		$options['bg_gradient_enabled'] = true;
		echo "<input type='checkbox' name='pr_settings[bg_gradient_enabled]' value='1' checked='checked'/>";
	}
	else
	{
		$options['bg_gradient_enabled'] = false;
		echo "<input type='checkbox' name='pr_settings[bg_gradient_enabled]' value='1'/>";
	}    
}

function gradient_section_text(){
	echo '<div id="collapse2" style="display:none">';
		$gradient_path = $plugin_dir . 'gradient.php';
		include($gradient_path);
	echo '</div>';
}

function advanced_section_text()
{
	$title['image_margin_top'] = 'Image Margin Top';
	$title['image_margin_left'] = 'Image Margin Left';
	$title['image_margin_right'] = 'Image Margin Right';
	$title['image_margin_bottom'] = 'Image Margin Bottom';
	$options = get_option('pr_settings');
	echo '<div id="collapse1" style="display:none"><div id="contact_main" style="width:100%; height:100%;"><div class="content" style=" padding: 5px; ">';
	echo '<table class="form-table"><tbody>';
	if(!isset($options['image_margin_top']))
	{
		$value = 'auto';
		echo '<tr>';
			echo '<th scope="row">'.$title['image_margin_top'].'</th>';
				echo '<td>';
					echo '<input type="text" id="image_margin_top" name="pr_settings[image_margin_top]" value="'.$value.'" />';
				echo '</td>';
		echo '</tr>';
	}
	else
	{
		$value = $options['image_margin_top'];
		echo '<tr>';
			echo '<th scope="row">'.$title['image_margin_top'].'</th>';
				echo '<td>';
					echo '<input type="text" id="image_margin_top" name="pr_settings[image_margin_top]" value="'.$value.'" />';
				echo '</td>';
		echo '</tr>';
	}

	if(!isset($options['image_margin_left']))
	{
		$value = 'auto';
		echo '<tr>';
			echo '<th scope="row">'.$title['image_margin_left'].'</th>';
				echo '<td>';
					echo '<input type="text" id="image_margin_left" name="pr_settings[image_margin_left]" value="'.$value.'" />';
				echo '</td>';
		echo '</tr>';
	}
	else
	{
		$value = $options['image_margin_left'];
		echo '<tr>';
			echo '<th scope="row">'.$title['image_margin_left'].'</th>';
				echo '<td>';
					echo '<input type="text" id="image_margin_left" name="pr_settings[image_margin_left]" value="'.$value.'" />';
				echo '</td>';
		echo '</tr>';
	}

	if(!isset($options['image_margin_right']))
	{
		$value = 'auto';
		echo '<tr>';
			echo '<th scope="row">'.$title['image_margin_right'].'</th>';
				echo '<td>';
					echo '<input type="text" id="image_margin_right" name="pr_settings[image_margin_right]" value="'.$value.'" />';
				echo '</td>';
		echo '</tr>';
	}
	else
	{
		$value = $options['image_margin_right'];
		echo '<tr>';
			echo '<th scope="row">'.$title['image_margin_right'].'</th>';
				echo '<td>';
					echo '<input type="text" id="image_margin_right" name="pr_settings[image_margin_right]" value="'.$value.'" />';
				echo '</td>';
		echo '</tr>';
	}

	if(!isset($options['image_margin_bottom']))
	{
		$value = 'auto';
		echo '<tr>';
			echo '<th scope="row">'.$title['image_margin_bottom'].'</th>';
				echo '<td>';
					echo '<input type="text" id="image_margin_bottom" name="pr_settings[image_margin_bottom]" value="'.$value.'" />';
				echo '</td>';
		echo '</tr>';
	}
	else
	{
		$value = $options['image_margin_bottom'];
		echo '<tr>';
			echo '<th scope="row">'.$title['image_margin_bottom'].'</th>';
				echo '<td>';
					echo '<input type="text" id="image_margin_bottom" name="pr_settings[image_margin_bottom]" value="'.$value.'" />';
				echo '</td>';
		echo '</tr>';
	}
	echo '</table></tbody></div></div></div>';
}

function pr_settings_validate($input) {
	return $input; 
}


// =====
// 3. Admin Panel (Settings > Custom Preloader)
// =====

// Options' functions
function enabled_settings()
{
	$options = get_option('pr_settings');
	if(isset($options['enabled_settings']))
	{
		$options['enabled_settings'] = true;
		echo "<input type='checkbox' name='pr_settings[enabled_settings]' value='1' checked='checked'/>";
	}
	else
	{
		$options['enabled_settings'] = false;
		echo "<input type='checkbox' name='pr_settings[enabled_settings]' value='1'/>";
	}    
	echo '<p class="description">Enable/Disable preloader.</p>';
}

function bg_color_settings()
{
	$options = get_option('pr_settings');
	if(!isset($options['bg_color_settings']))
	{  
		$value = '#eeeeee';
	}
	else
	{
		$value = $options['bg_color_settings'];
	} ?>
	<script type="text/javascript" src="<?php echo plugins_url( 'js/jscolor.js', __FILE__ );?>"></script>
	<input type="text" class="color" name="pr_settings[bg_color_settings]" value="<?php echo $value; ?>" <?php if(isset($options['bg_gradient_enabled'])) {echo 'disabled'; echo ' style="cursor: no-drop;"';}?>/>
<?php }

function image_settings() {
	$options = get_option('pr_settings');
	if(!isset($options['image_settings'])){
		$value = 'http://i.imgur.com/Gh9muk7.png'; 
	}else{
		$value = $options['image_settings'];
	}
?>
	
	<input type="text" id="image_settings" name="pr_settings[image_settings]" value="<?php echo $value; ?>" />
    <input type="button" onclick="document.getElementById('image-placeholder').src = document.getElementById('image_settings').value" value="Preview">
	<img style="max-height:100px; max-width: 100px;margin: -20px 0;" id="image-placeholder" src="" alt="" />

<?php }

function image_width_settings() {
	$options = get_option('pr_settings');
	if(!isset($options['image_width_settings'])){
		$value = '150px';
	}else{
		$value = $options['image_width_settings'];
	}
?>
	<input type="text" id="image_width_settings" name="pr_settings[image_width_settings]" value="<?php echo $value; ?>" />
<?php }

function image_height_settings() {
	$options = get_option('pr_settings');
	if(!isset($options['image_height_settings'])){
		$value = '150px';
	}else{
		$value = $options['image_height_settings'];
	}
?>
	<input type="text" id="image_height_settings" name="pr_settings[image_height_settings]" value="<?php echo $value; ?>" />
<?php }

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
										<input type="checkbox" class="ch_location" value="None" id="slideThree" style="display: none;" name="pr_settings[enabled_settings]" <?php if(isset($options['bg_gradient_enabled'])) {echo 'disabled';}?> <?php if (isset($options['enabled_settings'])) { echo 'checked="true"';}?> />
										<label for="slideThree"><?php if(isset($options['bg_gradient_enabled'])) { echo '<div class="tool-tip slideIn top">Set Off <b>ColorFul Background</b></div>'; }?></label>
									</div>
							</section>
							<section style=" margin-bottom: -30px !important; ">
								<p>ColorFul Background: </p>
									<div class="slideThree">
										<input type="checkbox" class="ch_location" value="None" id="bg_gradient_enabled" style="display: none;" name="pr_settings[bg_gradient_enabled]" <?php if(isset($options['enabled_settings'])) {echo 'disabled';}?> <?php if (isset($options['bg_gradient_enabled'])) { echo 'checked="true"';}?> />
										<label for="bg_gradient_enabled"><?php if(isset($options['enabled_settings'])) { echo '<div class="tool-tip slideIn top">Set Off <b>Simple Background</b></div>'; }?></label>
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
					<script>
					$('#advanced a').click(function () {
						//get collapse content selector
						var collapse_content_selector = $(this).attr('href');
						//make the collapse content to be shown or hide
						var toggle_switch = $(this);
						$(collapse_content_selector).slideToggle(function () {
							$(this).is(':visible')? toggle_switch.text('Close') : toggle_switch.text('Advanced');
						});
					});
					</script>
					<script>
					$('#gradient a').click(function () {
						//get collapse content selector
						var collapse_content_selector = $(this).attr('href');
						//make the collapse content to be shown or hide
						var toggle_switch = $(this);
						$(collapse_content_selector).slideToggle(function () {
							$(this).is(':visible')? toggle_switch.text('Close ColorFul Background') : toggle_switch.text('ColorFul Background');
						});
					});
					</script>
					<p class="submit" style="margin-left: 10px;">
						<input id="submit-cp-options" name="Submit" type="submit" class="button-primary" value="<?php esc_attr_e('Save Changes'); ?>" />
					</p>
					<div class="submit" style="margin-left: 130px;margin-top: -72px;">
						<a href="https://wordpress.org/support/view/plugin-reviews/custom-preloader" target="_blank" class="button-secondary">Rate Plugin</a>
					</div>
					<?php
					function custom_preloader_version() {
						echo '<p>Custom-Preloader | 1.1</p>';
					}
					add_action('wp_footer', 'custom_preloader_version');
					?>
				</div>
			</div>
		</form>
	</div>
<?php }

function ap_admin_actions() {
	add_options_page("Preloader Options", "Custom Preloader", 'manage_options', "Custom_Preloader", "cp_admin_panel");
}
// =====
// 4. Frontend
// =====
function enqueue_AP()
{
	$options = get_option('pr_settings');
	wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'enqueue_AP');
	// add in <head>
	function head_cpreloader()
	{
		$options = get_option('pr_settings');
		if(isset($options['enabled_settings']))
		{
			if(is_home() || is_front_page())
			{
				echo "<script type='text/javascript' >
					window.addEventListener('load', function load(event){
						window.removeEventListener('load', load, false);
						console.log('window load');
						jQuery('#preloader').fadeOut();
						jQuery('#preloader_style').remove();
					},false);
				</script>";
			}
		}
		$options = get_option('pr_settings');
		if(isset($options['bg_gradient_enabled']))
		{
			if(is_home() || is_front_page())
			{
				echo "<script type='text/javascript' >
					window.addEventListener('load', function load(event){
						window.removeEventListener('load', load, false);
						console.log('window load');
						jQuery('#preloader').fadeOut();
						jQuery('#preloader_style').remove();
					},false);
				</script>";
			}
		}
	}
	add_action('wp_head', 'head_cpreloader');
	// add in Footer
	function footer_cpreloader()
	{
		$options = get_option('pr_settings');
		if(isset($options['enabled_settings']))
		{
			if(is_home() || is_front_page())
			{
				$imgt = '<img src="'.$options['image_settings'].'" alt="preloader" style=" position: absolute; top: 50%; left: 50%; margin: '.$options['image_margin_top'].' '.$options['image_margin_right'].' '.$options['image_margin_bottom'].' '.$options['image_margin_left'].'; padding: 0 0 0 0; width: '.$options['image_width_settings'].' ; height: '.$options['image_height_settings'].'; " />';
				$divt = '<div id="preloader" style="background-color: ' . $options['bg_color_settings'] . ';  position: fixed; top: 1px; width: 100%; height: 100%; z-index: 9999999999999;">'.$imgt.'</div><style id="preloader_style">html {overflow:hidden;}</style>';
				echo $divt;
			}
		}
		$options = get_option('pr_settings');
		if(isset($options['bg_gradient_enabled']))
		{
			if(is_home() || is_front_page())
			{
				$imgt = '<img src="'.$options['image_settings'].'" alt="preloader" style=" position: absolute; top: 50%; left: 50%; margin: '.$options['image_margin_top'].' '.$options['image_margin_right'].' '.$options['image_margin_bottom'].' '.$options['image_margin_left'].'; padding: 0 0 0 0; width: '.$options['image_width_settings'].' ; height: '.$options['image_height_settings'].'; " />';
				$divt = '<div id="preloader" style="background-color: ' . $options['bg_gradient_code'] . ';  position: fixed; top: 1px; width: 100%; height: 100%; z-index: 9999999999999;">'.$imgt.'</div><style id="preloader_style">html {overflow:hidden;}</style>';
				echo $divt;
			}
		}
	}
	add_action('wp_footer', 'footer_cpreloader');
?>