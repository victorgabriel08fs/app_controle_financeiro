<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taxa extends Model
{
    use HasFactory;
    protected $fillable = ['taxa', 'user_id', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
