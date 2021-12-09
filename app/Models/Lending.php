<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lending extends Model
{
    protected $table = "lendings";
    protected $fillable = ['*'];
    public $timestamps = false;
}
