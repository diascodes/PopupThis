<?php 
/**
 * @package PopupThis
 * @version 1.0
 */
/*
Plugin Name: PopupThis
Plugin URI: http://www.diascodes.com/
Description: The simplest way to generate popups from your content
Author: SAID ASSEMLAL
Version: 1.0
Author URI: http://www.diascodes.com
*/


if (!defined('POPUPTHIS_VERSION'))
    define('POPUPTHIS_VERSION', '1.0');

if (!defined('POPUPTHIS_URL'))
    define('POPUPTHIS_URL', plugins_url( '/', __FILE__ ) );


if( !class_exists('popupThis') ){

	class popupThis{

		function popupThis(){
			// Register required styles and script liberaries
			//===============================================
			wp_register_style( 'PopupthisCSS', POPUPTHIS_URL . 'css/styles.css' );
			wp_enqueue_style( 'PopupthisCSS' );
			wp_register_script( 'jQuery', POPUPTHIS_URL . 'js/jquery-1.9.1.min.js' );
			wp_register_script( 'PopupthisLIB', POPUPTHIS_URL . 'js/fancybox.js', array( 'jQuery' ) );
			wp_register_script( 'PopupthisJS', POPUPTHIS_URL . 'js/scripts.js', array( 'PopupthisLIB', 'jQuery' ) );

			// Call PopupThis Required Scripts to the footer
			//==============================================
			add_action( 'wp_footer', array( $this, 'popupThis_footer' ) );

			// Register PopupThis's button to the TinyMCE Editor
			//==================================================
			add_filter('mce_external_plugins', array( $this, 'popupThisTinyMCE' ));
			add_filter('mce_buttons',  array( $this, 'popupThisGeneratorButton' ) , 0);

			// Register the PopupThis's Shortcode
			//========================================

			add_shortcode( 'popupThis', array( $this, 'popupThisShortcodeHandler' ) );
		}

		function popupThis_footer(){
			wp_enqueue_script( 'PopupthisLIB');
			wp_enqueue_script( 'PopupthisJS');
		}

		function popupThisGeneratorButton($buttons)
		{
		    array_push($buttons, "separator", "popupThis");
		    return $buttons;
		}

		function popupThisTinyMCE($plugin_array)
		{
		    $url = POPUPTHIS_URL . "js/popupThisTinyMCE.js";

		    $plugin_array['popupThis'] = $url;
		    return $plugin_array;
		}

		function popupThisShortcodeHandler($atts, $content = null){

			extract(shortcode_atts(array(
				"label" => 'Read more',
				"autodimensions" => 'false',
				"width" => 'auto',
				"height" => 'auto'
			), $atts));

			$popupID = uniqid();
			$output = '<a data-auto-dimensions="'. $autodimensions .'" data-custom-width="'. $width .'" data-custom-height="'. $height .'" class="popupthis" href="#popupthis-'.$popupID.'">'. $label .'</a>';
			$output .= '<div style="display: none;"><div id="popupthis-' . $popupID . '" class="readmore-popupthis">'.$content.'</div></div>';
			return $output;
		}

	}

}

global $popupThis;
$popupThis = new popupThis;

?>