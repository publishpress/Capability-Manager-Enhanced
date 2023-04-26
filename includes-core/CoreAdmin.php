<?php
namespace PublishPress\Capabilities;

class CoreAdmin {
    function __construct() {
        add_action('admin_print_scripts', [$this, 'setUpgradeMenuLink'], 50);

        if (is_admin()) {
            $autoloadPath = PUBLISHPRESS_CAPS_ABSPATH . '/vendor/autoload.php';
			if (file_exists($autoloadPath)) {
				require_once $autoloadPath;
			}

            require_once PUBLISHPRESS_CAPS_ABSPATH . '/vendor/publishpress/wordpress-version-notices/includes.php';
    
            add_filter(\PPVersionNotices\Module\TopNotice\Module::SETTINGS_FILTER, function ($settings) {
                $settings['capabilities'] = [
                    'message' => 'You\'re using PublishPress Capabilities Free. The Pro version has more features and support. %sUpgrade to Pro%s',
                    'link'    => 'https://publishpress.com/links/capabilities-banner',
                    'screens' => [
                        ['base' => 'toplevel_page_pp-capabilities-dashboard'],
                        ['base' => 'capabilities_page_pp-capabilities'],
                        ['base' => 'capabilities_page_pp-capabilities-roles'],
                        ['base' => 'capabilities_page_pp-capabilities-editor-features'],
                        ['base' => 'capabilities_page_pp-capabilities-admin-features'],
                        ['base' => 'capabilities_page_pp-capabilities-profile-features'],
                        ['base' => 'capabilities_page_pp-capabilities-nav-menus'],
                        ['base' => 'capabilities_page_pp-capabilities-backup'],
                        ['base' => 'capabilities_page_pp-capabilities-settings'],
                    ]
                ];
    
                return $settings;
            });
        }

        add_filter('pp_capabilities_sub_menu_lists', [$this, 'actCapabilitiesSubmenus'], 10, 2);

        //Editor feature metaboxes promo
        add_action('pp_capabilities_features_gutenberg_after_table_tr', [$this, 'metaboxesPromo']);
        add_action('pp_capabilities_features_classic_after_table_tr', [$this, 'metaboxesPromo']);

        //Admin features promo
        add_action('pp_capabilities_admin_features_after_table_tr', [$this, 'customItemsPromo']);
    }

    function setUpgradeMenuLink() {
        $url = 'https://publishpress.com/links/capabilities-menu';
        ?>
        <style type="text/css">
        #toplevel_page_pp-capabilities-dashboard ul li:last-of-type a {font-weight: bold !important; color: #FEB123 !important;}
        </style>

		<script type="text/javascript">
            jQuery(document).ready(function($) {
                $('#toplevel_page_pp-capabilities-dashboard ul li:last a').attr('href', '<?php echo esc_url_raw($url);?>').attr('target', '_blank').css('font-weight', 'bold').css('color', '#FEB123');
            });
        </script>
		<?php
    }

    function actCapabilitiesSubmenus($sub_menu_pages, $cme_fakefunc) {
        if (!$cme_fakefunc) {
            //add admin menu after profile features menu
            $profile_features_offset = array_search('profile-features', array_keys($sub_menu_pages));
            $profile_features_menu   = [];
            $profile_features_menu['admin-menus'] = [
                'title'             => __('Admin Menus', 'capsman-enhanced'),
                'capabilities'      => (is_multisite() && is_super_admin()) ? 'read' : 'manage_capabilities',
                'page'              => 'pp-capabilities-admin-menus',
                'callback'          => [$this, 'AdminMenusPromo'],
                'dashboard_control' => true,
            ];

            $sub_menu_pages = array_merge(
                array_slice($sub_menu_pages, 0, $profile_features_offset),
                $profile_features_menu,
                array_slice($sub_menu_pages, $profile_features_offset, null)
            );
        }

        return $sub_menu_pages;
    }

    function AdminMenusPromo() {
        wp_enqueue_style('pp-capabilities-admin-core', plugin_dir_url(CME_FILE) . 'includes-core/admin-core.css', [], PUBLISHPRESS_CAPS_VERSION, 'all');
        include (dirname(__FILE__) . '/admin-menus-promo.php');
    }

    function metaboxesPromo(){
        wp_enqueue_style('pp-capabilities-admin-core', plugin_dir_url(CME_FILE) . 'includes-core/admin-core.css', [], PUBLISHPRESS_CAPS_VERSION, 'all');
        include (dirname(__FILE__) . '/editor-features-promo.php');
    }

    function customItemsPromo(){
        wp_enqueue_style('pp-capabilities-admin-core', plugin_dir_url(CME_FILE) . 'includes-core/admin-core.css', [], PUBLISHPRESS_CAPS_VERSION, 'all');
        include (dirname(__FILE__) . '/admin-features-promo.php');
    }
}