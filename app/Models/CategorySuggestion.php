<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorySuggestion extends Model
{
    protected $table = "categories_suggestion";
    protected $fillable = ['*'];
    public $timestamps = false;
}
