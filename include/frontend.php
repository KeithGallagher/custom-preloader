<?php
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
				$divt = '<div id="preloader" style="' . $options['bg_gradient_code'] . ';  position: fixed; top: 1px; width: 100%; height: 100%; z-index: 9999999999999;">'.$imgt.'</div><style id="preloader_style">html {overflow:hidden;}</style>';
				echo $divt;
			}
		}
	}
	add_action('wp_footer', 'footer_cpreloader');