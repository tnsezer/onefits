<?php


namespace App\Model\Exercises;


class JumpingJack implements Exercise
{
    public function getCode(): string
    {
        return 'C001';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Jumping jacks';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}