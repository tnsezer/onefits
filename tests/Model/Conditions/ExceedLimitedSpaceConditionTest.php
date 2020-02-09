<?php


namespace Test\Model\Conditions;

use App\Model\Conditions\ExceedLimitedSpaceCondition;
use App\Model\Exercises\Ring;
use PHPUnit\Framework\TestCase;

class ExceedLimitedSpaceConditionTest extends TestCase
{
    public function testCheck()
    {
        $ring = new Ring();
        $condition = new ExceedLimitedSpaceCondition();
        $this->assertTrue($condition->check($ring));
        $this->assertTrue($condition->check($ring));
        $this->assertFalse($condition->check($ring));

    }
}