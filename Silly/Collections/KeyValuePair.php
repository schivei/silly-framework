<?php

namespace Silly\Collections;

use \InvalidArgumentException;
use function \Silly\validateType,
             \Silly\validateValueByType;

/**
 * Key Value Pair class
 *
 * @author Elton Schivei Costa
 */
class KeyValuePair
{

    private $typeT;
    private $typeTE;
    private $key;
    private $value;

    public function __construct($typeT, $typeTE, &$key, &$value)
    {
        validateType($typeT);
        validateType($typeTE);

        $this->typeT  = $typeT;
        $this->typeTE = $typeTE;

        if (\is_null($key))
        {
            throw new InvalidArgumentException("The key argument can't be null.");
        }

        validateValueByType($this->typeT, $key);

        validateValueByType($this->typeTE, $value);

        $this->key   = $key;
        $this->value = $value;
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function setValue(&$value)
    {
        validateValueByType($this->typeTE, $value);
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function &getKey()
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function &getValue()
    {
        return $this->value;
    }

}
