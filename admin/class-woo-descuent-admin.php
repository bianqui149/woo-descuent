<?php

/**
 *
 * @author Bianqui Julian
 */
class Woo_Descuent {

	/**
	 * Used for singleton class
	 * @staticvar instance
	 */
	static $instance = null;
	/**
	 * @var constant standarize the save action key
	 */
	

	/**
	 * Used to keep a singleton of the current class
	 * @return Class
	 */
	public static function instance() {
		if (!self::$instance) {
			$class = __CLASS__;
			self::$instance = new $class;
		}

		return self::$instance;
	}

	/**
	 * Construct the class and initialize some parameters for this one
	 */
	public function __construct() {
		
		add_action('woocommerce_product_options_general_product_data', array($this,'woocommerce_product_custom_fields'));
 		add_action('woocommerce_process_product_meta', array($this,'woocommerce_product_custom_fields_save'));
 		add_action( 'woocommerce_product_after_variable_attributes', array($this,'variation_settings_fields'), 10, 3 );
		add_action( 'woocommerce_save_product_variation', array($this,'save_variation_settings_fields'), 10, 2 );
	}

	function woocommerce_product_custom_fields() {
	    global $woocommerce, $post;
	    echo '<div class="product_custom_field">';
	    
	    //Custom Product Number Field
	    woocommerce_wp_text_input(
	        array(
	            'id' => '_custom_product_number_field',
	            'placeholder' => 'Add porcentaje Descuent',
	            'label' => __('Descuent', 'woocommerce'),
	            'type' => 'number',
	            'custom_attributes' => array(
	                'step' => 'any',
	                'min' => '0'
	            )
	        )
	    );
	    
	    echo '</div>';
	 
	}

	function woocommerce_product_custom_fields_save($post_id) {

	    $woocommerce_custom_product_number_field = $_POST['_custom_product_number_field'];
	    if (!empty($woocommerce_custom_product_number_field))
	        update_post_meta($post_id, '_custom_product_number_field', esc_attr($woocommerce_custom_product_number_field));
	
	}
	
	/**
	 * Create new fields for variations
	 *
	*/
	function variation_settings_fields( $loop, $variation_data, $variation ) {
		
		// Number Field
		woocommerce_wp_text_input( 
			array( 
				'id'          => '_number_field[' . $variation->ID . ']', 
				'label'       => __( 'Descuent', 'woocommerce' ),
				'type'        => 'number', 
				'desc_tip'    => 'true',
				'description' => __( 'Enter the custom descuent here.', 'woocommerce' ),
				'value'       => get_post_meta( $variation->ID, '_number_field', true ),
				'custom_attributes' => array(
								'step' 	=> 'any',
								'min'	=> '0'
							) 
			)
		);

	}
	/**
	 * Save new fields for variations
	 *
	*/
	function save_variation_settings_fields( $post_id ) {
		
		
		// Number Field
		$number_field = $_POST['_number_field'][ $post_id ];
		if( ! empty( $number_field ) ) {
			update_post_meta( $post_id, '_number_field', esc_attr( $number_field ) );
		}
		
	}


	
}

$woo_descuent = Woo_Descuent::instance();
?>