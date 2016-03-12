<?php

namespace SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\Actor;
use SelrahcD\ActorRight\Actors\System1;
use SelrahcD\ActorRight\Actors\System2;

final class Human extends Actor
{
    use EventTestHelper;

    private $events = [];

    private function __construct()
    {
    }

    public static function register($id)
    {
        $newHuman = new self;

        $newHuman->events[] = new HumanIsRegistered($id);

        return $newHuman;
    }

    public static function registerAdmin($id)
    {
        $newHuman = self::register($id);
        $newHuman->events[] = new WasPromotedToAdmin(new self);

        return $newHuman;
    }


    private function id()
    {
        $registrationEvent = $this->lastEventOfType(HumanIsRegistered::class, $this->events);

        return $registrationEvent->id();
    }

    public function changeName($newName, Actor $actor)
    {
        if(
            ($actor->isNotOfType(Human::class) && Actor::ofType(Human::class)->caused(NameWasChanged::class, $this->events)) ||
            ($actor->is(new System2()) && (new System1())->caused(NameWasChanged::class, $this->events))
        )
        {
            return;
        }

        $this->events[] = new NameWasChanged($newName, $actor);
    }

    public function changeAge($newAge, Actor $actor)
    {
        if($actor->caused(AgeWasChanged::class, $this->events))
        {
            return;
        }

        $this->events[] = new AgeWasChanged($newAge, $actor);
    }

    public function releaseEvents()
    {
        return $this->events;
    }

    public function bePromotedToAdmin(Human $actor)
    {
        if(!$actor->isAdmin())
        {
            return;
        }

        $this->events[] = new WasPromotedToAdmin($actor);
    }

    public function beDemotedFromAdmin(Human $actor)
    {
        if(!$actor->isAdmin() ||
           !$this->isAdmin() ||
            $this->is($actor))
        {
            return;
        }

        $this->events[] = new WasDemotedFromAdmin($actor);
    }

    public function isAdmin()
    {
        return !empty($this->lastEventOfType(WasPromotedToAdmin::class, $this->events));
    }

    public function is(Actor $actor)
    {
        return $actor instanceof Human && $this->id() == $actor->id();
    }
}