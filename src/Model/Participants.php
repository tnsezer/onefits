<?php

namespace App\Model;

class Participants implements \IteratorAggregate
{
    /** @var \ArrayIterator $participants */
    private $participants;

    /**
     * Participants constructor.
     */
    public function __construct()
    {
        $this->participants = new \ArrayIterator();
    }

    /**
     * @param Participant $participant
     */
    public function add(Participant $participant): void
    {
        $this->participants->append($participant);
    }

    /**
     * @return array
     */
    public function getParticipants(): array
    {
        return $this->participants->getArrayCopy();
    }

    /**
     * @inheritDoc
     */
    public function getIterator()
    {
        return $this->participants;
    }
}