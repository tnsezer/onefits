<?php

namespace Test\Model;

use App\Model\Participant;
use App\Model\ParticipantList;
use PHPUnit\Framework\TestCase;

class ParticipantListTest extends TestCase
{
    /** @var ParticipantList $participantList */
    private $participantList;

    public function setUp(): void
    {
        $this->participantList = new ParticipantList();
    }

    public function testAdd()
    {
        $this->assertCount(0, $this->participantList->getIterator());
        $this->participantList->add(new Participant('Test', false));
        $this->participantList->add(new Participant('Test', false));
        $this->assertCount(2, $this->participantList->getIterator());
    }

    public function testGetIterator()
    {
        $this->assertEquals([], $this->participantList->getIterator());
        $participant = new Participant('Test', false);
        $this->participantList->add($participant);
        $this->assertEquals([$participant], $this->participantList->getIterator());
    }
}