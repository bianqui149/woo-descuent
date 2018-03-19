<?php

/**
 * @author Bianqui Julián
 */
class UpdatePrice
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
        add_action('woocommerce_single_product_summary', array($this, 'woocommerce_total_product_price'), 31);
    }

    public function woocommerce_total_product_price()
    {
        global $woocommerce, $product;
        // let's setup our divs
        echo sprintf('<div id="product_total_price" style="margin-bottom:20px;display:none">%s %s</div>', __('Product Total:', 'woocommerce'), '<span class="price">' . $product->get_price() . '</span>');
        echo sprintf('<div id="cart_total_price" style="margin-bottom:20px;display:none">%s %s</div>', __('Cart Total:', 'woocommerce'), '<span class="price">' . $product->get_price() . '</span>');
        ?>
            <script>
                jQuery(function($){
                    var price = <?php echo $product->get_price(); ?>,
                        current_cart_total = <?php echo $woocommerce->cart->cart_contents_total; ?>,
                        currency = '<?php echo get_woocommerce_currency_symbol(); ?>';

                    $('[name=quantity]').change(function(){
                        if (!(this.value < 0)) {
                            var product_total = parseFloat(price * this.value),
                            cart_total = parseFloat(product_total + current_cart_total);

                            $('#product_total_price .price').html( currency + product_total.toFixed(2));
                            $('#cart_total_price .price').html( currency + cart_total.toFixed(2));
                        }
                        $('#product_total_price,#cart_total_price').toggle(!(this.value < 0));

                    });
                });
            </script>
        <?php
    }
}
$price = UpdatePrice::instance();

?>
