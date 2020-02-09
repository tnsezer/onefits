<?php


namespace App\Model\Exercises;


class Ring implements Exercise
{
    public function getCode(): string
    {
        return 'R002';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Rings';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}