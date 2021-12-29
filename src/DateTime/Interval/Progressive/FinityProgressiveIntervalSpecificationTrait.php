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

        $interval = $this->getIntervals()[$requestedPointNumber - 1] ?? null;

        if ($interval !== null) {
            $seconds = floor($interval);
            $milliseconds = $interval - $seconds;

            $dateTimeInterval = new \DateInterval("PT{$seconds}S");
            $dateTimeInterval->f = $milliseconds;

            if ($requestedPointNumber === 1) {
                $prevPoint = new \DateTimeImmutable();
            }

            return $prevPoint->add($dateTimeInterval);
        }

        return null;
    }

    /**
     * @return int[]|float[] seconds with optional fractal parts
     */
    abstract protected function getIntervals(): array;
}