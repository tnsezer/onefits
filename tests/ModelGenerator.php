<?php


namespace Test;


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
}