<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use BeyondCode\Comments\Traits\HasComments;

class Vote extends Model
{
    use HasFactory,HasComments;
    protected $fillable = ['title', 'title_slug', 'status', 'image', 'user_id'];
    public function questions(){
        return $this->hasMany(Question::class,'vote_id');
    }
    public function results(){
        return $this->hasMany(Result::class,'survey_id');
    }
}
