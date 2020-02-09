<?php


namespace App\Model\Conditions;


use App\Model\Exercises\Exercise;

interface Condition
{
    public function check(Exercise $exercise): bool;
}