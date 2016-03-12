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

    public function wasCausedBy(Actor $actor)
    {
        return $this->actor->is($actor);
    }

    public function wasCausedByActorOfType($type)
    {
        return $this->actor->isOfType($type);
    }
}