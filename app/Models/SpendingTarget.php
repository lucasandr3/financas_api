<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpendingTarget extends Model
{
    protected $table = "spending_target";
    protected $fillable = ['*'];
    public $timestamps = false;
}
