<?php

namespace AdrianGreen\String\Test\Extensions;

use AdrianGreen\String\Extensions\Conditions;
use AdrianGreen\String\StringBuffer;
use AdrianGreen\String\Test\TestCase;

class HashesTest extends TestCase
{
    public function testMd5()
    {
        $this->assertSame(md5('test'), StringBuffer::create('test')->md5()->toString());
    }

    public function testSha1()
    {
        $this->assertSame(sha1('test'), StringBuffer::create('test')->sha1()->toString());
    }
}
