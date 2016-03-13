<?php
namespace SelrahcD\ActorRight\Actors;


abstract class Actor
{
    public static function ofType($type)
    {
        return new TypeComparator($type);
    }

    public function caused($eventType, $events)
    {
        return !empty(array_filter($events, function ($event) use ($eventType) {
            return $event instanceof $eventType && $event->actor() == $this;
        }));
    }

    public function is(Actor $actor)
    {
        return $this == $actor;
    }

    public function isNot(Actor $actor)
    {
        return !$this->is($actor);
    }

    public function isOfType($type)
    {
        return get_class($this) === $type;
    }

    public function isNotOfType($type)
    {
        return !$this->isOfType($type);
    }
}