<?php

namespace  App\Model;

class Program
{
    /** @var array $practises */
    private $practises = [];
    /** @var int $break */
    private $break = 2;

    /**
     * Program constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param int $break
     */
    public function setBreak(int $break): void
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
     * @param int $i
     * @return string
     */
    public function getPractise(int $i): string
    {
        return $this->practises[$i];
    }

    /**
     * @return array
     */
    public function getPractises(): array
    {
        return $this->practises;
    }
}