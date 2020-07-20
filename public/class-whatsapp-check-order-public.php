<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://github.com/Necrowolf132
 * @since      1.0.0
 *
 * @package    Whatsapp_Check_Order
 * @subpackage Whatsapp_Check_Order/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Whatsapp_Check_Order
 * @subpackage Whatsapp_Check_Order/public
 * @author     Necrowolf <manjou132@gmil.com>
 */
class Whatsapp_Check_Order_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/whatsapp-check-order-public.css', array('woocommerce-general', 'woocommerce-smallscreen'), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/whatsapp-check-order-public.js', array( 'jquery' ), $this->version, false );

	}
	public function generate_button($button){
		$contenido = WC()->cart->cart_contents;
		$simbol_moneda = get_woocommerce_currency_symbol();
		$url_api ="https://api.whatsapp.com/send?phone=584164000939&text=";
		foreach ($contenido as &$valor) {
			$axuliar_cadena .= "(cod: ".$valor['product_id'].") x ".$valor['quantity']." -> ".$valor['line_total']." ".$simbol_moneda."%0A"; 
		}
		$axuliar_cadena .= "--Total-- " . WC()->cart->get_total(false)." ".$simbol_moneda;
		$url_api.=$axuliar_cadena;
		return	"
		<div class='button-whatsapp-container '>
			<div class='button-whatsapp'>
				<div>	
					<span>Envianos tu pedido ---> </span>
					<a href='".$url_api."' target='_blank'>
						<img src='".plugin_dir_url( __FILE__ ).'img/iconmonstr-whatsapp-4.svg'."' alt=''> 
					</a>
				</div>".
				$button
		   ."</div>
		</div>";
	}

}