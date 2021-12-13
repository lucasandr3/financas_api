<?php

namespace App\Events;


class Registration extends Event
{
    private $user;

    public function __construct($user)
    {
        $this->user = $user;
    }
}
