<?php

namespace ZingleCom\Enum\Meta;

/**
 * Class GeneratorFactory
 */
class GeneratorFactory
{
    /**
     * @var GeneratorInterface
     */
    private static $generator;


    /**
     * @param bool $shared
     * @return GeneratorInterface
     */
    public static function create($shared = true): GeneratorInterface
    {
        if (true === $shared) {
            return self::getGenerator();
        }

        return self::make();
    }

    /**
     * @return GeneratorInterface
     */
    private static function getGenerator(): GeneratorInterface
    {
        if (null === self::$generator) {
            self::$generator = self::make();
        }

        return self::$generator;
    }

    /**
     * @return GeneratorInterface
     */
    private static function make(): GeneratorInterface
    {
        return new Generator();
    }
}
