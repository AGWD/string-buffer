<?php declare(strict_types=1);

namespace AdrianGreen\String\Extensions;

use AdrianGreen\String\StringBuffer;
use function ctype_lower;
use function lcfirst;
use function mb_strtolower;
use function preg_replace;
use function ucwords;

class Convention extends AbstractExtension
{
    /**
     * The cache of snake-cased words.
     *
     * @var array
     */
    protected static array $snakeCache = [];

    /**
     * The cache of camel-cased words.
     *
     * @var array
     */
    protected static array $camelCache = [];

    /**
     * The cache of studly-cased words.
     *
     * @var array
     */
    protected static array $studlyCache = [];

    /**
     * Convert a string to snake case.
     *
     * @param string $value
     * @param string $delimiter
     *
     * @return string
     */
    public static function snake(string $value, string $delimiter = '_'): string
    {
        $key = $value;

        if (isset(static::$snakeCache[$key][$delimiter])) {
            return static::$snakeCache[$key][$delimiter];
        }

        if (! ctype_lower($value)) {
            $value = preg_replace('/\s+/u', '', ucwords($value));

            $value = static::lower(preg_replace('/(.)(?=[A-Z])/u', '$1'.$delimiter, $value));
        }

        return static::$snakeCache[$key][$delimiter] = $value;
    }

    /**
     * @param bool $ucFirst
     *
     * @return StringBuffer
     */
    public function camelCase(bool $ucFirst = false): StringBuffer
    {
        $this->string->setString(static::camel($this->string->toString()));
        if ($ucFirst) {
            $this->string->ucFirst();
        }

        return $this->string;
    }

    /**
     * Convert a value to studly caps case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function studly(string $value): string
    {
        $key = $value;

        if (isset(static::$studlyCache[$key])) {
            return static::$studlyCache[$key];
        }

        $value = ucwords(\str_replace(['-', '_'], ' ', $value));

        return static::$studlyCache[$key] = \str_replace(' ', '', $value);
    }

    /**
     * Convert a value to camel case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function camel(string $value): string
    {
        if (isset(static::$camelCache[$value])) {
            return static::$camelCache[$value];
        }

        return static::$camelCache[$value] = lcfirst(static::studly($value));
    }

    /**
     * Convert the given string to lower-case.
     *
     * @param string $value
     *
     * @return string
     */
    public static function lower(string $value): string
    {
        return mb_strtolower($value, 'UTF-8');
    }


    /**
     * @param string $delimiter
     *
     * @return StringBuffer
     */
    public function snakeCase(string $delimiter = '_'): StringBuffer
    {
        $this->string->setString(static::snake($this->string->toString(), $delimiter));

        return $this->string;
    }

    /**
     * @return StringBuffer
     */
    public function ucFirst(): StringBuffer
    {
        $this->string->setString(ucfirst($this->string->toString()));

        return $this->string;
    }

    /**
     * @return StringBuffer
     */
    public function lcFirst(): StringBuffer
    {
        $this->string->setString(lcfirst($this->string->toString()));

        return $this->string;
    }

    /**
     * @return StringBuffer
     */
    public function ucWords(): StringBuffer
    {
        $this->string->setString(ucwords($this->string->toString()));

        return $this->string;
    }

}
