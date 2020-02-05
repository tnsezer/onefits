<?php

namespace Test\Service;

use App\Model\Participant;
use App\Model\Participants;
use PHPUnit\Framework\TestCase;
use App\Service\Wod;

class WodTest extends TestCase
{
    private $wod;

    public function setUp(): void
    {
        $participants = new Participants();
        $participants->add(new Participant('Michael', false));
        $participants->add(new Participant('Roy', true));
        $this->wod = new Wod($participants);
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