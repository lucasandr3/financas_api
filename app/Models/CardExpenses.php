<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardExpenses extends Model
{
    protected $table = "card_expenses";
    protected $fillable = ['*'];
    public $timestamps = false;
}
