<?php


namespace App\Model;


use App\Model\Exercises\BackSquat;
use App\Model\Exercises\Exercise;
use App\Model\Exercises\FrontSquat;
use App\Model\Exercises\HandStand;
use App\Model\Exercises\JumpingJack;
use App\Model\Exercises\JumpingRope;
use App\Model\Exercises\PullUp;
use App\Model\Exercises\PushUp;
use App\Model\Exercises\Ring;
use App\Model\Exercises\ShortSprint;

class ExerciseList
{
    /** @var Exercise[] $exerciseList  */
    private $exerciseList = [];

    public function __construct()
    {
        $this->append(new BackSquat());
        $this->append(new FrontSquat());
        $this->append(new HandStand());
        $this->append(new JumpingJack());
        $this->append(new JumpingRope());
        $this->append(new PullUp());
        $this->append(new PushUp());
        $this->append(new Ring());
        $this->append(new ShortSprint());
    }

    public function append(Exercise $exercise): void
    {
        $this->exerciseList[$exercise->getCode()] = $exercise;
    }

    /**
     * @return Exercise
     */
    public function getRandomExercise(): Exercise
    {
        return $this->exerciseList[array_rand($this->exerciseList)];
    }
}