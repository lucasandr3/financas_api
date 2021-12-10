<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\Services\SuggestionServiceInterface;
use Illuminate\Http\Request;

class SuggestionController extends Controller
{
    private $service;

    public function __construct
    (
        SuggestionServiceInterface $service
    )
    {
        $this->service = $service;
    }

    public function mySuggestions()
    {
        return $this->service->allSuggestions();
    }

    public function suggestionById(Request $request, int $suggestion)
    {
        return $this->service->getSuggestion($suggestion);
    }

    public function newSuggestion(Request $request)
    {
        return $this->service->newSuggestion($request);
    }
}
