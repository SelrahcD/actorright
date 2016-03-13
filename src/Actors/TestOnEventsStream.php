<?php
namespace SelrahcD\ActorRight\Actors;

trait TestOnEventsStream
{
    public function caused($eventType, $events)
    {
        return !empty(array_filter($events, function ($event) use ($eventType) {
            return $event instanceof $eventType && $this->actorTest($event->actor());
        }));
    }
}