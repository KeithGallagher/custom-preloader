<?php
function bg_gradient_enabled(){
	$options = get_option('pr_settings');
	if(!isset($options['bg_gradient_enabled']))
	{?>
		<input type="checkbox" class="ch_location" id="bg_gradient_enabled" style="display: none;" name="pr_settings[bg_gradient_enabled]" <?php if(isset($options['enabled_settings']) && !isset($options['bg_gradient_enabled'])) {echo 'disabled';}?> />
	<?}
	else
	{?>
		<input type="checkbox" class="ch_location" id="bg_gradient_enabled" style="display: none;" name="pr_settings[bg_gradient_enabled]" <?php if(isset($options['enabled_settings']) && !isset($options['bg_gradient_enabled'])) {echo 'disabled';}?> <?php if (isset($options['bg_gradient_enabled']) && !isset($options['enabled_settings'])) { echo 'checked';}?> />
	<?php
	}    
}


function gradient_section_text(){
	echo '<div id="colorful_bg" style="display:none">';
		$gradient_path = $plugin_dir . 'gradient.php';
		include($gradient_path);
	echo '</div>';
}

function advanced_section_text()
{
	$title['image_width_settings'] = 'Image width';
	$title['image_height_settings'] = 'Image Height';
	$title['image_margin_top'] = 'Image Margin Top';
	$title['image_margin_left'] = 'Image Margin Left';
	$title['image_margin_right'] = 'Image Margin Right';
	$title['image_margin_bottom'] = 'Image Margin Bottom';
	$options = get_option('pr_settings');
	echo '<div id="positions" style="display:none"><div id="contact_main" style="width:100%; height:100%;"><div class="content" style=" padding: 5px; ">';
	echo '<table class="form-table"><tbody>';
	
	/**********		image_width_settings	**********/
	echo '<tr>';
		echo '<th scope="row">'.$title['image_width_settings'].'</th>';
			echo '<td>';
				echo '<input type="text" id="image_width_settings" name="pr_settings[image_width_settings]" value="'; if(isset($options['image_width_settings'])) { echo $options['image_width_settings'];} else { echo $default_settings['image_width_settings'];} echo '" />';
			echo '</td>';
	echo '</tr>';

	/**********		image_height_settings	**********/
	echo '<tr>';
		echo '<th scope="row">'.$title['image_height_settings'].'</th>';
			echo '<td>';
				echo '<input type="text" id="image_height_settings" name="pr_settings[image_height_settings]" value="'; if(isset($options['image_height_settings'])) { echo $options['image_height_settings'];} else { echo $default_settings['image_height_settings'];} echo '" />';
			echo '</td>';
	echo '</tr>';
	
	/**********		image_margin_top	**********/
	echo '<tr>';
		echo '<th scope="row">'.$title['image_margin_top'].'</th>';
			echo '<td>';
				echo '<input type="text" id="image_margin_top" name="pr_settings[image_margin_top]" value="'; if(isset($options['image_margin_top'])) { echo $options['image_margin_top'];} else { echo $default_settings['image_margin_top'];} echo '" />';
			echo '</td>';
	echo '</tr>';

	/**********		image_margin_left	**********/
	echo '<tr>';
		echo '<th scope="row">'.$title['image_margin_left'].'</th>';
			echo '<td>';
				echo '<input type="text" id="image_margin_left" name="pr_settings[image_margin_left]" value="'; if(isset($options['image_margin_left'])) { echo $options['image_margin_left'];} else { echo $default_settings['image_margin_left'];} echo '" />';
			echo '</td>';
	echo '</tr>';
	
	/**********		image_margin_right	**********/
	echo '<tr>';
		echo '<th scope="row">'.$title['image_margin_right'].'</th>';
			echo '<td>';
				echo '<input type="text" id="image_margin_right" name="pr_settings[image_margin_right]" value="'; if(isset($options['image_margin_right'])) { echo $options['image_margin_right'];} else { echo $default_settings['image_margin_right'];} echo '" />';
			echo '</td>';
	echo '</tr>';

	/**********		image_margin_bottom	**********/
	echo '<tr>';
		echo '<th scope="row">'.$title['image_margin_bottom'].'</th>';
			echo '<td>';
				echo '<input type="text" id="image_margin_bottom" name="pr_settings[image_margin_bottom]" value="'; if(isset($options['image_margin_bottom'])) { echo $options['image_margin_bottom'];} else { echo $default_settings['image_margin_bottom'];} echo '" />';
			echo '</td>';
	echo '</tr>';
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
	if(!isset($options['enabled_settings']))
	{?>
		<input type="checkbox" class="ch_location" id="slideThree" style="display: none;" name="pr_settings[enabled_settings]" <?php if(isset($options['bg_gradient_enabled']) && !isset($options['enabled_settings'])) {echo 'disabled';}?> />
	<?php
	}
	else
	{?>
		<input type="checkbox" class="ch_location" id="slideThree" style="display: none;" name="pr_settings[enabled_settings]" <?php if(isset($options['bg_gradient_enabled']) && !isset($options['enabled_settings'])) {echo 'disabled';}?> <?php if (isset($options['enabled_settings']) && !isset($options['bg_gradient_enabled'])) { echo 'checked';}?> />
	<?php
	}    
}

function bg_gradient_code() {
	$options = get_option('pr_settings');
	if(!isset($options['bg_gradient_enabled']))
	{
		$value = $default_settings['bg_gradient_code'];
	}
	else if(isset($options['bg_gradient_enabled']))
	{
		$value = $options['bg_gradient_code'];
	}
?>
	<div class="">
	<textarea type="text" id="bg_gradient_code" name="pr_settings[bg_gradient_code]" class="bg_gradient_codeee"><?php echo $value; ?></textarea>
		<div style="margin-left: -250px;margin-bottom: 41px;top: 150px;" class="tool-tip slideIn top"><?php if( isset($options['enabled_settings'])  && !isset($options['bg_gradient_enabled'])) { echo 'Set OFF Simple Background';} else { echo 'Add your CSS Code Here';}?></div>
	</div>

<?php
}

function bg_color_settings()
{
	$options = get_option('pr_settings');
	if(!isset($options['bg_color_settings']))
	{  
		$value = $default_settings['bg_color_settings'];
	}
	else
	{
		$value = $options['bg_color_settings'];
	}
?>
	<script type="text/javascript" src="<?php echo plugins_url( 'js/jscolor.js', dirname(__FILE__) );?>"></script>
	<input type="text" class="color" id="smplbg" onchange="document.getElementById('bg_img').style.background = document.getElementById('smplbg').value" name="pr_settings[bg_color_settings]" value="<?php echo $value; ?>" <?php if(isset($options['bg_gradient_enabled']) && !isset($options['enabled_settings'])) { echo ' disabled '; echo ' style="cursor: no-drop;"';}?>/>
<?php }

function image_settings() {
	$options = get_option('pr_settings');
	if(!isset($options['image_settings']))
	{
		$value = $default_settings['image_settings']; 
	}
	else
	{
		$value = $options['image_settings'];
	}
?>
	
	<input type="text" id="image_settings" name="pr_settings[image_settings]" onchange="document.getElementById('onchange_image').src = document.getElementById('image_settings').value" style="margin-bottom: -5px;" value="<?php echo $value; ?>" />
		<hr class="hr_b">
	<img class="onchange_image hr_img" id="onchange_image" src="<?php echo $value; ?>">
	<div id="bg_img" <?php if(isset($options['bg_gradient_enabled']) && !isset($options['enabled_settings'])) { echo ' style="'. $options['bg_gradient_code'] .'"';} if(isset($options['enabled_settings']) && !isset($options['bg_gradient_enabled'])) { echo ' style="background: '. $options['bg_color_settings'] .';"';}?>></div>

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