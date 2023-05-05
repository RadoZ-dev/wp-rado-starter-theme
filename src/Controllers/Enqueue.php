<?php 

namespace RadoTheme\Controllers;

use RadoTheme\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

class Enqueue 
{  
    use Singleton;

    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'themeEnqueueStyles']);
        add_action('admin_enqueue_scripts', [$this, 'adminEnqueueStyles']);
    }

    public function themeEnqueueStyles()
    {
        $theTheme = wp_get_theme();

        $themeVersion = $theTheme->get( 'Version' );

        $cssVersionChild = $themeVersion . '.' . filemtime( get_stylesheet_directory() . '/assets/public/dist/css/theme.min.css');
        $jsVersionChild = $themeVersion . '.' . filemtime( get_stylesheet_directory() . '/assets/public/dist/js/theme.min.js');

        wp_enqueue_style('rado-theme-styles', get_stylesheet_directory_uri() . '/assets/public/dist/css/theme.min.css', array(), $cssVersionChild);
        wp_enqueue_script('rado-theme-scripts', get_stylesheet_directory_uri() . '/assets/public/dist/js/theme.min.js', array(), $jsVersionChild, true);
    }

    public function adminEnqueueStyles()
    {
        wp_enqueue_style('rado-admin-styles', get_stylesheet_directory_uri() . '/assets/admin/dist/css/theme-admin.min.css', array(), '');
    }
}
