<?php
namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;

interface ActorTriggeredEvent
{
    public function wasMadeBy(Actor $actor);
}