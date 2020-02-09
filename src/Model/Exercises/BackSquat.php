<?php


namespace App\Model\Exercises;


class BackSquat implements Exercise
{
    public function getCode(): string
    {
        return 'S002';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Back squats';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}