<?php declare(strict_types=1);

namespace AdrianGreen\String\Extensions;

use AdrianGreen\String\StringBuffer;

class Transformer extends AbstractExtension
{
    /**
     * @return StringBuffer
     */
    public function toLower(): StringBuffer
    {
        return $this->string->setString(\strtolower($this->string->toString()));
    }

    /**
     * @return StringBuffer
     */
    public function toUpper(): StringBuffer
    {
        return $this->string->setString(\strtoupper($this->string->toString()));
    }

    /**
     * @return float
     */
    public function toFloat(): float
    {
        return (float)$this->string->toString();
    }

    /**
     * @return int
     */
    public function toInteger(): int
    {
        return (int)$this->string->toString();
    }
}
