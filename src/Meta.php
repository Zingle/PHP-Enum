<?php

namespace ZingleCom\Enum;

use phootwork\collection\Map;
use phootwork\collection\Set;
use ZingleCom\Enum\Exception\MissingValueException;
use ZingleCom\Enum\Exception\SizeMismatchException;

/**
 * Class Meta
 *
 * Contains meta data for enum class like constants
 * of the class, values, and some methods to access
 * that data inflected from the class.
 */
class Meta implements MetaInterface
{
    /**
     * @var Map
     */
    private $constants;

    /**
     * @var Set
     */
    private $values;


    /**
     * Meta constructor.
     *
     * @param array $constants
     *
     * @throws SizeMismatchException
     */
    public function __construct(array $constants)
    {
        $this->constants = new Map($constants);
        $this->values    = new Set($this->constants->values()->toArray());

        if ($this->constants->keys()->size() !== $this->values->size()) {
            throw new SizeMismatchException();
        }
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function isValid($value): bool
    {
        return $this->values->contains($value);
    }

    /**
     * @param mixed $value
     * @return string
     * @throws MissingValueException
     */
    public function getConstantName($value): string
    {
        $flipped = array_flip($this->constants->toArray());
        if (!isset($flipped[$value])) {
            throw new MissingValueException($value);
        }

        return $flipped[$value];
    }

    /**
     * @return Map
     */
    public function getConstants(): Map
    {
        return $this->constants;
    }
}
