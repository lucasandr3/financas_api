<?php

namespace App\Http\Interfaces\Services;

interface LendingsServiceInterface
{
    public function allLendings();

    public function getLending(int $lending);

    public function getInstallments(int $lending);

    public function newLending(object $request);
}
