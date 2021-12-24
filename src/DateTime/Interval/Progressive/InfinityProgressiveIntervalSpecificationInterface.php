<?php

namespace KFencer\DateTime\Interval\Progressive;

interface InfinityProgressiveIntervalSpecificationInterface extends ProgressiveIntervalSpecificationInterface
{
    public function getNextPoint(int $requestedPointNumber = null, \DateTimeImmutable $prevPoint = null): \DateTimeImmutable;
}