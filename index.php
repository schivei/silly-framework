<?php

include_once './silly/libraries/cli/Colors.php';
include_once './silly/libraries/cli/Console.php';

use \silly\libraries\cli;

cli\Console::ColorWriteLine("Teste", cli\Colors::FG_GREEN);
