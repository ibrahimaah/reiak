<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['content','vote_id'];
    public function chooses(){
        return $this->hasMany(Choise::class,'question_id');
    }
    public function results(){
        return $this->hasMany(Result::class,'question_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
