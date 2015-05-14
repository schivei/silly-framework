<?php

namespace Silly\Collections;

use \ArrayAccess,
    \ArrayIterator,
    \Countable,
    \IteratorAggregate,
    \Serializable;
use function \Silly\validateType;

/**
 * Description of Dictionary
 *
 * @author Elton Schivei Costa
 */
class Dictionary implements IteratorAggregate, ArrayAccess, Serializable, Countable
{

    private $typeTE;
    private $typeT;
    private $keyValues = [];

    public function __construct($typeT, $typeTE)
    {
        validateType($typeT, 'T');
        validateType($typeTE, 'TE');

        $this->typeT  = $typeT;
        $this->typeTE = $typeTE;
    }

    public function count()
    {
        return \count($this->keyValues);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->keyValues);
    }

    public function offsetExists($offset)
    {
        if ($offset < 0 || !\is_int($offset))
        {
            return false;
        }

        return \array_key_exists($offset, $this->keyValues);
    }

    public function offsetGet($offset)
    {
        return $this->offsetExists($offset) ? $this->keyValues[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if ($this->offsetExists($offset))
        {
            $this->keyValues[$offset] = $value;
        }
        else
        {
            \array_push($this->keyValues, $value);
        }
    }

    public function offsetUnset($offset)
    {
        if ($this->offsetExists($offset))
        {
            unset($this->keyValues[$offset]);
            $this->keyValues = \array_values($this->keyValues);
        }
    }

    public function serialize()
    {
        return \serialize(['KV' => $this->keyValues, 'T' => $this->typeT, 'TE' => $this->typeTE]);
    }

    public function unserialize($serialized)
    {
        $serial          = \unserialize($serialized);
        $this->keyValues = $serial['KV'];
        $this->typeT     = $serial['T'];
        $this->typeTE    = $serial['TE'];
    }

    public function add(&$key, &$value)
    {
        $offset = -1;
        $vlr    = null;
        if ($this->keyExists($key))
        {
            $offset = $this->getOffset($key);

            $vlr = $this->offsetGet($offset);
            $vlr->setValue($value);
        }
        else
        {
            $vlr = new \Silly\Collections\KeyValuePair($this->typeT, $this->typeTE, $key, $value);
        }

        $this->offsetSet($offset, $vlr);
    }

    public function addRange($keys, $values)
    {
        if (\count($keys) !== \count($values))
        {
            throw new \UnexpectedValueException("Keys don't matches Values.");
        }

        if (\count($keys) === 0)
        {
            return;
        }

        foreach ($values as $k => &$value)
        {
            $this->add($keys[$k], $value);
        }
    }

    public function remove($key)
    {
        if ($this->keyExists($key))
        {
            $offset = $this->getOffset($key);
            $this->offsetUnset($offset);
        }
    }

    public function keyExists($key)
    {
        return \Silly\Collections\Queryable::from($this->keyValues)
                        ->contains(function(\Silly\Collections\KeyValuePair $keyPair) use (&$key)
                        {
                            return $keyPair->getKey() === $key;
                        });
    }

    public function getOffset($key)
    {
        if ($this->keyExists($key))
        {
            return \Silly\Collections\Queryable::from($this->keyValues)
                            ->select(function(\Silly\Collections\KeyValuePair &$keyPair, $pos)
                            {
                                return [$keyPair->getKey(), $pos];
                            })
                            ->where(function(&$ukey) use (&$key)
                            {
                                return $ukey[0] === $key;
                            })
                            ->select(function($ukey)
                            {
                                return $ukey[1];
                            })
                            ->firstOrDefault();
        }
    }

    public function clear()
    {
        $this->keyValues = [];
    }

}
