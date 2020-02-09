<?php


namespace App\Model\Conditions;


use App\Model\Exercises\Exercise;

class ConditionChecker
{
    /** @var array $conditionList */
    private $conditionList = [];

    /**
     * @param Condition $condition
     * @return ConditionChecker
     */
    public function add(Condition $condition): ConditionChecker
    {
        $this->conditionList[] = $condition;

        return $this;
    }

    /**
     * @param Exercise $exercise
     * @return bool
     */
    public function checkAll(Exercise $exercise): bool
    {
        foreach ($this->conditionList as $condition) {
            if (!$condition->check($exercise)) {
                return false;
            }
        }

        return true;
    }
}