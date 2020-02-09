<?php

namespace Test\Model;

use App\Model\Program;
use PHPUnit\Framework\TestCase;
use Test\ModelGenerator;

class ProgramTest extends TestCase
{
    use ModelGenerator;

    /** @var Program $program */
    private $program;

    public function setUp(): void
    {
        $this->program = $this->getProgramInstance(true);
    }

    public function testGetBreak()
    {
        $this->assertEquals(4, $this->program->getBreak());
        $program = $this->getProgramInstance(false);
        $this->assertEquals(2, $program->getBreak());
    }

    public function testAddPractise()
    {
        $this->program->addPractise($this->createExercise('TEST1'));
        $this->assertEquals('TEST1', end($this->program->getPractises()));
        $this->program->addPractise($this->createExercise('TEST2'));
        $this->assertEquals('TEST2', end($this->program->getPractises()));
    }

    public function testGetPractise()
    {
        $this->program->addPractise($this->createExercise('TEST1'));
        $this->assertEquals('TEST1', $this->program->getPractise(0));
    }

    public function testGetPractises()
    {
        $this->assertCount(0, $this->program->getPractises());
        $this->program->addPractise($this->createExercise('TEST1'));
        $this->program->addPractise($this->createExercise('TEST2'));
        $this->assertCount(2, $this->program->getPractises());
    }

    public function testGetPractisesCount()
    {
        $this->assertEquals(0, $this->program->getPractisesCount());
        $this->program->addPractise($this->createExercise('TEST1'));
        $this->program->addPractise($this->createExercise('TEST2'));
        $this->assertEquals(2, $this->program->getPractisesCount());
    }

    /**
     * @param bool $isBeginner
     * @return Program
     */
    private function getProgramInstance(bool $isBeginner): Program
    {
        return new Program($isBeginner);
    }
}