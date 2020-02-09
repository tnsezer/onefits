<?php


namespace App\Model\Exercises;


class ShortSprint implements Exercise
{
    public function getCode(): string
    {
        return 'C002';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Short sprints';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}