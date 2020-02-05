<?php

namespace  App\Model;

class Program
{
    public const PROFESSIONAL_BREAK = 2;
    public const BEGINNER_BREAK = 4;

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
        $this->setBreak($isBeginner ? self::BEGINNER_BREAK : self::PROFESSIONAL_BREAK);
    }

    /**
     * @param int $break
     */
    private function setBreak(int $break): void
    {
        $this->break = $break;
    }

    /**
     * @return int
     */
    public function getBreak(): int
    {
        return $this->break;
    }

    /**
     * @param string $code
     */
    public function addPractise(string $code): void
    {
        $this->practises[] = $code;
    }

    /**
     * @param int $line
     * @return string
     */
    public function getPractise(int $line): string
    {
        return $this->practises[$line];
    }

    /**
     * @return array
     */
    public function getPractises(): array
    {
        return $this->practises;
    }
}