<?php

namespace ZingleCom\Enum;

/**
 * Class TestEnum
 */
class TestEnum extends AbstractEnum
{
    const TEST_1 = 'test1';
    const TEST_2 = 'test2';
    const TEST_3 = 'test3';

  	// This shouldn't get included in meta
    private const NOT_INCLUDED = [
    	'some' => 'value',
    ];
}
