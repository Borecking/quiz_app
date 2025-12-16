<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['quiz_id', 'content', 'answer_a', 'answer_b', 'answer_c', 'answer_d', 'correct_answer'];
}