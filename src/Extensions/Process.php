<?php declare(strict_types=1);

namespace AdrianGreen\String\Extensions;

use AdrianGreen\String\StringBuffer;

class Process extends AbstractExtension
{
    /**
     * @param bool          $condition
     * @param callable      $then
     * @param callable|null $else
     *
     * @return StringBuffer
     */
    public function when(bool $condition, callable $then, callable $else = null): StringBuffer
    {
        if ($condition) {
            $then($this->string);
        } else {
            $else($this->string);
        }

        return $this->string;
    }
}
