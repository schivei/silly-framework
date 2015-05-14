<?php

namespace Silly\Web\HTML;

/**
 * Description of SimpleElement
 *
 * @author Elton Schivei Costa
 */
abstract class SimpleElement
{

    /**
     * @var string
     */
    private $elementName;

    protected function __construct(\SplString $elementName)
    {
        $this->elementName = $elementName;
    }

}
