<?php

namespace ZingleCom\Enum\Meta;

use phootwork\collection\Map;
use ZingleCom\Enum\AbstractEnum;
use ZingleCom\Enum\Exception\EnumException;
use ZingleCom\Enum\Meta;
use ZingleCom\Enum\MetaInterface;

/**
 * Class Generator
 */
class Generator implements GeneratorInterface
{
    /**
     * @var Map
     */
    private $meta;


    /**
     * MetaGenerator constructor.
     */
    public function __construct()
    {
        $this->meta = new Map();
    }

    /**
     * @param AbstractEnum $enum
     * @return MetaInterface
     * @throws EnumException
     */
    public function get(AbstractEnum $enum): MetaInterface
    {
        $key = get_class($enum);
        if (!$this->meta->has($key)) {
            $this->meta->set($key, $this->create($enum));
        }

        return $this->meta->get($key);
    }

    /**
     * @param AbstractEnum $enum
     * @return MetaInterface
     * @throws EnumException
     */
    private function create(AbstractEnum $enum): MetaInterface
    {
        try {
            $refl = new \ReflectionClass($enum);

            return new Meta($refl->getConstants());
        } catch (\ReflectionException $e) {
            throw new EnumException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
