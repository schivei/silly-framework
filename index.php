<?php

include_once './silly/libraries/cli/Colors.php';

use \silly\libraries\cli\Colors as Color;

echo Color::getColoredString("Teste", Color::FG_CYAN) . "\n" . PHP_OS . "\n";
