<?php
namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;

interface ActorTriggeredEvent
{
    public function wasCausedBy(Actor $actor);

    public function wasCausedByActorOfType($type);
}