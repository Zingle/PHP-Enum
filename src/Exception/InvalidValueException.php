<?php

namespace ZingleCom\Enum\Exception;

/**
 * Class InvalidValueException
 */
class InvalidValueException extends EnumException
{
    /**
     * InvalidValidException constructor.
     * @param mixed $value
     */
    public function __construct($value)
    {
        parent::__construct(sprintf('Invalid value "%s".', $value));
    }
}
