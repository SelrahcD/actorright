<?php

namespace SelrahcD\ActorRight\Actors;

final class TypeComparator
{
    use TestOnEventsStream;

    private $type;

    /**
     * TypeComparator constructor.
     * @param $type
     */
    public function __construct($type)
    {
        $this->type = $type;
    }

    private function actorTest($actor)
    {
        return get_class($actor) === $this->type;
    }
}