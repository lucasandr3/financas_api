<?php

namespace App\Listeners;

use App\Events\Registration;

class RegistrationListener
{
    public function __construct()
    {
        //
    }

    public function handle(Registration $registration)
    {
        print_r($registration);
        die("aqui");
    }
}
