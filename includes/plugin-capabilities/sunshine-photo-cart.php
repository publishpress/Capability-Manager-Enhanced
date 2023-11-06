<?php
/**
 * Sunshine Photo Cart Capabilities class.
 *
 * Generated by Capabilities Extractor
 */
class publishpress_capabilities_sunshine_photo_cart
{
    private static $instance = null;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new publishpress_capabilities_sunshine_photo_cart();
        }

        return self::$instance;
    }

    public function __construct()
    {
        //Sunshine Photo Cart Capabilities
        add_filter('cme_plugin_capabilities', [$this, 'cme_sunshine_photo_cart_capabilities']);
    }

    /**
     * Sunshine Photo Cart Capabilities
     *
     * @param array $plugin_caps
     * 
     * @return array
     */
    public function cme_sunshine_photo_cart_capabilities($plugin_caps)
    {

        if (defined('SUNSHINE_PHOTO_CART_PATH')) {
            $plugin_caps['Sunshine Photo Cart'] = apply_filters(
                'cme_sunshine_photo_cart_capabilities',
                [
                    'delete_others_sunshine_galleries',
                    'delete_others_sunshine_orders',
                    'delete_others_sunshine_products',
                    'delete_private_sunshine_galleries',
                    'delete_private_sunshine_orders',
                    'delete_private_sunshine_products',
                    'delete_published_sunshine_galleries',
                    'delete_published_sunshine_orders',
                    'delete_published_sunshine_products',
                    'delete_sunshine_galleries',
                    'delete_sunshine_gallery',
                    'delete_sunshine_order',
                    'delete_sunshine_orders',
                    'delete_sunshine_product',
                    'delete_sunshine_products',
                    'edit_others_sunshine_galleries',
                    'edit_others_sunshine_orders',
                    'edit_others_sunshine_products',
                    'edit_private_sunshine_galleries',
                    'edit_private_sunshine_orders',
                    'edit_private_sunshine_products',
                    'edit_published_sunshine_galleries',
                    'edit_published_sunshine_orders',
                    'edit_published_sunshine_products',
                    'edit_sunshine_galleries',
                    'edit_sunshine_gallery',
                    'edit_sunshine_order',
                    'edit_sunshine_orders',
                    'edit_sunshine_product',
                    'edit_sunshine_products',
                    'publish_sunshine_galleries',
                    'publish_sunshine_gallery',
                    'publish_sunshine_product',
                    'publish_sunshine_products',
                    'read_private_sunshine_galleries',
                    'read_private_sunshine_orders',
                    'read_private_sunshine_products',
                    'read_sunshine_gallery',
                    'read_sunshine_order',
                    'read_sunshine_product',
                    'sunshine_manage_options'
                ]
            );
        }

        return $plugin_caps;
    }
}
publishpress_capabilities_sunshine_photo_cart::instance();
?>
