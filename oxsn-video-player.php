<?php


defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/*
Plugin Name: OXSN Video Player
Plugin URI: https://wordpress.org/plugins/oxsn-video-player/
Description: This plugin adds a video player shortcode!
Author: oxsn
Author URI: https://oxsn.com/
Version: 0.0.5
*/


define( 'oxsn_video_player_plugin_basename', plugin_basename( __FILE__ ) );
define( 'oxsn_video_player_plugin_dir_path', plugin_dir_path( __FILE__ ) );
define( 'oxsn_video_player_plugin_dir_url', plugin_dir_url( __FILE__ ) );

if ( ! function_exists ( 'oxsn_video_player_settings_link' ) ) {

	add_filter( 'plugin_action_links', 'oxsn_video_player_settings_link', 10, 2 );
	function oxsn_video_player_settings_link( $links, $file ) {

		if ( $file != oxsn_video_player_plugin_basename )
		return $links;
		$settings_page = '<a href="' . menu_page_url( 'oxsn-video-player', false ) . '">' . esc_html( __( 'Settings', 'oxsn-video-player' ) ) . '</a>';
		array_unshift( $links, $settings_page );
		return $links;

	}

}


/* OXSN Dashboard Tab */

if ( !function_exists('oxsn_dashboard_tab_nav_item') ) {

	add_action('admin_menu', 'oxsn_dashboard_tab_nav_item');
	function oxsn_dashboard_tab_nav_item() {

		add_menu_page('OXSN', 'OXSN', 'manage_options', 'oxsn-dashboard', 'oxsn_dashboard_tab' );

	}

}

if ( !function_exists('oxsn_dashboard_tab') ) {

	function oxsn_dashboard_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap">
		
			<h2>OXSN / Digital Agency</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Coming Soon</h3>

							<div class="inside">

								<p></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


/* OXSN Plugin Tab */

if ( ! function_exists ( 'oxsn_video_player_plugin_tab_nav_item' ) ) {

	add_action('admin_menu', 'oxsn_video_player_plugin_tab_nav_item', 99);
	function oxsn_video_player_plugin_tab_nav_item() {

		add_submenu_page('oxsn-dashboard', 'OXSN Video Player', 'Video Player', 'manage_options', 'oxsn-video-player', 'oxsn_video_player_plugin_tab');

	}

}

if ( !function_exists('oxsn_video_player_plugin_tab') ) {

	function oxsn_video_player_plugin_tab() {

		if (!current_user_can('manage_options')) {

			wp_die( __('You do not have sufficient permissions to access this page.') );

		}

	?>

		<?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y') : ?>

			<div id="message" class="updated">

				<p><strong><?php _e('Settings saved.') ?></strong></p>

			</div>

		<?php endif; ?>
		
		<div class="wrap oxsn_settings_page">
		
			<h2>OXSN / Video Player Plugin</h2>

			<div id="poststuff">

				<div id="post-body" class="metabox-holder columns-2">

					<div id="post-body-content" style="position: relative;">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Information</h3>

							<div class="inside">

								<p>Coming Soon</p>

							</div>
							
						</div>

					</div>

					<div id="postbox-container-1" class="postbox-container">

						<div class="postbox">

							<h3 class="hndle cursor_initial">Custom Project</h3>

							<div class="inside">

								<p>Want us to build you a custom project?</p>

								<p><a href="mailto:brief@oxsn.com?Subject=Custom%20Project%20Request%21&Body=Please%20answer%20the%20following%20questions%20to%20help%20us%20better%20understand%20your%20needs..%0A%0A1.%20What%20is%20the%20name%20of%20your%20company%3F%0A%0A2.%20What%20are%20the%20concepts%20and%20goals%20of%20your%20project%3F%0A%0A3.%20What%20is%20the%20proposed%20budget%20of%20this%20project%3F" class="button button-primary button-large">Email Us</a></p>

							</div>
							
						</div>

						<div class="postbox">

							<h3 class="hndle cursor_initial">Support</h3>

							<div class="inside">

								<p>Need help with this plugin? Visit the Wordpress plugin page for support..</p>

								<p><a href="https://wordpress.org/support/plugin/oxsn-video-player" target="_blank" class="button button-primary button-large">Support</a></p>

							</div>
							
						</div>

					</div>

				</div>

			</div>

		</div>

	<?php 

	}

}


/* OXSN Include CSS */

if ( ! function_exists ( 'oxsn_video_player_inc_css' ) ) {

  add_action( 'wp_enqueue_scripts', 'oxsn_video_player_inc_css' );
  function oxsn_video_player_inc_css() {

  	wp_enqueue_style( 'oxsn_video_player_css', oxsn_video_player_plugin_dir_url . 'inc/css/etc.css', array(), '1.0.0', 'all' ); 

  }

}


/* OXSN Shortcodes */

//[oxsn_video_player mp4="" ogg="" autoplay="false" loop="false" poster="" class=""]
if ( ! function_exists ( 'oxsn_video_player_shortcode' ) ) {

	add_shortcode('oxsn_video_player', 'oxsn_video_player_shortcode');
	function oxsn_video_player_shortcode( $atts, $content = null ) {
		$content = shortcode_unautop(trim($content));
		$a = shortcode_atts( array(
			'class' => '',
			'youtube' => '',
			'vimeo' => '',
			'mp4' => '',
			'ogg' => '',
			'ogv' => '',
			'webm' => '',
			'autoplay' => '',
			'loop' => '',
			'poster' => '',
		), $atts );

		$oxsn_video_player_class = esc_attr($a['class']);

		$oxsn_video_player_youtube = esc_attr($a['youtube']);
		$oxsn_video_player_vimeo = esc_attr($a['vimeo']);
		$oxsn_video_player_mp4 = esc_attr($a['mp4']);
		$oxsn_video_player_ogg = esc_attr($a['ogg']);
		$oxsn_video_player_ogv = esc_attr($a['ogv']);
		$oxsn_video_player_webm = esc_attr($a['webm']);
		$oxsn_video_player_autoplay = esc_attr($a['autoplay']);
		$oxsn_video_player_loop = esc_attr($a['loop']);
		$oxsn_video_poster = esc_attr($a['poster']);

		if($oxsn_video_player_autoplay === 'true') :
			$autoplay = 'autoplay';
			$youtube_autoplay = '&autoplay=1';
			$vimeo_autoplay = '&autoplay=1';
		endif; 

		if($oxsn_video_player_loop === 'true') :
			$loop = 'autoplay';
			$youtube_loop = '&loop=1';
			$vimeo_loop = '&loop=1';
		endif; 

		if ($oxsn_video_player_mp4 != "" | $oxsn_video_player_ogg != "" | $oxsn_video_player_ogv != "" | $oxsn_video_player_webm != "") :

			$option .=
			'<div class="oxsn_video_player ' . $oxsn_video_player_class . '">' .
				do_shortcode($content) .
				'<video class="oxsn_video_player_video_bg" controls ' . $autoplay . ' ' . $loop . ' poster="' . $oxsn_video_poster . '">';

					if ($oxsn_video_player_mp4 != "") :

						$option .= '<source src="' . $oxsn_video_player_mp4 . '" type="video/mp4">';

					endif;

					if ($oxsn_video_player_ogg != "") :

						$option .= '<source src="' . $oxsn_video_player_ogg . '" type="video/ogg">';

					endif;

					if ($oxsn_video_player_ogv != "") :

						$option .= '<source src="' . $oxsn_video_player_ogv . '" type="video/ogg">';

					endif;

					if ($oxsn_video_player_webm != "") :

						$option .= '<source src="' . $oxsn_video_player_webm . '" type="video/webm">';

					endif;

			$option .=
				'</video>' .
			'</div>';

		elseif ($oxsn_video_player_youtube != "") :

			elseif (strpos($oxsn_video_player_youtube, 'youtube') > 0) :

				parse_str( parse_url( $oxsn_video_player_youtube, PHP_URL_QUERY ), $my_array_of_vars );
				$oxsn_video_player_youtube =  $my_array_of_vars['v'];

				$option .=
				'<div class="oxsn_video_player ' . $oxsn_video_player_class . '">' .
					do_shortcode($content) .
					'<iframe class="oxsn_video_player_video_bg" width="560" height="315" src="https://www.youtube.com/embed/' . $oxsn_video_player_youtube . '?rel=0' . $youtube_autoplay . $youtube_loop . '" frameborder="0" allowfullscreen></iframe>' .
				'</div>';

		if ($oxsn_video_player_vimeo != "") :

			elseif (strpos($oxsn_video_player_vimeo, 'vimeo') > 0) :

				preg_match("/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([0-9]{6,11})[?]?.*/", $oxsn_video_player_vimeo, $output_id);
				$oxsn_video_player_vimeo = $output_id[5];

				$option .=
				'<div class="oxsn_video_player ' . $oxsn_video_player_class . '">' .
					do_shortcode($content) .
					'<iframe class="oxsn_video_player_video_bg" src="https://player.vimeo.com/video/' . $oxsn_video_player_vimeo . '?automute=0' . $vimeo_autoplay . $vimeo_loop . '" width="500" height="281" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>' .
				'</div>';

			endif;

		endif;

		return $option;

	}

}


/* OXSN Quicktags */

if ( ! function_exists ( 'oxsn_video_player_quicktags' ) ) {

	add_action( 'admin_print_footer_scripts', 'oxsn_video_player_quicktags' );
	function oxsn_video_player_quicktags() {

		if ( wp_script_is( 'quicktags' ) ) {

		?>

			<script type="text/javascript">
				QTags.addButton( 'oxsn_video_player_quicktag', '[oxsn_video_player]', '[oxsn_video_player mp4="" ogg="" class=""]', '[/oxsn_video_player]', 'oxsn_video_player', 'Video Player', 201 );
			</script>

		<?php

		}

	}

}


?>