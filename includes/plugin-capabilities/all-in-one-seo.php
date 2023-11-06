<?php
/**
 * All in One SEO Capabilities class.
 *
 * Generated by Capabilities Extractor
 */
class publishpress_capabilities_all_in_one_seo
{
    private static $instance = null;

    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new publishpress_capabilities_all_in_one_seo();
        }

        return self::$instance;
    }

    public function __construct()
    {
        //All in One SEO Capabilities
        add_filter('cme_plugin_capabilities', [$this, 'cme_all_in_one_seo_capabilities']);
    }

    /**
     * All in One SEO Capabilities
     *
     * @param array $plugin_caps
     * 
     * @return array
     */
    public function cme_all_in_one_seo_capabilities($plugin_caps)
    {

        if (defined('AIOSEO_PHP_VERSION_DIR')) {
            $plugin_caps['All in One SEO'] = apply_filters(
                'cme_all_in_one_seo_capabilities',
                [
                    'aioseo_manage_seo',
                    'aioseo_page_advanced_settings',
                    'aioseo_page_analysis',
                    'aioseo_page_general_settings',
                    'aioseo_page_schema_settings',
                    'aioseo_page_social_settings'
                ]
            );
        }

        return $plugin_caps;
    }
}
publishpress_capabilities_all_in_one_seo::instance();
?>
