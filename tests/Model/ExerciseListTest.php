<?php


namespace Test\Model;

use App\Model\ExerciseList;
use App\Model\Exercises\Exercise;
use PHPUnit\Framework\TestCase;
use Test\ModelGenerator;

class ExerciseListTest extends TestCase
{
    use ModelGenerator;

    /** @var ExerciseList $exerciseList */
    private $exerciseList;

    public function setUp(): void
    {
        $this->exerciseList = new ExerciseList;
    }

    public function testAppend()
    {
        $result = $this->exerciseList->append($this->createExercise('TEST'));
        $this->assertNull($result);
    }

    public function testGetRandomExercise()
    {
        $this->exerciseList->append($this->createExercise('TEST'));
        $this->assertInstanceOf(Exercise::class, $this->exerciseList->getRandomExercise());
    }
}