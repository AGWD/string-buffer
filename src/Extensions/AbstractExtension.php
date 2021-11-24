<?php declare(strict_types=1);

namespace AdrianGreen\String\Extensions;

use AdrianGreen\String\StringBuffer;

abstract class AbstractExtension
{
    /**
     * @var StringBuffer
     */
    protected StringBuffer $string;

    /**
     * @param StringBuffer $string
     */
    public function __construct(StringBuffer $string)
    {
        $this->string = $string;
    }

}
