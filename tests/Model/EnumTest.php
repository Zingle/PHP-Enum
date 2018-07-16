<?php

namespace ZingleCom\Enum\Tests\Model;

use PHPUnit\Framework\TestCase;
use ZingleCom\Enum\Exception\SizeMismatchException;
use ZingleCom\Enum\Meta;
use ZingleCom\Enum\Meta\Generator;
use ZingleCom\Enum\TestEnum;

/**
 * Class EnumTest
 */
class EnumTest extends TestCase
{
    /**
     * @throws SizeMismatchException
     * @throws \ZingleCom\Enum\Exception\MissingValueException
     */
    public function testMeta()
    {
        $constants = [
            'CONS1' => 1,
            'CONS2' => 2,
            'CONS3' => 3,
        ];
        $meta = new Meta($constants);

        foreach ($constants as $const => $value) {
            $this->assertTrue($meta->isValid($value));
            $this->assertEquals($const, $meta->getConstantName($value));
        }

        $constants['CONS4'] = 3;
        $this->expectException(SizeMismatchException::class);
        $meta = new Meta($constants);
    }

    /**
     * @throws \ZingleCom\Enum\Exception\EnumException
     * @throws \ZingleCom\Enum\Exception\InvalidValueException
     * @throws \ZingleCom\Enum\Exception\MissingValueException
     */
    public function testGeneratorAndModel()
    {
        $generator = new Generator();
        $testEnum  = new TestEnum(TestEnum::TEST_1);
        $meta = $generator->get($testEnum);

        $this->assertInstanceOf(Meta::class, $meta);
        $this->assertEquals(TestEnum::TEST_1, $testEnum->getValue());
        $this->assertEquals('TEST_1', $testEnum->getConstantName());
        $this->assertEquals('Test 1', $testEnum->getDisplayName());
    }
}