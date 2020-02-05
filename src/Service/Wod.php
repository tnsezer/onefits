<?php

namespace  App\Service;

use App\Model\Participant;
use App\Model\Participants;
use App\Model\Program;

class Wod
{
    private const BREAK_CODE = 'BREAK';
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
        'C003',
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
        self::BREAK_CODE => 'Take a break',
    ];
    /** @var int $maximumExercise */
    private $maximumExercise = 30;
    /** @var int $limitedSpace */
    private $limitedSpace = 0;

    /**
     * Wod constructor.
     * @param Participants $participants
     */
    public function __construct(Participants $participants)
    {
        $this->participants = $participants->getParticipants();
        $this->build();
    }

    /**
     * @return int
     */
    public function getExerciseLimit(): int
    {
        return $this->maximumExercise;
    }

    /**
     * @param int $practiseIndex
     * @return \Generator
     */
    public function getParticipantAndExercise(int $practiseIndex): \Generator
    {
        foreach ($this->participants as $participant) {
            yield $participant => $this->getDescription($participant->getProgram()->getPractise($practiseIndex));
        }
    }

    private function build(): void
    {
        for ($minute=0; $minute<$this->maximumExercise; $minute++) {
            $this->limitedSpace = 0;
            foreach ($this->participants as $participant) {
                if (!$this->isAddedBreak($participant, $minute)) {
                    $this->addPractise($participant);
                }
            }
        }
    }

    /**
     * @param string $code
     * @return string
     */
    private function getDescription(string $code): string
    {
        return $this->descriptions[$code] ?? '';
    }

    /**
     * @param Participant $participant
     * @param int $step
     * @return bool
     */
    private function isAddedBreak(Participant $participant, int $step): bool
    {
        /** @var Program $program */
        $program = $participant->getProgram();
        if ($this->isDeservedBreak($program, $step)) {
            $program->addPractise(self::BREAK_CODE);
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
        return $step > 0 && $step % ($this->maximumExercise / ($program->getBreak() + 1)) === 0;
    }

    /**
     * @param Participant $participant
     */
    private function addPractise(Participant $participant): void
    {
        $exercise = $this->getRandomExercise();
        /** @var Program $program */
        $program = $participant->getProgram();
        if (count($program->getPractises()) > 0) {
            while ($this->isNotMeetingConditions($participant, $exercise)) {
                $exercise = $this->getRandomExercise();
            }
        }

        $program->addPractise($exercise);
    }

    /**
     * @return string
     */
    private function getRandomExercise(): string
    {
        return $this->exercises[array_rand($this->exercises)];
    }

    /**
     * @param Participant $participant
     * @param string $code
     * @return bool
     */
    private function isNotMeetingConditions(Participant $participant, string $code): bool
    {
        return $this->isSuccessiveCardio($participant->getProgram(), $code)
                && $this->hasHandstandBefore($participant, $code)
                    && $this->isExceedLimitedSpace($code);
    }

    /**
     * @param Program $program
     * @param string $code
     * @return bool
     */
    private function isSuccessiveCardio(Program $program, string $code): bool
    {
        $practises = $program->getPractises();
        $lastPractise = end($practises);

        $codeType = substr($code, 0, 1);
        $lastCodeType = substr($lastPractise, 0, 1);

        if ($codeType === 'C' && $lastCodeType === $codeType) {
            return true;
        }

        return false;
    }

    /**
     * @param Participant $participant
     * @param string $code
     * @return bool
     */
    private function hasHandstandBefore(Participant $participant, string $code): bool
    {
        if ($participant->isBeginner() && $this->isHandstand($participant->getProgram(), $code)) {
            return true;
        }

        return false;
    }

    /**
     * @param Program $program
     * @param string $code
     * @return bool
     */
    private function isHandstand(Program $program, string $code): bool
    {
        return $code === 'H001' && array_search($code, $program->getPractises()) > -1;
    }

    /**
     * @param string $code
     * @return bool
     */
    private function isExceedLimitedSpace(string $code): bool
    {
        if (substr($code, 0, 1) === 'U') {
            if ($this->limitedSpace >= 2) {
                return true;
            }
            $this->limitedSpace++;
        }

        return false;
    }
}