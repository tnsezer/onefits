<?php

namespace Test\Model;

use App\Model\Participant;
use App\Model\Participants;
use PHPUnit\Framework\TestCase;

class ParticipantsTest extends TestCase
{
    /** @var Participants $participants */
    private $participants;

    public function setUp(): void
    {
        $this->participants = new Participants();
    }

    public function testAdd()
    {
        $this->assertCount(0, $this->participants->getIterator());
        $this->participants->add(new Participant('Test', false));
        $this->participants->add(new Participant('Test', false));
        $this->assertCount(2, $this->participants->getIterator());
    }

    public function testGetParticipants()
    {
        $this->assertEquals([], $this->participants->getParticipants());
        $participant = new Participant('Test', false);
        $this->participants->add($participant);
        $this->assertEquals([$participant], $this->participants->getParticipants());
    }

    public function testGetIterator()
    {
        $this->assertInstanceOf(\ArrayIterator::class, $this->participants->getIterator());
    }
}