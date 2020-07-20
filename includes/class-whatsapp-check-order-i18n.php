<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://github.com/Necrowolf132
 * @since      1.0.0
 *
 * @package    Whatsapp_Check_Order
 * @subpackage Whatsapp_Check_Order/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Whatsapp_Check_Order
 * @subpackage Whatsapp_Check_Order/includes
 * @author     Necrowolf <manjou132@gmil.com>
 */
class Whatsapp_Check_Order_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'whatsapp-check-order',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
