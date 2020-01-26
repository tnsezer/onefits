<?php

namespace  App\Model;

class Participant
{
    /** @var string $name */
    private $name;

    /** @var bool $isBeginner */
    private $isBeginner;

    /** @var Program $program */
    private $program;

    /**
     * Participant constructor.
     * @param string $name
     * @param bool $isBeginner
     */
    public function __construct(string $name, bool $isBeginner)
    {
        $this->name = $name;
        $this->isBeginner = $isBeginner;
        $this->program = new Program();
        $this->program->setBreak($isBeginner ? 4 : 2);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isBeginner(): bool
    {
        return $this->isBeginner;
    }

    /**
     * @return Program
     */
    public function getProgram(): Program
    {
        return $this->program;
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->name . ' ' . ($this->isBeginner() ? '(beginner)' : '');
    }
}