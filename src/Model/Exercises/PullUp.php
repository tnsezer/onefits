<?php


namespace App\Model\Exercises;


class PullUp implements Exercise
{
    public function getCode(): string
    {
        return 'R001';
    }

    public function getGroupCode(): string
    {
        return substr($this->getCode(), 0, 1);
    }

    public function getDescription(): string
    {
        return 'Pull ups';
    }

    public function __toString()
    {
        return $this->getDescription();
    }
}