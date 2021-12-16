<?php

namespace App\Http\Interfaces\Services;

interface SpendingTargetServiceInterface
{
    public function allSpendingsTargets();

    public function getSpendingTarget(int $spending);

    public function newSpendingTarget(object $resquest);
}
