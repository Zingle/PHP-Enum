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
     * @param AbstractEnum $enum
     * @return MetaInterface
     * @throws EnumException
     */
    public function get(AbstractEnum $enum): MetaInterface;
}