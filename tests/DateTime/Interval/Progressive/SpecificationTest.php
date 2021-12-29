<?php

namespace KFencer\Tests\DateTime\Interval\Progressive;

use KFencer\Tests\DateTime\Interval\Progressive\Model\FinitySpecification;
use PHPUnit\Framework\TestCase;

class SpecificationTest extends TestCase
{
    protected FinitySpecification $finitySpecification;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->finitySpecification = new FinitySpecification();
    }

    /**
     * @dataProvider finityProvider
     */
    public function testFinity(
        int $requestedPointNumber,
        ?string $prevPointDateTimeString,
        ?string $expectedRequestedPointDateTimeString,
        ?string $expectedExceptionClassName
    ): void
    {
        $prevPointDateTime = $prevPointDateTimeString !== null
            ? new \DateTimeImmutable($prevPointDateTimeString)
            : null
        ;

        $expectedRequestedPointDateTime = $expectedRequestedPointDateTimeString !== \DateTimeImmutable::class && $expectedRequestedPointDateTimeString !== null
            ? new \DateTimeImmutable($expectedRequestedPointDateTimeString)
            : null
        ;

        if ($expectedExceptionClassName) {
            $this->expectException($expectedExceptionClassName);
        }

        $result = $this->finitySpecification->getNextPoint($requestedPointNumber, $prevPointDateTime);

        if ($expectedRequestedPointDateTimeString === \DateTimeImmutable::class) {
            $this->assertEquals($expectedRequestedPointDateTimeString, is_object($result) ? get_class($result) : null);
        } else {
            $this->assertEquals($expectedRequestedPointDateTime, $result);
        }
    }

    public function finityProvider(): array
    {
        return [
            [-1, null, null, \InvalidArgumentException::class],

            [0, null, null, \InvalidArgumentException::class],
            [1, '2021-12-12 00:00:00.000002', \DateTimeImmutable::class, null],
            [1, null, \DateTimeImmutable::class, null],
            [2, '2021-12-12 00:00:00.000003', '2021-12-12 00:00:00.000007', null],
            [3, '2021-12-12 00:00:00.000007', '2021-12-12 00:00:02.000014', null],
            [4, '2021-12-12 00:00:02.000014', '2021-12-12 23:00:02.000034', null],
            [5, '2021-12-12 00:00:00.000004', null, null],
            [6, '2021-12-12 00:00:02.000005', null, null]
        ];
    }
}