<?php

namespace ZingleCom\Enum;

use phootwork\collection\Map;
use ZingleCom\Enum\Exception\MissingValueException;


/**
 * Interface Meta
 *
 * Contains meta data for enum class like constants
 * of the class, values, and some methods to access
 * that data inflected from the class.
 */
interface MetaInterface
{
    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value): bool;

    /**
     * @param mixed $value
     * @return string
     * @throws MissingValueException
     */
    public function getConstantName($value): string;

    /**
     * @return Map
     */
    public function getConstants(): Map;
}