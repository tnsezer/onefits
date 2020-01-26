<?php

namespace  App\Service;

use App\Model\Participant;
use App\Model\Program;

class Wod
{
    /** @var Participant[] $participants */
    private $participants;
    /** @var array $exercises */
    private $exercises = [
        'C001',
        'P001',
        'S001',
        'S002',
        'U001',
        'U002',
        'C002',
        'H001',
        'C003'
    ];
    /** @var array $descriptions */
    private $descriptions = [
        'C001' => 'Jumping jacks',
        'P001' => 'Push ups',
        'S001' => 'Front squats',
        'S002' => 'Back squats',
        'U001' => 'Pull ups',
        'U002' => 'Rings',
        'C002' => 'Short sprints',
        'H001' => 'Handstand practice',
        'C003' => 'Jumping rope',
        'BREAK' => 'Take a break'
    ];
    /** @var int $maximumExercise */
    private $maximumExercise = 30;
    /** @var int $limitedSpace */
    private $limitedSpace = 0;

    /**
     * Wod constructor.
     * @param Participant[] $participants
     */
    public function __construct(array $participants)
    {
        $this->participants = $participants;
        $this->build();
    }

    private function build()
    {
        for ($minute=0; $minute<$this->maximumExercise; $minute++) {
            $this->limitedSpace = 0;
            foreach ($this->participants as $participant) {
                if (!$this->deserveBreak($participant, $minute)) {
                    $this->addPractise($participant);
                }
            }
        }
    }

    /**
     * @param Participant $participant
     * @param int $step
     * @return bool
     */
    private function deserveBreak(Participant $participant, int $step): bool
    {
        /** @var Program $program */
        $program = $participant->getProgram();
        if ($step > 0 && $step % ($this->maximumExercise / ($program->getBreak() + 1)) === 0) {
            $program->addPractise('BREAK');
            return true;
        }

        return false;
    }

    /**
     * @param Participant $participant
     */
    private function addPractise(Participant $participant): void
    {
        $exercise = $this->randomExercise();
        /** @var Program $program */
        $program = $participant->getProgram();
        if (count($program->getPractises()) > 0) {
            while (!$this->checkConditions($participant, $exercise)) {
                $exercise = $this->randomExercise();
            }
        }

        $program->addPractise($exercise);
    }

    /**
     * @return string
     */
    private function randomExercise(): string
    {
        return $this->exercises[array_rand($this->exercises)];
    }

    /**
     * @param Participant $participant
     * @param string $code
     * @return bool
     */
    private function checkConditions(Participant $participant, string $code): bool
    {
        return $this->checkCardio($participant->getProgram(), $code)
            && $this->checkHandstand($participant, $code)
            && $this->checkLimitedSpace($code);
    }

    /**
     * @param Program $program
     * @param string $code
     * @return bool
     */
    private function checkCardio(Program $program, string $code): bool
    {
        $practises = $program->getPractises();
        $lastPractise = end($practises);

        $codeType = $code[0];
        $lastCodeType = $lastPractise[0];

        if ($codeType === 'C' && $lastCodeType === $code[0]) {
            return false;
        }

        return true;
    }

    /**
     * @param Participant $participant
     * @param string $code
     * @return bool
     */
    private function checkHandstand(Participant $participant, string $code): bool
    {
        if ($participant->isBeginner() && $code === 'H001' && array_search('H001', $participant->getProgram()->getPractises()) > -1) {
            return false;
        }

        return true;
    }

    /**
     * @param string $code
     * @return bool
     */
    private function checkLimitedSpace(string $code): bool
    {
        if ($code[0] === 'U') {
            if ($this->limitedSpace >= 2) {
                return false;
            }
            $this->limitedSpace++;
        }

        return true;
    }

    /**
     * @param string $code
     * @return string
     */
    private function getDescription(string $code): string
    {
        return $this->descriptions[$code] ?? '';
    }

    public function output()
    {
        for ($i=0; $i<$this->maximumExercise; $i++) {
            echo sprintf('%02d:00 - %02d:00 - ', $i, $i+1);
            foreach ($this->participants as $participant) {
                $exercise = $participant->getProgram()->getPractise($i);
                echo $participant->getName() . ' will do ' . $this->getDescription($exercise) . ', ';
            }
            echo '<br>';
        }
    }
}