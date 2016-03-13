<?php

namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;

final class AgeWasChanged implements ActorTriggeredEvent
{
    /**
     * @var
     */
    private $age;

    /**
     * @var Actor
     */
    private $actor;

    /**
     * AgeWasChanged constructor.
     * @param $age
     * @param Actor $actor
     */
    public function __construct($age, Actor $actor)
    {
        $this->age = $age;
        $this->actor = $actor;
    }

    public function age()
    {
        return $this->age;
    }

    public function actor()
    {
        return $this->actor;
    }
}