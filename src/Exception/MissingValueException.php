<?php

namespace ZingleCom\Enum\Exception;

/**
 * Class MissingValueException
 */
class MissingValueException extends EnumException
{
    /**
     * MissingValueException constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('Missing value "%s"', $value));
    }
}
