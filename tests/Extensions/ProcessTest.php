<?php

namespace AdrianGreen\String\Test\Extensions;

use AdrianGreen\String\StringBuffer;
use AdrianGreen\String\Test\TestCase;

class ProcessTest extends TestCase
{
    public function testWhenThen()
    {
        $buffer = new StringBuffer('foo');
        $buffer->when(true, function (StringBuffer $buffer) {
            $buffer->append('bar');
        });

        $this->assertSame('foobar', $buffer->toString());
    }

    public function testWhenThenElse()
    {
        $buffer = new StringBuffer('foo');
        $buffer->when(false, function (StringBuffer $buffer) {
            $buffer->append('bar');
        }, function (StringBuffer $buffer) {
            $buffer->append('bas');
        });

        $this->assertSame('foobas', $buffer->toString());
    }
}
