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
     * @param string|AbstractEnum $enumClass
     * @return MetaInterface
     * @throws EnumException
     */
    public function get(string $enumClass): MetaInterface
    {
        if (!$this->meta->has($enumClass)) {
            $this->meta->set($enumClass, $this->create($enumClass));
        }

        return $this->meta->get($enumClass);
    }

    /**
     * @param string $enumClass
     * @return MetaInterface
     * @throws EnumException
     */
    private function create(string $enumClass): MetaInterface
    {
        try {
            $refl = new \ReflectionClass($enumClass);
            if (!$refl->isSubclassOf(AbstractEnum::class)) {
                throw new EnumException(sprintf('Enum\'s must be of type %s', AbstractEnum::class));
            }

            $constants = [];
            $reflConstants = $refl->getReflectionConstants();
            foreach ($reflConstants as $reflConstant) {
                // don't add private constants to value value list.
                if ($reflConstant->isPrivate()) {
                    continue;
                }

                $constants[$reflConstant->getName()] = $reflConstant->getValue();
            }

            return new Meta($constants);
        } catch (\ReflectionException $e) {
            throw new EnumException($e->getMessage(), $e->getCode(), $e);
        }
    }
}
