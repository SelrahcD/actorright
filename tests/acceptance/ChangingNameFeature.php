<?php

namespace tests\acceptance\SelrahcD\ActorRight;

use SelrahcD\ActorRight\Actors\System1;
use SelrahcD\ActorRight\Actors\System2;
use SelrahcD\ActorRight\EventTestHelper;
use SelrahcD\ActorRight\NameWasChanged;
use SelrahcD\ActorRight\Human;

class ChangingNameFeature extends \PHPUnit_Framework_TestCase
{
    use EventTestHelper;

    /**
     * @test
     */
    public function system1_can_change_user_name()
    {
        $human = Human::register(1);
        $human->changeName('Charles', new System1);
        $this->assertEquals(
            'Charles',
            $this->lastEventOfType(NameWasChanged::class, $human->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function system2_can_change_user_name()
    {
        $human = Human::register(1);
        $human->changeName('Roger', new System2);
        $this->assertEquals(
            'Roger',
            $this->lastEventOfType(NameWasChanged::class, $human->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function a_human_can_change_user_name()
    {
        $human = Human::register(1);
        $human->changeName('Charles', Human::register(1));
        $this->assertEquals(
            'Charles',
            $this->lastEventOfType(NameWasChanged::class, $human->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function system2_cannot_change_a_name_set_by_system1()
    {
        $human = Human::register(1);
        $human->changeName('Charles', new System2());
        $human->changeName('Roger', new System1());
        $human->changeName('Paul', new System2());
        $this->assertEquals(
            'Roger',
            $this->lastEventOfType(NameWasChanged::class, $human->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function system1_and_system2_cant_change_a_name_set_by_a_human()
    {
        $human = Human::register(1);
        $human->changeName('Charles', new System2());
        $human->changeName('Roger', new System1());
        $human->changeName('Paul', new System2());
        $human->changeName('Louis', Human::register(1));
        $human->changeName('Alphonse', new System1());
        $human->changeName('Denis', new System2());
        $this->assertEquals(
            'Louis',
            $this->lastEventOfType(NameWasChanged::class, $human->releaseEvents())->name())
        ;
    }

    /**
     * @test
     */
    public function a_human_can_change_a_name_set_by_a_human()
    {
        $human = Human::register(1);
        $human->changeName('Paul', Human::register(1));
        $human->changeName('Alain', Human::register(1));
        $this->assertEquals(
            'Alain',
            $this->lastEventOfType(NameWasChanged::class, $human->releaseEvents())->name()
        );
    }

    /**
     * @test
     */
    public function system1_can_change_a_name_set_by_a_system1()
    {
        $human = Human::register(1);
        $human->changeName('Paul', new System1());
        $human->changeName('Alain', new System1());
        $this->assertEquals(
            'Alain',
            $this->lastEventOfType(NameWasChanged::class, $human->releaseEvents())->name()
        );
    }
}
