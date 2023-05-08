<?php 

namespace RadoTheme\ThemeSettings;

use RadoTheme\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

class Customizer 
{  
    use Singleton;

    public function __construct()
    {
        add_action( 'customize_register', [$this, 'rado_customize_register'] );
        add_action( 'customize_preview_init', [$this, 'rado_customize_preview_js'] );
    }

    public function rado_customize_register( $wp_customize ) {
        $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
        $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
        $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    
        if ( isset( $wp_customize->selective_refresh ) ) {
            $wp_customize->selective_refresh->add_partial(
                'blogname',
                array(
                    'selector'        => '.site-title a',
                    'render_callback' => 'rado_customize_partial_blogname',
                )
            );
            $wp_customize->selective_refresh->add_partial(
                'blogdescription',
                array(
                    'selector'        => '.site-description',
                    'render_callback' => 'rado_customize_partial_blogdescription',
                )
            );
        }
    }

    public function rado_customize_preview_js() {
        wp_enqueue_script( 'rado-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), _S_VERSION, true );
    }
}

