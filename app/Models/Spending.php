<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    protected $table = "spending";
    protected $fillable = ['*'];
    public $timestamps = false;
}
