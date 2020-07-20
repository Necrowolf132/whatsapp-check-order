<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://github.com/Necrowolf132
 * @since      1.0.0
 *
 * @package    Whatsapp_Check_Order
 * @subpackage Whatsapp_Check_Order/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Whatsapp_Check_Order
 * @subpackage Whatsapp_Check_Order/admin
 * @author     Necrowolf <manjou132@gmil.com>
 */
class Whatsapp_Check_Order_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Whatsapp_Check_Order_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Whatsapp_Check_Order_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/whatsapp-check-order-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Whatsapp_Check_Order_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Whatsapp_Check_Order_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/whatsapp-check-order-admin.js', array( 'jquery' ), $this->version, false );

	}
	
	public function whatsapp_order_settings_init() {
		// register a new setting for "wporg" page
		register_setting( 'wporg', 'wporg_options' );
		
		// register a new section in the "wporg" page
		add_settings_section(
		'wporg_section_developers',
		__( 'The Matrix has you.', 'wporg' ),
		[$this,'whatsapp_order_developers_cb'],
		'wporg'
		);
		
		// register a new field in the "wporg_section_developers" section, inside the "wporg" page
		add_settings_field(
		'wporg_field_pill', // as of WP 4.6 this value is used only internally
		// use $args' label_for to populate the id inside the callback
		__( 'Pill', 'wporg' ),
		[$this,'whatsapp_order_field_pill_cb'],
		'wporg',
		'wporg_section_developers',
		[
		'label_for' => 'wporg_field_pill',
		'class' => 'wporg_row',
		'wporg_custom_data' => 'custom',
		]
		);
	}

	public function  whatsapp_order_developers_cb( $args ) {
	?>
		<p id="<?php echo esc_attr( $args['id'] ); ?>"><?php esc_html_e( 'Follow the white rabbit.', 'wporg' ); ?></p>
	<?php
	}

	
	public function whatsapp_order_field_pill_cb( $args ) {
		// get the value of the setting we've registered with register_setting()
		$options = get_option( 'wporg_options' );
		// output the field
	?>
		<select id="<?php echo esc_attr( $args['label_for'] ); ?>"
		data-custom="<?php echo esc_attr( $args['wporg_custom_data'] ); ?>"
		name="wporg_options[<?php echo esc_attr( $args['label_for'] ); ?>]"
		>
		<option value="red" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'red', false ) ) : ( '' ); ?>>
		<?php esc_html_e( 'red pill', 'wporg' ); ?>
		</option>
		<option value="blue" <?php echo isset( $options[ $args['label_for'] ] ) ? ( selected( $options[ $args['label_for'] ], 'blue', false ) ) : ( '' ); ?>>
		<?php esc_html_e( 'blue pill', 'wporg' ); ?>
		</option>
		</select>
		<p class="description">
		<?php esc_html_e( 'You take the blue pill and the story ends. You wake in your bed and you believe whatever you want to believe.', 'wporg' ); ?>
		</p>
		<p class="description">
		<?php esc_html_e( 'You take the red pill and you stay in Wonderland and I show you how deep the rabbit-hole goes.', 'wporg' ); ?>
		</p>
	<?php
	}

	public function whatsapp_order_options_page() {
		// add top level menu page
		add_menu_page(
		'WPOrg',
		'WPOrg Options',
		'manage_options',
		'wporg',
		[$this,'whatsapp_order_options_page_html']
		);
	}

	public function whatsapp_order_options_page_html() {
		// check user capabilities
		if ( ! current_user_can( 'manage_options' ) ) {
		return;
		}
		
		// add error/update messages
		
		// check if the user have submitted the settings
		// wordpress will add the "settings-updated" $_GET parameter to the url
		if ( isset( $_GET['settings-updated'] ) ) {
		// add settings saved message with the class of "updated"
		add_settings_error( 'wporg_messages', 'wporg_message', __( 'Settings Saved', 'wporg' ), 'updated' );
		}
		
		// show error/update messages
		settings_errors( 'wporg_messages' );
	?>
		<div class="wrap">
		<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
		<form action="options.php" method="post">
	<?php
		// output security fields for the registered setting "wporg"
		settings_fields( 'wporg' );
		// output setting sections and their fields
		// (sections are registered for "wporg", each field is registered to a specific section)
		do_settings_sections( 'wporg' );
		// output save settings button
		submit_button( 'Save Settings' );
	?>
		</form>
		</div>
	<?php
	}
}
