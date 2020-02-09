<?php


namespace App\Model\Conditions;


use App\Model\Exercises\Exercise;
use App\Model\Participant;

class BeginnerAndHaveHandstandCondition implements Condition
{

    private const HANDSTAND_CODE = 'H001';
    /** @var Participant $participant */
    private $participant;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    public function check(Exercise $exercise): bool
    {
        if ($this->participant->isBeginner() && $exercise->getCode() === self::HANDSTAND_CODE && $this->seekExercise($exercise)) {
            return false;
        }

        return true;
    }

    private function seekExercise(Exercise $exercise): bool
    {
        return !!array_filter(
            $this->participant->getProgram()->getPractises(),
            /**
             * @param Exercise $exerciseNode
             * @return bool
             */
            function ($exerciseNode) use ($exercise) {
                return $exerciseNode->getCode() === $exercise->getCode();
            }
        );
    }
}