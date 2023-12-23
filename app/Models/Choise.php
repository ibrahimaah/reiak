<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choise extends Model
{
    use HasFactory;
    protected $fillable = ['question_id','content'];
    public function results(){
        return $this->hasMany(Result::class,'answer_id');
    }
}
