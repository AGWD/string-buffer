<?php declare(strict_types=1);

namespace AdrianGreen\String;

use AdrianGreen\String\{Exceptions\UnknownMethodException, Extensions\Loader};

/**
 * Class StringBuffer
 *
 * @package AdrianGreen\StringBuffer
 *
 * @see \AdrianGreen\String\Extensions\Conditions
 * @method bool contains(string $string, bool $caseSensitive = false)
 * @method bool containsOneOf(array $strings, bool $caseSensitive = false)
 * @method bool beginsWith(string $string, bool $caseSensitive = true)
 * @method bool beginsWithOneOf(array $strings, bool $caseSensitive = true)
 * @method bool endsWith($string, bool $caseSensitive = true)
 * @method bool endsWithOneOf(array $strings, bool $caseSensitive = true)
 * @method bool equals(string $string, bool $caseSensitive = true)
 * @method bool isOneOf(array $strings, bool $caseSensitive = true)
 *
 * @see \AdrianGreen\String\Extensions\Convention
 * @method StringBuffer camelCase(bool $ucFirst = false)
 * @method StringBuffer snakeCase(string $delimiter = '_')
 * @method StringBuffer ucFirst()
 * @method StringBuffer lcFirst()
 * @method StringBuffer ucWords()
 *
 * @see \AdrianGreen\String\Extensions\Parser
 * @method array parseCSV(string $string, string $delimiter = ',', string $enclosure = '"', string $escape = '\\')
 *
 * @see \AdrianGreen\String\Extensions\Properties
 * @method int length()
 *
 * @see \AdrianGreen\String\Extensions\StringTransformer
 * @method StringBuffer toLower()
 * @method StringBuffer toUpper()
 * @method float toFloat()
 * @method int toInteger()
 *
 * @see \AdrianGreen\String\Extensions\Lister
 * @method array split(string $delimiter)
 * @method array splitUppercase(bool $strToLower = false)
 *
 * @see \AdrianGreen\String\Extensions\Manipulator
 * @method StringBuffer trim(string $charList = " \t\n\r\0\x0B")
 * @method StringBuffer trimLeft(string $charList = " \t\n\r\0\x0B")
 * @method StringBuffer trimRight(string $charList = " \t\n\r\0\x0B")
 * @method StringBuffer cutLeft(string $string, bool $caseSensitive = false)
 * @method StringBuffer cutRight(string $string, bool $caseSensitive = false)
 * @method StringBuffer replace(string|array $search, string|array $replace, bool $caseSensitive = true): StringBuffer
 * @method StringBuffer remove(string|array $string, bool $caseSensitive = true)
 *
 * @see \AdrianGreen\String\Extensions\Hashes
 * @method StringBuffer md5()
 * @method StringBuffer sha1()
 *
 * @see \AdrianGreen\String\Extensions\Process
 * @method StringBuffer when(bool $condition, callable $then, callable $else = null)
 *
 * @see \AdrianGreen\String\Extensions\Url
 * @method StringBuffer urlEncode()
 * @method StringBuffer urlDecode()
 * @method StringBuffer base64Encode()
 * @method StringBuffer base64Decode()
 */
class StringBuffer
{
    /**
     * @var string
     */
    private string $string;

    /**
     * @var Loader
     */
    private Loader $loader;

    /**
     * StringBuffer constructor.
     *
     * @param string $string
     */
    public function __construct(string $string)
    {
        $this->string = $string;
        $this->loader = new Loader($this);
    }

    /**
     * @param string $string
     *
     * @return StringBuffer
     */
    public static function create(string $string): StringBuffer
    {
        return new StringBuffer($string);
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return mixed
     * @throws UnknownMethodException
     */
    public function __call(string $name, array $arguments)
    {
        foreach ($this->loader->getExtensions() as $extension) {
            if ($this->loader->extensionHasMethod($extension, $name)) {
                return \call_user_func_array([$this->loader->factory($extension), $name], $arguments);
            }
        }

        throw new UnknownMethodException($name);
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        return $this->string;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->toString();
    }

    /**
     * @param string $string
     *
     * @return StringBuffer
     */
    public function setString(string $string): StringBuffer
    {
        $this->string = $string;

        return $this;
    }

    /**
     * @param string $string
     *
     * @return StringBuffer
     */
    public function append(string $string): StringBuffer
    {
        $this->string .= $string;

        return $this;
    }

    /**
     * @param bool        $condition
     * @param string      $string
     * @param string|null $else
     *
     * @return StringBuffer
     */
    public function appendIf(bool $condition, string $string, string $else = null): StringBuffer
    {
        if ($condition) {
            return $this->append($string);
        }

        if (!is_null($else)) {
            return $this->append($else);
        }

        return $this;
    }

    /**
     * @param string $string
     *
     * @return StringBuffer
     */
    public function prepend(string $string): StringBuffer
    {
        $this->string = $string . $this->string;

        return $this;
    }

    /**
     * @param bool        $condition
     * @param string      $string
     * @param string|null $else
     *
     * @return StringBuffer
     */
    public function prependIf(bool $condition, string $string, string $else = null): StringBuffer
    {
        if ($condition) {
            return $this->prepend($string);
        }

        if (!is_null($else)) {
            return $this->prepend($else);
        }

        return $this;
    }

    /**
     * @param int      $start
     * @param int|null $length
     *
     * @return StringBuffer
     */
    public function substring(int $start, int $length = null): StringBuffer
    {
        if (is_null($length)) {
            $this->string = \substr($this->string, $start);
        } else {
            $this->string = \substr($this->string, $start, $length);
        }

        return $this;
    }

    /**
     * @param bool $utf8
     *
     * @return StringBuffer
     */
    public function reverse(bool $utf8 = false): StringBuffer
    {
        if ($utf8) {
            \preg_match_all('/./us', $this->string, $matches);
            $this->string = \implode('', \array_reverse($matches[0]));
        } else {
            $this->string = \strrev($this->string);
        }

        return $this;
    }
}
