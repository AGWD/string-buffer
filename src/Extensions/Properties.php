<?php declare(strict_types=1);

namespace AdrianGreen\String\Extensions;

class Properties extends AbstractExtension
{
    /**
     * @return int
     */
    public function length(): int
    {
        return \mb_strlen($this->string->toString());
    }
}
