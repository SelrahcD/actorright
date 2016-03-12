<?php

namespace tests\acceptance\SelrahcD\ActorRight;


use SelrahcD\ActorRight\EventTestHelper;
use SelrahcD\ActorRight\Human;
use SelrahcD\ActorRight\WasDemotedFromAdmin;
use SelrahcD\ActorRight\WasPromotedToAdmin;

class AdminCanPromoteHumanToAdminFeature extends \PHPUnit_Framework_TestCase
{
    use EventTestHelper;

    /**
     * @test
     */
    public function an_admin_can_promote_a_human_to_be_an_admin_too()
    {
        $human = Human::register(2);
        $admin = Human::registerAdmin(1);
        $human->bePromotedToAdmin($admin);
        $this->assertNotEmpty(
            $this->lastEventOfType(WasPromotedToAdmin::class, $human->releaseEvents())
        );
    }

    /**
     * @test
     */
    public function an_non_admin_cant_promote_a_human_to_be_an_admin()
    {
        $human = Human::register(1);
        $otherUser = Human::register(2);
        $human->bePromotedToAdmin($otherUser);
        $this->assertEmpty(
            $this->lastEventOfType(WasPromotedToAdmin::class, $human->releaseEvents())
        );
    }

    /**
     * @test
     */
    public function an_admin_can_demote_an_other_admin()
    {
        $admin = Human::registerAdmin(1);
        $otherAdmin = Human::registerAdmin(2);
        $otherAdmin->beDemotedFromAdmin($admin);
        $this->assertNotEmpty(
            $this->lastEventOfType(WasDemotedFromAdmin::class, $otherAdmin->releaseEvents())
        );
    }

    /**
     * @test
     */
    public function a_non_admin_cannot_be_demoted()
    {
        $admin = Human::registerAdmin(1);
        $nonAdmin = Human::register(2);
        $nonAdmin->beDemotedFromAdmin($admin);
        $this->assertEmpty(
            $this->lastEventOfType(WasDemotedFromAdmin::class, $nonAdmin->releaseEvents())
        );
    }

    /**
     * @test
     */
    public function an_admin_cant_demote_itself_from_being_admin()
    {
        $admin = Human::registerAdmin(1);
        $admin->beDemotedFromAdmin($admin);
        $this->assertEmpty(
            $this->lastEventOfType(WasDemotedFromAdmin::class, $admin->releaseEvents())
        );
    }
}
