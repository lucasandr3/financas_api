<?php

namespace App\Http\Controllers\Modules\Reports;

use App\Http\Controllers\Controller;
use App\Http\Interfaces\Services\Modules\Reports\ReportsServiceInterface;
use Illuminate\Http\Request;
use PDF;

class ReportsController extends Controller
{
    private $service;

    public function __construct
    (
        ReportsServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function receipts()
    {
        $html = '<html><body>'
            . '<p>Put your html here, or generate it with your favourite '
            . 'templating system.</p>'
            . '</body></html>';

//        return PDF::load($html, 'A4', 'portrait')->show();
        return PDF::load($html, 'A4', 'portrait')->download('my_pdf');
//        $pdf = PDF::load($html, 'A4', 'portrait')->output();
//        return view('report', []);
        //return $this->service->allReceitps();
    }

    public function cardById(Request $request, int $card)
    {
        return $this->service->getCard($card);
    }

    public function cardExpenses(Request $request, int $card)
    {
        return $this->service->getExpenses($card);
    }

    public function newCard(Request $request)
    {
        return $this->service->newCard($request);
    }

    public function editCard(Request $request, int $card)
    {
        return $this->service->editCard($request, $card);
    }
}
