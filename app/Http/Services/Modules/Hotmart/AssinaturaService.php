<?php

namespace App\Http\Services\Modules\Hotmart;

use App\Helpers\Helpers;
use App\Http\Interfaces\Repositories\Modules\Hotmart\AssinaturaRepositoryInterface;
use App\Http\Interfaces\Services\Modules\Hotmart\AssinaturaServiceInterface;
use Illuminate\Support\Facades\Validator;

class AssinaturaService implements AssinaturaServiceInterface
{
    private $repository;

    public function __construct
    (
        AssinaturaRepositoryInterface $repository
    )
    {
        $this->repository = $repository;
    }

    public function assinaturas()
    {
        $assinaturas = $this->repository->getAssinaturas();

        $items = $assinaturas->items;

        $items = array_map(function($item) {
            $item->price->value = Helpers::formatMoney($item->price->value);
            $item->status = Helpers::statusHotmart($item->status);
            $item->accession_date = Helpers::formataHoraMilesegundos($item->accession_date);
            $item->request_date = Helpers::formataHoraMilesegundos($item->request_date);
            echo "<pre>";
            var_dump($item);
            echo "</pre>";
            die;
            return $item;
        }, $items);

        return $assinaturas->items;
    }

    public function comprasAssinantes()
    {
        $compras = $this->repository->getComprasAssinantes();
    }

    public function cancelarAssinatura()
    {
        // TODO: Implement cancelarAssinatura() method.
    }

    public function cancelarListaAssinaturas()
    {
        // TODO: Implement cancelarListaAssinaturas() method.
    }

    public function reativarCobrarAssinatura()
    {
        // TODO: Implement reativarCobrarAssinatura() method.
    }

    public function reativarCobrarListaAssinatura()
    {
        // TODO: Implement reativarCobrarListaAssinatura() method.
    }

    public function alterarDiaCobranca()
    {
        // TODO: Implement alterarDiaCobranca() method.
    }
}
