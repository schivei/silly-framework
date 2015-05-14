<?php

namespace silly\libraries\cli;

final class Colors
{

    const FG_BLACK        = 'black';
    const FG_DARK_GRAY    = 'dark_gray';
    const FG_BLUE         = 'blue';
    const FG_LIGHT_BLUE   = 'light_blue';
    const FG_GREEN        = 'green';
    const FG_LIGHT_GREEN  = 'light_green';
    const FG_CYAN         = 'cyan';
    const FG_LIGHT_CYAN   = 'light_cyan';
    const FG_RED          = 'red';
    const FG_LIGHT_RED    = 'light_red';
    const FG_PURPLE       = 'purple';
    const FG_LIGHT_PURPLE = 'light_purple';
    const FG_BROWN        = 'brown';
    const FG_YELLOW       = 'yellow';
    const FG_LIGHT_GRAY   = 'light_gray';
    const FG_WHITE        = 'white';
    const BG_BLACK        = "black";
    const BG_RED          = "red";
    const BG_GREEN        = "green";
    const BG_YELLOW       = "yellow";
    const BG_BLUE         = "blue";
    const BG_MAGENTA      = "magenta";
    const BG_CYAN         = "cyan";
    const BG_LIGHT_GRAY   = "light_gray";

    private static $foreground_colors = ['black'        => '0;30',
        'dark_gray'    => '1;30m',
        'blue'         => '0;34m',
        'light_blue'   => '1;34m',
        'green'        => '0;32m',
        'light_green'  => '1;32m',
        'cyan'         => '0;36m',
        'light_cyan'   => '1;36m',
        'red'          => '0;31m',
        'light_red'    => '1;31m',
        'purple'       => '0;35m',
        'light_purple' => '1;35m',
        'brown'        => '0;33m',
        'yellow'       => '1;33m',
        'light_gray'   => '0;37m',
        'white'        => '1;37m'];
    private static $background_colors = ['black'      => '40',
        'red'        => '41m',
        'green'      => '42m',
        'yellow'     => '43m',
        'blue'       => '44m',
        'magenta'    => '45m',
        'cyan'       => '46m',
        'light_gray' => '47m'];

    private function __construct()
    {
        
    }

    // Returns colored string
    public static function getColoredString($string, $foreground_color = null,
                                            $background_color = null)
    {
        $colored_string = "";
        
        // Check if given background color found
        if (isset(self::$background_colors[$background_color]))
        {
            $colored_string .= "\e[" . self::$background_colors[$background_color];
        }
        // Check if given foreground color found
        if (isset(self::$foreground_colors[$foreground_color]))
        {
            $colored_string .= "\e[" . self::$foreground_colors[$foreground_color];
        }

        // Add string and end coloring
        $colored_string .= $string . "\e[0m";

        return $colored_string;
    }

    // Returns all foreground color names
    public static function getForegroundColors()
    {
        return array_keys(self::$foreground_colors);
    }

    // Returns all background color names
    public static function getBackgroundColors()
    {
        return array_keys(self::$background_colors);
    }

    public static function __callStatic($name, $arguments)
    {
        if (preg_match('/^(bg_)/', $name))
        {
            if (array_key_exists($name, self::$background_colors))
            {
                return self::getColoredString($arguments[0], null, $name);
            }
        }

        $fore = preg_replace('/^(fg_)/', '', $name);
        
        return self::getColoredString($arguments[0], $fore, null);
    }

}
