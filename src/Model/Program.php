<?php

namespace  App\Model;

use App\Model\Exercises\Exercise;

class Program
{
    private const PROFESSIONAL_BREAK = 2;
    private const BEGINNER_BREAK = 4;

    /** @var array $practises */
    private $practises = [];

    /** @var int $break */
    private $break;

    /**
     * Program constructor.
     * @param bool $isBeginner
     */
    public function __construct(bool $isBeginner)
    {
        $this->break = $isBeginner ? self::BEGINNER_BREAK : self::PROFESSIONAL_BREAK;
    }

    /**
     * @return int
     */
    public function getBreak(): int
    {
        return $this->break;
    }

    /**
     * @param Exercise $exercise
     */
    public function addPractise(Exercise $exercise): void
    {
        $this->practises[] = $exercise;
    }

    /**
     * @param int $line
     * @return Exercise
     */
    public function getPractise(int $line): Exercise
    {
        return $this->practises[$line];
    }

    /**
     * @return Exercise[]
     */
    public function getPractises(): array
    {
        return $this->practises;
    }

    /**
     * @return int
     */
    public function getPractisesCount(): int
    {
        return count($this->practises);
    }
}