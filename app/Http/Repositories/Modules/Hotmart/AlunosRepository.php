<?php

namespace App\Http\Repositories\Modules\Hotmart;

use App\Helpers\ApiServiceHotmart;
use App\Http\Interfaces\Repositories\Modules\Hotmart\AlunosRepositoryInterface;
use Illuminate\Support\Facades\DB;

class AlunosRepository implements AlunosRepositoryInterface
{
    private $api;

    public function __construct(ApiServiceHotmart $api)
    {
        $this->api = $api;
    }

    public function getModulos($subDomain)
    {
        $retorno = $this->api->get('/modules?subdomain='.$subDomain.'&is_extra=true');

        if(isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }

    public function getPaginas($modulo)
    {
        $retorno = $this->api->get('/modules/'.$modulo.'/pages');

        if(isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }

    public function getAlunos($subDomain)
    {
        $retorno = $this->api->get('/users?subdomain='.$subDomain.'');

        if(isset($retorno->code)) {
            return $retorno;
        }
        return json_decode($retorno);
    }

    public function getProgresso($aluno, $subDomain)
    {
        $retorno = $this->api->get('/users/'.$aluno.'/lessons?subdomain='.$subDomain.'');

        if(isset($retorno->code)) {
            return $retorno;
        }

        return json_decode($retorno);
    }
}
