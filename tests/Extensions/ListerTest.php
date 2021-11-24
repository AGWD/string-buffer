<?php

namespace AdrianGreen\String\Test\Extensions;

use AdrianGreen\String\StringBuffer;
use AdrianGreen\String\Test\TestCase;

class ListerTest extends TestCase
{
    public function testSplit()
    {
        $this->assertSame(['this', 'is', 'a', 'test'], StringBuffer::create('this is a test')->split(' '));
        $this->assertSame(['this', 'is', 'a', 'test'], StringBuffer::create('this-is-a-test')->split('-'));
    }

    public function testSplitUppercase()
    {
        $this->assertSame(['Foo', 'Bar'], StringBuffer::create('FooBar')->splitUppercase(false));
        $this->assertSame(['foo', 'bar'], StringBuffer::create('FooBar')->splitUppercase(true));
    }
}
