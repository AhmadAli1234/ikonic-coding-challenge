<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Request extends Model
{
    use HasFactory, SoftDeletes;
    
    public $fillable = ['sender_id', 'receiver_id', 'status'];

    public function sender(){
       return $this->belongsTo(User::Class,'sender_id','id');
    }

    public function receiver(){
       return $this->belongsTo(User::Class,'receiver_id','id');
    }
}
