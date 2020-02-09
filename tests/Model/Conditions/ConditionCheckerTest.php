<?php


namespace Test\Model\Conditions;

use App\Model\Conditions\ConditionChecker;
use PHPUnit\Framework\TestCase;
use Test\ModelGenerator;

class ConditionCheckerTest extends TestCase
{
    use ModelGenerator;

    /** @var ConditionChecker $conditionChecker */
    private $conditionChecker;

    public function setUp(): void
    {
        $this->conditionChecker = new ConditionChecker();
    }

    public function testAdd()
    {
        $condition = $this->createCondition(true);
        $this->assertInstanceOf(ConditionChecker::class, $this->conditionChecker->add($condition));
    }

    public function testCheckAll()
    {
        $exercise = $this->createExercise('TEST');
        $condition = $this->createCondition(true);
        $this->conditionChecker->add($condition);
        $this->assertTrue($this->conditionChecker->checkAll($exercise));
    }
}