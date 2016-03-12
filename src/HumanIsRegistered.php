<?php

namespace SelrahcD\ActorRight;

final class HumanIsRegistered
{
    private $humanId;

    /**
     * HumanIsRegistered constructor.
     * @param $humanId
     */
    public function __construct($humanId)
    {
        $this->humanId = $humanId;
    }

    public function id()
    {
        return $this->humanId;
    }
}