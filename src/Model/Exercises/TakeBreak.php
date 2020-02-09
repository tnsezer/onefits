<?php


namespace App\Model\Exercises;


class TakeBreak implements Exercise
{
    public function getCode(): string
    {
        return 'BREAK';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Take a break';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}