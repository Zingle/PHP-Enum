<?php

namespace ZingleCom\Enum\Meta;

use ZingleCom\Enum\AbstractEnum;
use ZingleCom\Enum\Exception\EnumException;
use ZingleCom\Enum\MetaInterface;

/**
 * Interface Generator
 */
interface GeneratorInterface
{
    /**
     * @param string|AbstractEnum $enumClass
     *
     * @return MetaInterface
     *
     * @throws EnumException
     */
    public function get(string $enumClass): MetaInterface;
}