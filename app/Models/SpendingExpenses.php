<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpendingExpenses extends Model
{
    protected $table = "spending_expenses";
    protected $fillable = ['*'];
    public $timestamps = false;
}
