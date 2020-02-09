<?php


namespace App\Model\Exercises;


class PushUp implements Exercise
{
    public function getCode(): string
    {
        return 'P001';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Push ups';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}