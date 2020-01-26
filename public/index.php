<?php

require_once '../bootstrap.php';

use App\Model\Participant;
use App\Service\Wod;

$participants[] = new Participant('Camille', false);
$participants[] = new Participant('Michael', false);
$participants[] = new Participant('Tom', true);
$participants[] = new Participant('Tim', false);
$participants[] = new Participant('Erik', false);
$participants[] = new Participant('Lars', false);
$participants[] = new Participant('Mathijs', true);

$wod = new Wod($participants);

echo 'Starting the workout with ' . implode(', ', $participants);
echo '<br>';

$wod->output();