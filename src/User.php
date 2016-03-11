<?php

namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;
use SelrahcD\ActorRight\Actors\Human;
use SelrahcD\ActorRight\Actors\System1;

final class User
{
    private $events = [];

    public function changeName($newName, Actor $actor)
    {
        if($actor != new Human && (new System1())->madeAction(NameWasChanged::class, $this->events))
        {
            return;
        }

        $this->events[] = new NameWasChanged($newName, $actor);
    }

    public function changeAge($newAge, Actor $actor)
    {
        if($actor->madeAction(AgeWasChanged::class, $this->events))
        {
            return;
        }

        $this->events[] = new AgeWasChanged($newAge, $actor);
    }

    public function releaseEvents()
    {
        return $this->events;
    }
}