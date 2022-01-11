<?php

namespace App\Http\Interfaces\Services\Modules\Hotmart;

interface VendaServiceInterface
{
    public function historicoVendas();

    public function sumarioVendas();

    public function participantesVendas();

    public function comissaoVendas();

    public function detalhesPrecosVendas();
}
