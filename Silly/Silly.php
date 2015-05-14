<?php

namespace Silly;

use \InvalidArgumentException,
    \ReflectionObject;

/**
 * @param mixed $checks
 * @return string
 */
function typeof($checks)
{
    if (\is_null($checks))
    {
        return 'NULL';
    }

    if (\gettype($checks) === 'object')
    {
        $ref = new ReflectionObject($checks);
        return $ref->getName();
    }

    return \gettype($checks);
}

/**
 * @param string $type
 * @throws InvalidArgumentException
 * @return bool if is primitive
 */
function validateType($type)
{
    if (!\class_exists($type) && !\interface_exists($type))
    {
        switch ($type)
        {
            case 'string':
            case 'float':
            case 'double':
            case 'integer':
            case 'int':
            case 'bool':
            case 'boolean':
                break;
            default:
                throw new InvalidArgumentException("Type argument not found.");
        }

        return true;
    }

    return false;
}

/**
 * 
 * @param string $type
 * @param type $value
 * @return void
 * @throws InvalidArgumentException
 */
function validateValueByType(&$type, &$value, $setDefaultPrimitive = true)
{
    $primitive = \Silly\validateType($type);

    if (\is_null($value) && $primitive && $setDefaultPrimitive)
    {
        switch ($type)
        {
            case 'string':
                $value = '';
                break;
            case 'float':
                $value = 0.0;
                break;
            case 'integer':
                $value = 0;
                break;
            case 'boolean':
                $value = false;
                break;
        }
    }
    else if (\is_null($value))
    {
        return;
    }

    if ($primitive)
    {
        $ok = true;
        switch ($type)
        {
            case 'string':
                $ok = \is_string($value);
                break;
            case 'double':
            case 'float':
                $ok = \is_float($value);
                break;
            case 'int':
            case 'integer':
                $ok = \is_integer($value);
                break;
            case 'bool':
            case 'boolean':
                $ok = \is_bool($value);
                break;
        }

        if (!$ok)
        {
            $t = \Silly\typeof($value);
            throw new InvalidArgumentException("The value type is invalid. Expected {$type} instead of {$t}");
        }
    }
    else if (!$value instanceof $type)
    {
        $t = \Silly\typeof($value);
        throw new InvalidArgumentException("The value type is invalid. Expected {$type} instead of {$t}");
    }
}

class Silly
{

    /**
     * Silly autoloader
     */
    public static function autoload($objName)
    {
        $selfcls = \str_replace(__NAMESPACE__ . '\\', '', self::class);

        $selfdir = __DIR__;

        if (\substr($selfdir, -\strlen($selfcls)) === $selfcls)
        {
            $selfdir = \substr($selfdir, 0, -strlen($selfcls));
        }

        $objName = \ltrim($objName, '\\');

        $file = $selfdir;

        $namespace = '';

        if (($prevNS = \strripos($objName, '\\')))
        {
            $namespace = \substr($objName, 0, $prevNS);
            $objName   = \substr($objName, $prevNS + 1);
            $file .= \str_replace('\\', \DIRECTORY_SEPARATOR, $namespace) . \DIRECTORY_SEPARATOR;
        }

        $file .= \str_replace('_', \DIRECTORY_SEPARATOR, $objName) . '.php';

        if (\file_exists($file))
        {
            require $file;
        }
    }

    /**
     * Register Silly autoloader
     */
    public static function registerAutoloader()
    {
        \spl_autoload_register(self::class . "::autoload");
    }

}
