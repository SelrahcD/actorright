<?php
namespace SelrahcD\ActorRight\Actors;

abstract class Actor
{
    public function caused($eventType, $events)
    {
        return !empty(array_filter($events, function ($event) use ($eventType) {
            return $event instanceof $eventType && $event->wasCausedBy($this);
        }));
    }

    public function is(Actor $actor)
    {
        return $this == $actor;
    }

    public function isNot(Actor $actor)
    {
        return $actor != $this;
    }
}