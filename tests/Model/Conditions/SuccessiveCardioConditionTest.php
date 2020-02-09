<?php


namespace Test\Model\Conditions;

use App\Model\Conditions\SuccessiveCardioCondition;
use App\Model\Exercises\Ring;
use App\Model\Exercises\ShortSprint;
use App\Model\Program;
use PHPUnit\Framework\TestCase;

class SuccessiveCardioConditionTest extends TestCase
{
    public function testCheck()
    {
        $shortSprintCardio = new ShortSprint();
        $program = new Program(false);
        $program->addPractise($shortSprintCardio);
        $condition = new SuccessiveCardioCondition($program);
        $this->assertTrue($condition->check(new Ring()));
        $this->assertFalse($condition->check($shortSprintCardio));
    }
}