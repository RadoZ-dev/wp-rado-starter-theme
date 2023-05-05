<?php 

namespace RadoTheme\ACF;

use RadoTheme\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

class ACFSettings
{  
    use Singleton;

    public function __construct()
    {
        add_filter('acf/format_value/type=textarea', [$this, 'do_shortcode']);
        add_action('acf/init', [$this, 'addOptions']);
    }

    public function addOptions() 
    {
        if( function_exists('acf_add_options_page') ) 
        {
            acf_add_options_page(array(
                'page_title' 	=> __( 'Theme Settings', 'rado-theme' ),
                'menu_title'	=> __( 'Theme Settings', 'rado-theme' ),
                'menu_slug' 	=> 'theme-settings', 
                'icon_url'      => get_stylesheet_directory_uri() . '/assets/admin/dist/img/icon-theme-options.png'
            ));
        }
    }
}