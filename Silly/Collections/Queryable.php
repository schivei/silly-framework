<?php

namespace Silly\Collections;

use \ArrayIterator,
    \Closure,
    \Generator;

/**
 * Description of Queryable
 *
 * @author Elton Schivei Costa
 */
class Queryable extends ArrayIterator
{

    /**
     * @param array/object $array
     * @return \Silly\Collections\Queryable
     */
    public static function from(&$array)
    {
        return new \Silly\Collections\Queryable($array);
    }

    /**
     * @param Closure $callback
     * @return boolean
     */
    public function contains(Closure $callback)
    {
        foreach ($this as $key => &$value)
        {
            if (\call_user_func_array($callback, [&$value, $key]))
            {
                return true;
            }
        }

        return false;
    }

    /**
     * @param Closure $callback
     * @return array
     */
    private function &_where(Closure $callback)
    {
        $where = [];
        foreach ($this as $key => &$value)
        {
            if (\call_user_func_array($callback, [&$value, $key]))
            {
                \array_push($where, $value);
            }
        }

        return $where;
    }

    /**
     * @param Closure $callback
     * @return \Silly\Collections\Queryable
     */
    public function &where(Closure $callback)
    {
        $where = $this->_where($callback);

        $values = \Silly\Collections\Queryable::from($where);

        return $values;
    }

    /**
     * @param Closure $callback
     * @return Generator
     */
    private function &_select(Closure $callback)
    {
        $select = [];
        foreach ($this as $key => &$value)
        {
            $v = \call_user_func_array($callback, [&$value, $key]);
            \array_push($select, $v);
        }

        return $select;
    }

    /**
     * @param Closure $callback
     * @return \Silly\Collections\Queryable
     */
    public function &select(Closure $callback)
    {
        $select = $this->_select($callback);
        $values = new \Silly\Collections\Queryable($select);
        return $values;
    }

    /**
     * @param Closure $callback
     * @return mixed
     */
    public function &firstOrDefault(Closure $callback = null)
    {
        $values = $this;

        if ($callback !== null)
        {
            $where = $this->_where($callback);

            $values = \Silly\Collections\Queryable::from($where);
        }

        $value = $values->offsetGet(0);
        return $value;
    }

}
