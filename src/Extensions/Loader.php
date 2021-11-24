<?php declare(strict_types=1);

namespace AdrianGreen\String\Extensions;

use AdrianGreen\String\{Exceptions\UnknownExtensionException, StringBuffer};

class Loader
{
    public const EXTENSION_CONVENTION  = 'convention';
    public const EXTENSION_CONDITIONS  = 'conditions';
    public const EXTENSION_HASHES      = 'hashes';
    public const EXTENSION_LISTER      = 'lister';
    public const EXTENSION_MANIPULATOR = 'manipulator';
    public const EXTENSION_PARSER      = 'parser';
    public const EXTENSION_PROPERTIES  = 'properties';
    public const EXTENSION_TRANSFORMER = 'transformer';
    public const EXTENSION_URL         = 'url';
    public const EXTENSION_PROCESS     = 'process';

    /**
     * @var array
     */
    private array $classMap = [
        self::EXTENSION_CONVENTION  => Convention::class,
        self::EXTENSION_CONDITIONS  => Conditions::class,
        self::EXTENSION_HASHES      => Hashes::class,
        self::EXTENSION_MANIPULATOR => Manipulator::class,
        self::EXTENSION_LISTER      => Lister::class,
        self::EXTENSION_PARSER      => Parser::class,
        self::EXTENSION_PROPERTIES  => Properties::class,
        self::EXTENSION_TRANSFORMER => Transformer::class,
        self::EXTENSION_URL         => Url::class,
        self::EXTENSION_PROCESS     => Process::class,
    ];

    /**
     * @var array
     */
    protected array $extensionCache = [];

    /**
     * @var array
     */
    protected array $extensionMethods = [];

    /**
     * @var StringBuffer
     */
    private StringBuffer $string;

    /**
     * Loader constructor.
     *
     * @param StringBuffer $string
     */
    public function __construct(StringBuffer $string)
    {
        $this->string = $string;
        foreach ($this->classMap as $key => $class) {
            $this->extensionMethods[ $key ] = \get_class_methods($class);
        }
    }

    /**
     * @param string $extension
     *
     * @return AbstractExtension
     * @throws UnknownExtensionException
     */
    public function factory(string $extension): AbstractExtension
    {
        if (!\array_key_exists($extension, $this->classMap)) {
            throw new UnknownExtensionException($extension);
        }

        if (!isset($this->extensionCache[ $extension ])) {
            $this->extensionCache[ $extension ] = new $this->classMap[$extension]($this->string);
        }

        return $this->extensionCache[ $extension ];
    }

    /**
     * @param string $extension
     * @param string $method
     *
     * @return bool
     */
    public function extensionHasMethod(string $extension, string $method): bool
    {
        return \in_array($method, $this->extensionMethods[$extension], true);
    }

    /**
     * @return array
     */
    public function getExtensions(): array
    {
        return \array_keys($this->classMap);
    }
}
