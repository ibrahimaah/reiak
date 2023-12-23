<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Result extends Model
{
    use HasFactory;
    protected $fillable = ['ip','survey_id','question_id','city','answer_id','content'];
    public function questions(){
        return $this->belongsTo(Result::class,'question_id');
    }
}
