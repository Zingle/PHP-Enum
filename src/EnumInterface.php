<?php

namespace ZingleCom\Enum;


/**
 * Interface AbstractEnum
 */
interface EnumInterface
{
    /**
     * @return string
     */
    public function getConstantName(): string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @return string
     */
    public function getDisplayName(): string;

    /**
     * @param mixed $value
     * @return bool
     */
    public function is($value): bool;
}