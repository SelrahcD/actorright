<?php

namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;

final class NameWasChanged implements ActorTriggeredEvent
{
    private $name;

    /**
     * NameChange constructor.
     * @param $newName
     * @param $actor
     */
    public function __construct($newName, Actor $actor)
    {
        $this->name = $newName;
        $this->actor = $actor;
    }

    public function name()
    {
        return $this->name;
    }

    public function actor()
    {
        return $this->actor;
    }
}