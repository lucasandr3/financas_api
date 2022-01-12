<?php

namespace App\Http\Controllers\Modules\Hotmart;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Modules\Hotmart\AlunosServiceInterface;
use Illuminate\Http\Request;

class AlunosController extends Controller
{
    private $service;

    public function __construct
    (
        AlunosServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function modulos($subDomain)
    {
        return $this->service->modulos($subDomain);
    }

    public function paginas($modulo)
    {
        return $this->service->paginas($modulo);
    }

    public function alunos($subDomain)
    {
        return $this->service->alunos($subDomain);
    }

    public function progresso($aluno, $subDomain)
    {
        return $this->service->progresso($aluno, $subDomain);
    }
}
