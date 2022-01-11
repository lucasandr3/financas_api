<?php

namespace App\Http\Services\Modules\Hotmart;

use App\Http\Interfaces\Repositories\Modules\Hotmart\VendaRepositoryInterface;
use App\Http\Interfaces\Services\Modules\Hotmart\VendaServiceInterface;
use Illuminate\Support\Facades\Validator;

class VendaService implements VendaServiceInterface
{
    private $repository;

    public function __construct
    (
        VendaRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function historicoVendas()
    {
        // TODO: Implement historicoVendas() method.
    }

    public function sumarioVendas()
    {
        // TODO: Implement sumarioVendas() method.
    }

    public function participantesVendas()
    {
        // TODO: Implement participantesVendas() method.
    }

    public function comissaoVendas()
    {
        // TODO: Implement comissaoVendas() method.
    }

    public function detalhesPrecosVendas()
    {
        // TODO: Implement detalhesPrecosVendas() method.
    }
}
