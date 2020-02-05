<?php

namespace Test\Model;

use App\Model\Program;
use PHPUnit\Framework\TestCase;

class ProgramTest extends TestCase
{
    /** @var Program $program */
    private $program;

    public function setUp(): void
    {
        $this->program = new Program(true);
    }

    public function testGetBreak()
    {
        $this->assertEquals(Program::BEGINNER_BREAK, $this->program->getBreak());
        $program = $this->getProgramInstance(false);
        $this->assertEquals(Program::PROFESSIONAL_BREAK, $program->getBreak());
    }

    public function testAddPractise()
    {
        $this->program->addPractise('TEST1');
        $this->assertEquals('TEST1', end($this->program->getPractises()));
        $this->program->addPractise('TEST2');
        $this->assertEquals('TEST2', end($this->program->getPractises()));
    }

    public function testGetPractise()
    {
        $this->program->addPractise('TEST1');
        $this->assertEquals('TEST1', $this->program->getPractise(0));
    }

    public function testGetPractises()
    {
        $this->assertCount(0, $this->program->getPractises());
        $this->program->addPractise('TEST1');
        $this->program->addPractise('TEST2');
        $this->assertCount(2, $this->program->getPractises());
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