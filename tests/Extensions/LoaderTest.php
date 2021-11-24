<?php 

namespace AdrianGreen\String\Test\Extensions;

use AdrianGreen\String\Exceptions\UnknownExtensionException;
use AdrianGreen\String\Extensions\Loader;
use AdrianGreen\String\StringBuffer;
use AdrianGreen\String\Test\TestCase;

class LoaderTest extends TestCase
{
    public function testThatFactoryThrowsUnknownExtensionException()
    {
        $this->expectException(UnknownExtensionException::class);
        $this->expectExceptionMessage('foobar');

        $loader = new Loader(new StringBuffer('test'));
        $loader->factory('foobar');
    }
}
