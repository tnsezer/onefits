<?php


namespace App\Model\Exercises;


interface Exercise
{
    public function getCode(): string;
    public function getGroupCode(): string;
    public function getDescription(): string;
}