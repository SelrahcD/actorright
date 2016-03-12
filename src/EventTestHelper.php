<?php
namespace SelrahcD\ActorRight;

trait EventTestHelper
{
    private function lastEventOfType($eventType, $events)
    {
        $filteredEvents = array_filter($events, function ($event) use ($eventType) {
            return $event instanceof $eventType;
        });

        return end($filteredEvents);
    }
}