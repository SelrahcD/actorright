<?php

namespace SelrahcD\ActorRight\Actors;

final class TypeComparator
{
    private $type;

    /**
     * TypeComparator constructor.
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    public function caused($eventType, $events)
    {
        return !empty(array_filter($events, function ($event) use ($eventType) {
            return $event instanceof $eventType && get_class($event->actor()) === $this->type;
        }));
    }
}