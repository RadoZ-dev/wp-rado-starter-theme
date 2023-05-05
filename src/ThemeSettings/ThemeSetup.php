<?php 

namespace RadoTheme\ThemeSettings;

use RadoTheme\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

class ThemeSetup
{  
    use Singleton;

    public function __construct()
    {
        add_action( 'after_setup_theme', [$this, '_s_setup'] );
        add_action( 'after_setup_theme', [$this, '_s_content_width'] );
        add_filter( 'body_class', [$this, '_s_body_classes'] );
        add_action( 'wp_head', [$this, '_s_pingback_header'] );
    }

    function _s_setup() {
        load_theme_textdomain( '_s', get_template_directory() . '/languages' );
        add_theme_support( 'automatic-feed-links' );
        add_theme_support( 'title-tag' );
        add_theme_support( 'post-thumbnails' );
    
        register_nav_menus(
            array(
                'menu-1' => esc_html__( 'Primary', '_s' ),
            )
        );
    
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );
    
        add_theme_support(
            'custom-background',
            apply_filters(
                '_s_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );
    
        add_theme_support( 'customize-selective-refresh-widgets' );
    
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
    }

    public function _s_content_width() {
        $GLOBALS['content_width'] = apply_filters( '_s_content_width', 640 );
    }

    public function _s_body_classes( $classes ) {
        // Adds a class of hfeed to non-singular pages.
        if ( ! is_singular() ) {
            $classes[] = 'hfeed';
        }
    
        // Adds a class of no-sidebar when there is no sidebar present.
        if ( ! is_active_sidebar( 'sidebar-1' ) ) {
            $classes[] = 'no-sidebar';
        }
    
        return $classes;
    }
    
    public function _s_pingback_header() {
        if ( is_singular() && pings_open() ) {
            printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
        }
    }
}