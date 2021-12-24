<?php

use KFencer\DateTime\Interval\Progressive;

class FinitySpecification implements Progressive\FinityProgressiveIntervalSpecificationInterface
{
    use Progressive\FinityProgressiveIntervalSpecificationTrait;

    protected const INTERVALS = [
        0,
        0.000001,
        0.000001,
        2.000001,
        568800.000020
    ];

    protected function getIntervals(): array
    {
       return static::INTERVALS;
    }
}