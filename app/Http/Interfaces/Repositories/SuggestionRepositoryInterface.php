<?php

namespace App\Http\Interfaces\Repositories;

interface SuggestionRepositoryInterface
{
    public function allSuggestions(int $user);

    public function getSuggestion(int $suggestion);

    public function saveSuggestion(object $request);
}
