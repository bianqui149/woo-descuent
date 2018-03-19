<?php

/**
 * @author Bianqui Julián
 */
class AdminWoo
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
        add_action('admin_menu', array($this, 'my_admin_menu'));

    }



    public function my_admin_menu()
    {
        add_menu_page('Woo Descuent', 'WooCommerce Descuent', 'manage_options', 'myplugin/myplugin-admin-page.php', array($this,'myplguin_admin_page'), 'dashicons-tickets', 50);
     }
      
    public function myplguin_admin_page(){
		?>
		<h1>My Awesome Settings Page</h1>

		<form method="POST">
			<table>
				<tr>
					<td><h2>Woocommerce field Descuent:</h2></td>
					<td><a>Active</a> <input type="radio" name="woodescuent" value="1" checked></td>
					<td><a>Disable</a> <input type="radio" name="woodescuent" value="2" ></td>
				</tr>
				<tr>
					<td><h2>Free Total Calculator in Page:</h2></td>
					<td><a>Active</a> <input type="radio" name="freetotal" value="1" checked></td>
					<td><a>Disable</a> <input type="radio" name="freetotal" value="2" ></td>
				</tr>

			</table>
	    
		    <input type="submit" value="Save" class="button button-primary button-large">
		</form>
		<?php
	}
 


}
$admin = AdminWoo::instance();

?>