<?php

namespace App\Http\Interfaces\Repositories\Modules\Hotmart;

interface VendaRepositoryInterface
{
    public function getHistoricoVendas();

    public function getSumarioVendas();

    public function getParticipantesVendas();

    public function getComissaoVendas();

    public function getDetalhesPrecosVendas();
}
