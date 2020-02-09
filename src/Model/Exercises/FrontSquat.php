<?php


namespace App\Model\Exercises;


class FrontSquat implements Exercise
{
    public function getCode(): string
    {
        return 'S001';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Front squats';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}