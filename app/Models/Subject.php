<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function comments(){
        return $this->morphMany('App\Models\Comment', 'commentable')->latest();
    }
}
