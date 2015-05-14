<?php

namespace Silly\Web\HTML\Forms;

use \Silly\Web\HTML\Forms\InputType,
    \Silly\Web\HTML\Forms\Label,
    \Silly\Web\HTML\SimpleElement,
    \SplString;

/**
 * Description of Input
 *
 * @author Elton Schivei Costa
 */
class Input extends SimpleElement
{

    /**
     * @var Label
     */
    private $label;

    /**
     * @param InputType $type
     * @param Label $label optional label for input
     */
    public function __construct(InputType $type, Label $label = null)
    {
        parent::__construct(new SplString($type));
        $this->label = $label;
    }
}
