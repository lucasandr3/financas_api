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

        if(isset($assinaturas->code)) {
            return ['message' => 'Serviço Hotmart em Manutenção e/ou fora do ar', 'code' => 404];
        }

        $items = $assinaturas->items;

        $items = array_map(function($item) {
            $item->price->value = Helpers::formatMoney($item->price->value);
            $item->status = Helpers::statusHotmart($item->status);
            $item->accession_date = Helpers::formataHoraMilesegundos($item->accession_date);
            $item->request_date = Helpers::formataHoraMilesegundos($item->request_date);
            return $item;
        }, $items);

        return $items;
    }

    public function comprasAssinantes($assinante)
    {
        $compras = $this->repository->getComprasAssinantes($assinante);

        if(isset($compras->code)) {
            return ['message' => 'Serviço Hotmart em Manutenção e/ou fora do ar', 'code' => 404];
        }

        if (is_array($compras)) {
            $compras = array_map(function ($compra) {
                $compra->purchase_subscription = ($compra->purchase_subscription == 1) ? 'Assinatura' : 'Produto';
                $compra->price->value = Helpers::formatMoney($compra->price->value);
                $compra->approved_date = Helpers::formataHoraMilesegundos($compra->approved_date);
                $compra->payment_type = Helpers::tipoPagamento($compra->payment_type);
                $compra->payment_method = Helpers::tipoMetodoPagamento($compra->payment_method);
                $compra->under_warranty = ($compra->under_warranty == true) ? 'Dentro da Garantia' : 'Fora da Garantia';
                $compra->status = Helpers::statusCompra($compra->status);
                return $compra;
            }, $compras);

            return [$compras];
        }

        /** Caso não seja array formata os dados do objeto */
        $compras->purchase_subscription = ($compras->purchase_subscription == 1) ? 'Assinatura' : 'Produto';
        $compras->price->value = Helpers::formatMoney($compras->price->value);
        $compras->approved_date = Helpers::formataHoraMilesegundos($compras->approved_date);
        $compras->payment_type = Helpers::tipoPagamento($compras->payment_type);
        $compras->payment_method = Helpers::tipoMetodoPagamento($compras->payment_method);
        $compras->under_warranty = ($compras->under_warranty == true) ? 'Dentro da Garantia' : 'Fora da Garantia';
        $compras->status = Helpers::statusCompra($compras->status);

        return [$compras];
    }

    public function cancelarAssinatura($assinante)
    {
        $retorno = $this->repository->cancelarAssinaturaUpdate($assinante);
        echo "<pre>";
        var_dump($retorno);
        echo "</pre>";
        die;
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
