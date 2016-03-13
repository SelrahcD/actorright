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

    public function actor()
    {
        return $this->actor;
    }
}