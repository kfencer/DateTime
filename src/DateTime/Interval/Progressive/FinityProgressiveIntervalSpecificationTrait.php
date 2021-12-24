<?php

namespace KFencer\DateTime\Interval\Progressive;

trait FinityProgressiveIntervalSpecificationTrait
{
    /**
     * @throws \InvalidArgumentException
     */
    public function getNextPoint(int $requestedPointNumber = null, \DateTimeImmutable $prevPoint = null): ?\DateTimeImmutable
    {
        if ($requestedPointNumber < 1 || $requestedPointNumber > 1 && $prevPoint === null) {
            throw new \InvalidArgumentException();
        }

        if ($requestedPointNumber === 1) {
            return new \DateTimeImmutable();
        }

        $interval = $this->getIntervals()[$requestedPointNumber - 2] ?? null;

        if ($interval !== null) {
            $seconds = floor($interval / 1000);
            $milliseconds = $interval - $seconds;

            $dateTimeInterval = new \DateInterval("PT{$seconds}S");
            $dateTimeInterval->f = $milliseconds;

            return $prevPoint->add($dateTimeInterval);
        }

        return null;
    }

    /**
     * @return int[]|float[] seconds with optional fractal parts
     */
    abstract protected function getIntervals(): array;
}