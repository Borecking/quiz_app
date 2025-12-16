<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'code'];

    //quiz ma wiele pytan
    public function questions() {
        return $this->hasMany(Question::class);
    }

    //wielu userow jest przypisanych do danego quizu
    public function users() {
        return $this->belongsToMany(User::class, 'quiz_user')->withPivot('score');
    }
}
