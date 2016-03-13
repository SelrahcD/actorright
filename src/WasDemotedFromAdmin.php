<?php

namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;

final class WasDemotedFromAdmin implements ActorTriggeredEvent
{
    /**
     * @var Actor
     */
    private $actor;

    /**
     * WasDemotedFromAdmin constructor.
     * @param Actor $actor
     */
    public function __construct(Actor $actor)
    {
        $this->actor = $actor;
    }

    public function actor()
    {
        return $this->actor;
    }
}