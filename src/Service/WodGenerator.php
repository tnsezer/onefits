<?php

namespace  App\Service;

use App\Model\Conditions\BeginnerAndHaveHandstandCondition;
use App\Model\Conditions\ConditionChecker;
use App\Model\Conditions\ExceedLimitedSpaceCondition;
use App\Model\Conditions\SuccessiveCardioCondition;
use App\Model\Exercises\TakeBreak;
use App\Model\Participant;
use App\Model\ParticipantList;
use App\Model\Program;
use App\Model\ExerciseList;

class WodGenerator
{

    /** @var Participant[] $participants */
    private $participants;
    /** @var ExerciseList $exerciseList */
    private $exerciseList;
    /** @var int $exerciseCount */
    private $exerciseCount = 30;
    /** @var ConditionChecker $conditionChecker */
    private $conditionChecker;

    /**
     * Wod constructor.
     * @param ParticipantList $participants
     * @throws \Exception
     */
    public function __construct(ParticipantList $participants)
    {
        $this->participants = $participants->getIterator();
        $this->exerciseList = new ExerciseList();
        $this->build();
    }

    /**
     * @return int
     */
    public function getExerciseLimit(): int
    {
        return $this->exerciseCount;
    }

    /**
     * @param int $practiseIndex
     * @return \Generator
     */
    public function getParticipantAndExercise(int $practiseIndex): \Generator
    {
        foreach ($this->participants as $participant) {
            yield $participant => $participant->getProgram()->getPractise($practiseIndex);
        }
    }

    private function build(): void
    {
        for ($minute=0; $minute < $this->getExerciseLimit(); $minute++) {
            $this->conditionChecker = new ConditionChecker();
            $this->conditionChecker->add(new ExceedLimitedSpaceCondition());
            foreach ($this->participants as $participant) {
                if (!$this->isAddedBreak($participant->getProgram(), $minute)) {
                    $this->addPractise($participant);
                }
            }
        }
    }

    /**
     * @param Program $program
     * @param int $step
     * @return bool
     */
    private function isAddedBreak(Program $program, int $step): bool
    {
        if ($this->isDeservedBreak($program, $step)) {
            $program->addPractise(new TakeBreak());

            return true;
        }

        return false;
    }

    /**
     * @param Program $program
     * @param int $step
     * @return bool
     */
    private function isDeservedBreak(Program $program, int $step): bool
    {
        return $step > 0 && $step % ($this->exerciseCount / ($program->getBreak() + 1)) === 0;
    }

    /**
     * @param Participant $participant
     */
    private function addPractise(Participant $participant): void
    {
        $program = $participant->getProgram();
        $this->conditionChecker->add(new BeginnerAndHaveHandstandCondition($participant));
        $this->conditionChecker->add(new SuccessiveCardioCondition($program));

        do {
            $exercise = $this->exerciseList->getRandomExercise();
        } while($program->getPractisesCount() > 0 && !$this->conditionChecker->checkAll($exercise));

        $program->addPractise($exercise);
    }
}