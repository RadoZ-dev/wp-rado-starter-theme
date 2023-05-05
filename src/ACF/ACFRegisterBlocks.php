<?php 

namespace RadoTheme\ACF;

use RadoTheme\Traits\Singleton;

if ( ! defined( 'ABSPATH' ) ) exit;

class ACFRegisterBlocks 
{  
    use Singleton;

    public function __construct()
    {
        add_action('acf/init', [$this, 'registerBlocks']);
    }

    public function registerBlocks()
    {
        // Check function exists.
        if( function_exists('acf_register_block_type') ) {

        }
    }
}