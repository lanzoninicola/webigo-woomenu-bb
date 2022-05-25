<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://webigo.com.br
 * @since      1.0.0
 *
 * @package    Webigo_Woomenu
 * @subpackage Webigo_Woomenu/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Webigo_Woomenu
 * @subpackage Webigo_Woomenu/includes
 * @author     Lanzoni Nicola <lanzoni.nicola@gmail.com>
 */
class Webigo_Woomenu_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'webigo-woomenu',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
