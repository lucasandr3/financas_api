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
        $vendas = $this->repository->getHistoricoVendas();

        echo "<pre>";
        var_dump($vendas);
        echo "</pre>";
        die;
    }

    public function sumarioVendas()
    {
        $sumario = $this->repository->getSumarioVendas();

        echo "<pre>";
        var_dump($sumario);
        echo "</pre>";
        die;
    }

    public function participantesVendas()
    {
        $participantes = $this->repository->getParticipantesVendas();

        echo "<pre>";
        var_dump($participantes);
        echo "</pre>";
        die;
    }

    public function comissaoVendas()
    {
        $comissao  = $this->repository->getComissaoVendas();

        echo "<pre>";
        var_dump($comissao);
        echo "</pre>";
        die;
    }

    public function detalhesPrecosVendas()
    {
        $detalhes = $this->repository->getDetalhesPrecosVendas();

        echo "<pre>";
        var_dump($detalhes);
        echo "</pre>";
        die;
    }
}
