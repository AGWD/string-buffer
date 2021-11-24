<?php declare(strict_types=1);

namespace AdrianGreen\String\Extensions;

use function strlen;
use function strpos;
use function strtolower;
use function substr;

class Conditions extends AbstractExtension
{
    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function contains(string $string, bool $caseSensitive = false): bool
    {
        if ($caseSensitive) {
            return strpos($this->string->toString(), $string) !== false;
        }

        return stripos($this->string->toString(), $string) !== false;
    }

    /**
     * @param array $strings
     * @param bool  $caseSensitive
     *
     * @return bool
     */
    public function containsOneOf(array $strings, bool $caseSensitive = false): bool
    {
        foreach ($strings as $string) {
            if ($this->contains($string, $caseSensitive)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function beginsWith(string $string, bool $caseSensitive = true): bool
    {
        if (!$caseSensitive) {
            return stripos($this->string->toString(), strtolower($string)) === 0;
        }

        return strpos($this->string->toString(), $string) === 0;
    }

    /**
     * @param array $strings
     * @param bool  $caseSensitive
     *
     * @return bool
     */
    public function beginsWithOneOf(array $strings, bool $caseSensitive = true): bool
    {
        foreach ($strings as $string) {
            if ($this->beginsWith($string, $caseSensitive)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function endsWith(string $string, bool $caseSensitive = true): bool
    {
        $length = strlen($string) * -1;
        if (!$caseSensitive) {
            return strtolower(substr($this->string->toString(), $length)) === strtolower($string);
        }

        return substr($this->string->toString(), $length) === $string;
    }

    /**
     * @param array $strings
     * @param bool  $caseSensitive
     *
     * @return bool
     */
    public function endsWithOneOf(array $strings, bool $caseSensitive = true): bool
    {
        foreach ($strings as $string) {
            if ($this->endsWith($string, $caseSensitive)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $string
     * @param bool   $caseSensitive
     *
     * @return bool
     */
    public function equals(string $string, bool $caseSensitive = true): bool
    {
        if ($caseSensitive) {
            return $this->string->toString() === $string;
        }

        return strtolower($this->string->toString()) === strtolower($string);
    }

    /**
     * @param array $strings
     * @param bool  $caseSensitive
     *
     * @return bool
     */
    public function isOneOf(array $strings, bool $caseSensitive = true): bool
    {
        foreach ($strings as $string) {
            if ($this->equals($string, $caseSensitive)) {
                return true;
            }
        }

        return false;
    }
}
