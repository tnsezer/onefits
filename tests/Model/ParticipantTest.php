<?php

namespace Test\Model;

use App\Model\Participant;
use App\Model\Program;
use PHPUnit\Framework\TestCase;

class ParticipantTest extends TestCase
{
    /** @var Participant $participant */
    private $participant;

    public function setUp(): void
    {
        $this->participant = new Participant('Test', true);
    }

    public function testGetName()
    {
        $this->assertEquals('Test', $this->participant->getName());
    }

    public function testIsBeginner()
    {
        $this->assertTrue($this->participant->isBeginner());
        $participant = $this->getParticipantInstance('Test', false);
        $this->assertFalse($participant->isBeginner());
    }

    public function testGetProgram()
    {
        $this->assertInstanceOf(Program::class, $this->participant->getProgram());
    }

    /**
     * @param string $name
     * @param bool $isBeginner
     * @return Participant
     */
    private function getParticipantInstance(string $name, bool $isBeginner): Participant
    {
        return new Participant($name, $isBeginner);
    }
}