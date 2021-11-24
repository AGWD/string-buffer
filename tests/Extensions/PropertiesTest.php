<?php

namespace AdrianGreen\String\Test\Extensions;

use AdrianGreen\String\StringBuffer;
use AdrianGreen\String\Test\TestCase;

class PropertiesTest extends TestCase
{

    public function testLength()
    {
        $this->assertSame(4, StringBuffer::create('test')->length());
        $this->assertSame(7, StringBuffer::create('ÄÖÜäöüß')->length());
    }
}
