<?php


namespace App\Model\Conditions;


use App\Model\Exercises\Exercise;

class ExceedLimitedSpaceCondition implements Condition
{
    private const SPACE_COUNT = 2;
    private const RING_GROUP_CODE = 'R';
    private $reservedSpace = 0;

    public function check(Exercise $exercise): bool
    {
        if ($exercise->getGroupCode() === self::RING_GROUP_CODE ) {
            if ($this->reservedSpace === self::SPACE_COUNT) {
                return false;
            }

            $this->reservedSpace++;
        }

        return true;
    }
}