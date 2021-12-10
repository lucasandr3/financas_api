<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suggestion extends Model
{
    protected $table = "suggestions";
    protected $fillable = ['*'];
    public $timestamps = false;
}
