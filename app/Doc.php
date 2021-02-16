<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doc extends Model
{
    protected $fillable = ['domain', 'file'];
    public $timestamps = ['created_at', 'updated_at'];
}
