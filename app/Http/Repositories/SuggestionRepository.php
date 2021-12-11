<?php

namespace App\Http\Repositories;

use App\Http\Interfaces\Repositories\SuggestionRepositoryInterface;
use App\Models\Suggestion;
use App\Models\CategorySuggestion;
use Illuminate\Support\Facades\DB;

class SuggestionRepository implements SuggestionRepositoryInterface
{

    public function allSuggestions(int $user)
    {
        return DB::table('suggestions as s')
            ->addSelect('s.id', 's.title', 's.suggestion', 's.date_suggestion')
            ->addSelect('cs.name as category')
            ->addSelect('us.full_name as user')
            ->join('categories_suggestion as cs', 'cs.id', '=', 's.category_suggestion')
            ->join('users as us', 'us.id', '=', 's.user_id')
            ->where('s.user_id', $user)
        ->get()->toArray();
    }

    public function getSuggestion(int $sugestion)
    {
        return DB::table('suggestions')
            ->where('id', $sugestion)
            ->get();
    }

    public function saveSuggestion(object $request)
    {
        try {

            $sugestion = new Suggestion;
            $sugestion->user_id = auth()->user()->getAuthIdentifier();
            $sugestion->category_suggestion = $request->input('category_suggestion');
            $sugestion->title = $request->input('title');
            $sugestion->suggestion = $request->input('suggestion');
            $sugestion->date_suggestion = date('Y-m-d');

            $sugestion->save();
            return response()->json(['user' => $sugestion, 'message' => 'CREATED'], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar sugestão!'], 409);
        }
    }
}
