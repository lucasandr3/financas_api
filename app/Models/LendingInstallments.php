<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LendingInstallments extends Model
{
    protected $table = "lending_installments";
    protected $fillable = ['*'];
    public $timestamps = false;
}
