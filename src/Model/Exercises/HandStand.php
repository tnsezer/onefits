<?php


namespace App\Model\Exercises;


class HandStand implements Exercise
{
    public function getCode(): string
    {
        return 'H001';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Handstand practice';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}