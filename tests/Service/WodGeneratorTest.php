<?php

namespace Test\Service;

use App\Model\Participant;
use App\Model\ParticipantList;
use PHPUnit\Framework\TestCase;
use App\Service\WodGenerator;

class WodGeneratorTest extends TestCase
{
    private $wod;

    public function setUp(): void
    {
        $participantList = new ParticipantList();
        $participantList->add(new Participant('Michael', false));
        $participantList->add(new Participant('Roy', true));
        $this->wod = new WodGenerator($participantList);
    }

    public function testGetExerciseLimit()
    {
        $this->assertEquals(30, $this->wod->getExerciseLimit());
    }

    public function testGetParticipantAndExercise()
    {
        $this->assertCount(2, $this->wod->getParticipantAndExercise(0));
    }
}