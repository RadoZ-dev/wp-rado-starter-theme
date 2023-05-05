<?php 
namespace RadoTheme;

use RadoTheme\Controllers\Enqueue;
use RadoTheme\ACF\ACFRegisterBlocks;
use RadoTheme\ACF\ACFSettings;
use RadoTheme\ThemeSettings\Customizer;
use RadoTheme\ThemeSettings\ThemeSetup;

class ThemeInit 
{
    function __construct()
    {
        ThemeSetup::getInstance();
        Enqueue::getInstance();
        ACFRegisterBlocks::getInstance();
        ACFSettings::getInstance();
        Customizer::getInstance();
    }

}