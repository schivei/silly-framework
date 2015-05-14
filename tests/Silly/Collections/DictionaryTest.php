<?php

namespace Silly\Collections;

use \ArrayIterator,
    \InvalidArgumentException,
    \PHPUnit_Framework_TestCase,
    \stdClass,
    \UnexpectedValueException;
use function \Silly\validateType;

/**
 * Description of DictionaryTest
 *
 * @author Elton Schivei Costa
 */
class DictionaryTest extends PHPUnit_Framework_TestCase
{

    protected $typeTE;
    protected $typeT;
    protected $data;

    protected function setUp()
    {
        $this->typeT  = 'string';
        $this->typeTE = 'integer';

        validateType($this->typeT);
        validateType($this->typeTE);

        $this->data                = new stdClass();
        $this->data->keys          = ['a', 'b', 'c'];
        $this->data->values        = [1, 2, 3];
        $this->data->wrongKeys     = new stdClass();
        $this->data->wrongKeys->k1 = [1, 2, 3];
        $this->data->wrongKeys->k2 = ['a', 'b'];
    }

    /**
     * @return \Silly\Collections\Dictionary
     */
    private function getDict()
    {
        return new \Silly\Collections\Dictionary($this->typeT, $this->typeTE);
    }

    /**
     * @covers \Silly\Collections\Dictionary::__construct
     * @covers \Silly\Collections\Dictionary::offsetSet
     * @covers \Silly\Collections\Dictionary::offsetGet
     * @covers \Silly\Collections\Dictionary::count
     * @covers \Silly\Collections\Dictionary::add
     * @covers \Silly\Collections\Dictionary::addRange
     * @covers \Silly\Collections\Dictionary::clear
     * @covers \Silly\Collections\Dictionary::keyExists
     * @covers \Silly\Collections\KeyValuePair::__construct
     * @covers \Silly\Collections\KeyValuePair::getKey
     * @covers \Silly\Collections\KeyValuePair::setValue
     * @covers \Silly\Collections\Queryable::from
     * @covers \Silly\Collections\Queryable::firstOrDefault
     * @use    \Silly\validateType
     */
    public function testCount()
    {
        $dict = $this->getDict();
        $this->assertEquals(0, $dict->count(), "Assert count 0 items.");

        $dict->addRange($this->data->keys, $this->data->values);
        $this->assertEquals(3, $dict->count(), "Assert count 3 items.");

        $dict->addRange([], []);
        $this->assertEquals(3, $dict->count(), "Assert count 3 items.");

        $dict->addRange($this->data->keys, $this->data->values);
        $this->assertEquals(3, $dict->count(), "Assert count 3 items.");

        $dict->clear();
    }

    /**
     * @covers \Silly\Collections\Dictionary::__construct
     * @covers \Silly\Collections\Dictionary::offsetGet
     * @covers \Silly\Collections\Dictionary::count
     * @covers \Silly\Collections\Dictionary::clear
     * @covers \Silly\Collections\Dictionary::getIterator
     */
    public function testGetIterator()
    {
        $dict = $this->getDict();
        $it   = $dict->getIterator();
        $this->assertEquals(0, count($it), "Assert get Iterator");
        $this->assertInstanceOf(ArrayIterator::class, $it, "Assert Iterator instance");
        $dict->clear();
    }

    /**
     * @covers \Silly\Collections\Dictionary::serialize
     */
    public function testSerialize()
    {
        $dict = $this->getDict();
        $k    = 'test';
        $v    = 1;
        $dict->add($k, $v);
        $s    = \file_get_contents(__DIR__ . '/serial.txt');
        $this->assertEquals($s, serialize($dict), "Assert serialization.");
    }

    /**
     * @covers \Silly\Collections\Dictionary::unserialize
     */
    public function testUnserialize()
    {
        $s = \file_get_contents(__DIR__ . '/serial.txt');
        $this->assertInstanceOf(\Silly\Collections\Dictionary::class, \unserialize($s), "Assert serialization.");
    }

    /**
     * @covers \Silly\Collections\Dictionary::__construct
     * @covers \Silly\Collections\Dictionary::offsetGet
     * @covers \Silly\Collections\Dictionary::offsetSet
     * @covers \Silly\Collections\Dictionary::add
     * @covers \Silly\Collections\Dictionary::addRange
     * @covers \Silly\Collections\Dictionary::clear
     * @covers \Silly\Collections\Dictionary::keyExists
     * @covers \Silly\Collections\KeyValuePair::__construct
     * @covers \Silly\Collections\KeyValuePair::getKey
     * @covers \Silly\Collections\KeyValuePair::setValue
     * @covers \Silly\Collections\Queryable::from
     * @covers \Silly\Collections\Queryable::firstOrDefault
     * @use    \Silly\validateType
     */
    public function testAddRange()
    {
        $dict = $this->getDict();
        $this->setExpectedException(InvalidArgumentException::class, "The value type is invalid. Expected string instead of integer", 0);
        $dict->addRange($this->data->wrongKeys->k1, $this->data->values);

        $dict->clear();
    }

    /**
     * @covers \Silly\Collections\Dictionary::__construct
     * @covers \Silly\Collections\Dictionary::offsetGet
     * @covers \Silly\Collections\Dictionary::offsetSet
     * @covers \Silly\Collections\Dictionary::add
     * @covers \Silly\Collections\Dictionary::addRange
     * @covers \Silly\Collections\Dictionary::clear
     * @covers \Silly\Collections\Dictionary::keyExists
     * @covers \Silly\Collections\KeyValuePair::__construct
     * @covers \Silly\Collections\KeyValuePair::getKey
     * @covers \Silly\Collections\KeyValuePair::setValue
     * @covers \Silly\Collections\Queryable::from
     * @covers \Silly\Collections\Queryable::firstOrDefault
     * @use    \Silly\validateType
     */
    public function testAddRange2()
    {
        $dict = $this->getDict();
        $this->setExpectedException(UnexpectedValueException::class, "Keys don't matches Values.", 0);
        $dict->addRange($this->data->wrongKeys->k2, $this->data->values);
        $dict->clear();
    }

    /**
     * @covers \Silly\Collections\Dictionary::__construct
     * @covers \Silly\Collections\Dictionary::offsetGet
     * @covers \Silly\Collections\Dictionary::add
     * @covers \Silly\Collections\Dictionary::addRange
     * @covers \Silly\Collections\Dictionary::clear
     * @covers \Silly\Collections\Dictionary::keyExists
     * @covers \Silly\Collections\Dictionary::getOffset
     * @covers \Silly\Collections\Dictionary::offsetUnset
     * @covers \Silly\Collections\Dictionary::offsetExists
     * @covers \Silly\Collections\Dictionary::offsetSet
     * @covers \Silly\Collections\Dictionary::remove
     * @covers \Silly\Collections\KeyValuePair::__construct
     * @covers \Silly\Collections\KeyValuePair::getKey
     * @covers \Silly\Collections\KeyValuePair::setValue
     * @covers \Silly\Collections\Queryable::from
     * @covers \Silly\Collections\Queryable::firstOrDefault
     * @covers \Silly\Collections\Queryable::select
     * @covers \Silly\Collections\Queryable::where
     * @use    \Silly\validateType
     */
    public function testRemove()
    {
        $dict = $this->getDict();
        $dict->addRange($this->data->keys, $this->data->values);
        $dict->remove($this->data->keys[0]);
        $this->assertEquals(2, $dict->count(), "Assert remove by key");
        $dict->clear();
    }

    public function testGetOffset()
    {
        $dict = $this->getDict();
        $this->assertNull($dict->getOffset(0), "Assert not exists key");
        $dict->clear();
    }

}
