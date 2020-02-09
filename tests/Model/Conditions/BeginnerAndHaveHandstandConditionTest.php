<?php


namespace Test\Model\Conditions;

use App\Model\Conditions\BeginnerAndHaveHandstandCondition;
use App\Model\Exercises\HandStand;
use App\Model\Participant;
use PHPUnit\Framework\TestCase;

class BeginnerAndHaveHandstandConditionTest extends TestCase
{
    public function testCheck()
    {
        $handstand = new HandStand();
        $participant = new Participant('Test', true);
        $condition = new BeginnerAndHaveHandstandCondition($participant);
        $this->assertTrue($condition->check($handstand));
        $participant->getProgram()->addPractise($handstand);
        $this->assertFalse($condition->check($handstand));
    }
}