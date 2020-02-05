<?php

require_once '../bootstrap.php';

use App\Model\Participant;
use App\Model\Participants;
use App\Service\Wod;

$participants = new Participants();
$participants->add(new Participant('Camille', false));
$participants->add(new Participant('Michael', false));
$participants->add(new Participant('Tom', true));
$participants->add(new Participant('Tim', false));
$participants->add(new Participant('Erik', false));
$participants->add(new Participant('Lars', false));
$participants->add(new Participant('Mathijs', true));

$wod = new Wod($participants);

echo 'Starting the workout with ' . implode(', ', $participants->getParticipants());
echo '<br>';
for ($i=0; $i<$wod->getExerciseLimit(); $i++) {
    echo sprintf('%02d:00 - %02d:00 - ', $i, $i+1);
    /**
     * @var Participant $participant
     * @var string $exercise
     */
    foreach ($wod->getParticipantAndExercise($i) as $participant => $exercise) {
        echo sprintf('%1$s will do %2$s, ', $participant->getName(), $exercise);
    }
    echo '<br>';
}