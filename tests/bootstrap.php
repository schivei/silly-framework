<?php

/**
 * @author Elton Schivei Costa
 * @codeCoverageIgnore
 */
\error_reporting(\E_ALL | ~\E_NOTICE);

/**
 * @codeCoverageIgnore
 */
\ini_set('display_errors', true);

/**
 * @codeCoverageIgnore
 */
\ini_set('include_path', \ini_get('include_path') . \PATH_SEPARATOR . \dirname(__DIR__)
        . \PATH_SEPARATOR . '/usr/share/php/PHPUnit');

/**
 * @codeCoverageIgnore
 */
define('APPPATH', __DIR__);

/**
 * @codeCoverageIgnore
 */
require 'vendor/autoload.php';
