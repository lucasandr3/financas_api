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

    public function modulos()
    {
        return $this->service->modulos();
    }

    public function paginas()
    {
        return $this->service->paginas();
    }

    public function alunos()
    {
        return $this->service->alunos();
    }

    public function progresso()
    {
        return $this->service->progresso();
    }
}
