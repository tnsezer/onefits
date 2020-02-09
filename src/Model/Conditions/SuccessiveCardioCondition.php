<?php


namespace App\Model\Conditions;


use App\Model\Exercises\Exercise;
use App\Model\Program;

class SuccessiveCardioCondition implements Condition
{

    private const CARDIO_GROUP_CODE = 'C';
    private $program;

    public function __construct(Program $program)
    {
        $this->program = $program;
    }

    public function check(Exercise $exercise): bool
    {
        $practises = $this->program->getPractises();
        /** @var Exercise $lastPractise */
        $lastPractise = end($practises);

        $codeType = $exercise->getGroupCode();
        $lastCodeType = $lastPractise->getGroupCode();

        if ($codeType === self::CARDIO_GROUP_CODE && $lastCodeType === $codeType) {
            return false;
        }

        return true;
    }
}