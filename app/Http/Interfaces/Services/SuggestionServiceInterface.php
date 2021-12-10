<?php

namespace App\Http\Interfaces\Services;

interface SuggestionServiceInterface
{
    public function allSuggestions();

    public function getSuggestion(int $suggestion);

    public function newSuggestion(object $resquest);
}
