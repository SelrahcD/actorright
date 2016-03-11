<?php

namespace tests\acceptance\SelrahcD\ActorRight;


use SelrahcD\ActorRight\Actors\Human;
use SelrahcD\ActorRight\Actors\System1;
use SelrahcD\ActorRight\Actors\System2;
use SelrahcD\ActorRight\NameWasChanged;
use SelrahcD\ActorRight\User;

class ChangingNameFeature extends \PHPUnit_Framework_TestCase
{
    use EventTestHelper;

    /**
     * @test
     */
    public function system1_can_change_user_name()
    {
        $user = new User;
        $user->changeName('Charles', new System1);
        $this->assertEquals(
            'Charles',
            $this->lastEventOfType(NameWasChanged::class, $user->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function system2_can_change_user_name()
    {
        $user = new User;
        $user->changeName('Roger', new System2);
        $this->assertEquals(
            'Roger',
            $this->lastEventOfType(NameWasChanged::class, $user->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function a_human_can_change_user_name()
    {
        $user = new User;
        $user->changeName('Charles', new Human);
        $this->assertEquals(
            'Charles',
            $this->lastEventOfType(NameWasChanged::class, $user->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function system2_cannot_change_a_name_set_by_system1()
    {
        $user = new User();
        $user->changeName('Charles', new System2());
        $user->changeName('Roger', new System1());
        $user->changeName('Paul', new System2());
        $this->assertEquals(
            'Roger',
            $this->lastEventOfType(NameWasChanged::class, $user->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function system1_and_system2_cant_change_a_name_set_by_a_human()
    {
        $user = new User();
        $user->changeName('Charles', new System2());
        $user->changeName('Roger', new System1());
        $user->changeName('Paul', new System2());
        $user->changeName('Louis', new Human());
        $user->changeName('Alphonse', new System1());
        $user->changeName('Denis', new System2());
        $this->assertEquals(
            'Louis',
            $this->lastEventOfType(NameWasChanged::class, $user->releaseEvents())->name())
        ;
    }

    public function a_human_can_change_a_name_set_by_a_human()
    {
        $user = new User();
        $user->changeName('Paul', new Human());
        $user->changeName('Alain', new Human());
        $this->assertEquals(
            'Alain',
            $this->lastEventOfType(NameWasChanged::class, $user->releaseEvents())->name()
        );
    }
}
