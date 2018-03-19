<?php

/**
 *
 * @author Bianqui Julian
 */
class Descuent_Apply
{

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
    public static function instance()
    {
        if (!self::$instance) {
            $class          = __CLASS__;
            self::$instance = new $class;
        }

        return self::$instance;
    }

    /**
     * Construct the class and initialize some parameters for this one
     */
    public function __construct()
    {

        add_filter('woocommerce_product_get_price', array($this, 'return_custom_price'), 10, 2);
    }
    public function return_custom_price($price, $product)
    {
        global $post, $woocommerce;

        $post_id = get_the_ID();

        $descuent = get_post_meta($post_id, '_custom_product_number_field');
        if (!empty($descuent[0])) {

            $descuent_final = ($descuent[0] / 100) * $price;

            $desc = $price - $descuent_final;

            return $desc;
        } else {

            return $price;
        }

    }

}

$descuent = Descuent_Apply::instance();
