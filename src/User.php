<?php

namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;
use SelrahcD\ActorRight\Actors\Human;
use SelrahcD\ActorRight\Actors\System1;
use SelrahcD\ActorRight\Actors\System2;

final class User
{
    private $events = [];

    public function changeName($newName, Actor $actor)
    {
        if(
            ($actor->isNot(new Human()) && (new Human())->caused(NameWasChanged::class, $this->events)) ||
            ($actor->is(new System2()) && (new System1())->caused(NameWasChanged::class, $this->events))
        )
        {
            return;
        }

        $this->events[] = new NameWasChanged($newName, $actor);
    }

    public function changeAge($newAge, Actor $actor)
    {
        if($actor->caused(AgeWasChanged::class, $this->events))
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