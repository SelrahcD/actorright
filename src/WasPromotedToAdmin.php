<?php

namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;

final class WasPromotedToAdmin implements ActorTriggeredEvent
{
    /**
     * @var Actor
     */
    private $actor;

    /**
     * WasPromotedToAdmin constructor.
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