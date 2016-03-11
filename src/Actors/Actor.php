<?php
namespace SelrahcD\ActorRight\Actors;

abstract class Actor
{
    public function madeAction($eventType, $events)
    {
        return !empty(array_filter($events, function ($event) use ($eventType) {
            return $event instanceof $eventType && $event->wasMadeBy($this);
        }));
    }
}