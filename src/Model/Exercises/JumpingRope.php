<?php


namespace App\Model\Exercises;


class JumpingRope implements Exercise
{
    public function getCode(): string
    {
        return 'C003';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Jumping rope';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}