<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace silly\libraries\cli;

use \BadMethodCallException;

const EOL = "\n";

/**
 * Description of Console
 *
 * @author Elton Schivei Costa <costa@schivei.nom.br>
 */
final class Console
{

    private function __construct()
    {
        
    }

    public static function IsCLI()
    {
        $argc = filter_input(INPUT_SERVER, 'argc');

        return (php_sapi_name() == 'cli' || (is_numeric($argc) && $argc > 0) ||
                defined('STDIN') || !filter_input(INPUT_SERVER, 'REQUEST_METHOD'));
    }

    /**
     * @return void
     * @throws BadMethodCallException
     */
    private static function ValidateCLI()
    {
        if (!static::IsCLI())
        {
            throw new BadMethodCallException("The Console Library only run under CLI.");
        }
    }

    public static function Write($message, ...$composes)
    {
        $composes = $composes? : [];

        static::ColorWrite($message, null, ...$composes);
    }

    public static function WriteLine($message, ...$composes)
    {
        $composes = $composes? : [];

        static::ColorWrite($message, null, ...$composes);

        echo \silly\libraries\cli\EOL;
    }

    public static function ColorWrite($message, $color = null, ...$composes)
    {
        static::ValidateCLI();

        $composes = $composes? : [];

        if (count($composes) > 0)
        {
            foreach ($composes as $key => $part)
            {
                $message = str_replace("{{$key}}", $part, $message);
            }
        }

        echo \silly\libraries\cli\Colors::getColoredString($message, $color);
    }

    public static function ColorWriteLine($message, ...$composes)
    {
        $composes = $composes? : [];

        static::ColorWrite($message, ...$composes);

        echo \silly\libraries\cli\EOL;
    }

}
