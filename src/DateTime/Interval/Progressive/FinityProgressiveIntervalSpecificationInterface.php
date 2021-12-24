<?php

namespace KFencer\DateTime\Interval\Progressive;

interface FinityProgressiveIntervalSpecificationInterface extends ProgressiveIntervalSpecificationInterface
{
    /**
     * Если запрашиваемая точка интервала не определена, вернется null.
     */
    public function getNextPoint(int $requestedPointNumber = null, \DateTimeImmutable $prevPoint = null): ?\DateTimeImmutable;
}