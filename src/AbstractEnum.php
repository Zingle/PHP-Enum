<?php

namespace ZingleCom\Enum;

use ZingleCom\Enum\Exception\InvalidValueException;
use ZingleCom\Enum\Meta\GeneratorFactory;
use ZingleCom\Enum\Meta\GeneratorInterface;

/**
 * Class AbstractEnum
 */
abstract class AbstractEnum implements EnumInterface
{
    /**
     * @var GeneratorInterface
     */
    private $generator;

    /**
     * @var string
     */
    private $constantName;

    /**
     * @var mixed
     */
    private $value;


    /**
     * AbstractEnum constructor.
     * @param mixed $value
     * @throws Exception\EnumException
     * @throws Exception\MissingValueException
     * @throws InvalidValueException
     */
    public function __construct($value)
    {
        $this->generator = GeneratorFactory::create();
        $meta = $this->generator->get($this);

        if (!$meta->isValid($value)) {
            throw new InvalidValueException($value);
        }

        $this->constantName = $meta->getConstantName($value);
        $this->value        = $value;
    }

    /**
     * @return string
     */
    public function getConstantName(): string
    {
        return $this->constantName;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getDisplayName(): string
    {
        return mb_convert_case(
            strtolower(str_replace('_', ' ', $this->constantName)),
            MB_CASE_TITLE,
            'UTF-8'
        );
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function is($value): bool
    {
        return $value === $this->getValue();
    }
}
