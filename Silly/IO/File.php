<?php

namespace Silly\IO;

/**
 * Description of File
 *
 * @author Elton Schivei Costa
 */
class File
{
    public static function Exists($filename)
    {
        if (!\is_string($filename))
        {
            throw new ArgumentException('$filename', $filename, "");
        }
    }
}
