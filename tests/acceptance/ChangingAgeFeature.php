<?php

namespace tests\acceptance\SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\System1;
use SelrahcD\ActorRight\AgeWasChanged;
use SelrahcD\ActorRight\EventTestHelper;
use SelrahcD\ActorRight\Human;

class ChangingAgeFeature extends \PHPUnit_Framework_TestCase
{
    use EventTestHelper;

    /**
     * @test
     */
    public function an_actor_can_change_age_only_once()
    {
        $user = Human::register(1);
        $user->changeAge(12, new System1());
        $user->changeAge(15, Human::register(1));
        $user->changeAge(17, new System1());
        $user->changeName(12, Human::register(1));
        $this->assertEquals(
            15,
            $this->lastEventOfType(AgeWasChanged::class, $user->releaseEvents())->age()
        );
    }
}
