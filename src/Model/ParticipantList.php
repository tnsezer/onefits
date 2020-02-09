<?php

namespace App\Model;

class ParticipantList implements \IteratorAggregate
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
     * @inheritDoc
     */
    public function getIterator(): array
    {
        return $this->participants->getArrayCopy();
    }
}