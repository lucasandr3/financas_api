<?php

namespace App\Http\Controllers\Modules\Hotmart;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Modules\Hotmart\VendaServiceInterface;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    private $service;

    public function __construct
    (
        VendaServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function historicoVendas()
    {
        return $this->service->historicoVendas();
    }

    public function sumarioVendas()
    {
        return $this->service->sumarioVendas();
    }

    public function participantesVendas()
    {
        return $this->service->participantesVendas();
    }

    public function comissaoVendas()
    {
        return $this->service->comissaoVendas();
    }

    public function detalhesPrecosVendas()
    {
        return $this->service->detalhesPrecosVendas();
    }
}
