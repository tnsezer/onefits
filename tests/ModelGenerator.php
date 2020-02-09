<?php

namespace Test;

use App\Model\Conditions\Condition;
use App\Model\Exercises\Exercise;

trait ModelGenerator
{
    /**
     * @param string $code
     * @return Exercise
     */
    private function createExercise(string $code): Exercise
    {
        $exerciseClass = $this->getMockBuilder(Exercise::class)
            ->setMethods(['getCode', 'getGroupCode', 'getDescription', '__toString'])
            ->getMock();

        $exerciseClass->method('getCode')
            ->willReturn($code);
        $exerciseClass->method('__toString')
            ->willReturn($code);

        return $exerciseClass;
    }

    /**
     * @param bool $return
     * @return Condition
     */
    private function createCondition(bool $return): Condition
    {
        $conditionClass = $this->getMockBuilder(Condition::class)
            ->setMethods(['check'])
            ->getMock();

        $conditionClass->method('check')
            ->willReturn($return);

        return $conditionClass;
    }
}