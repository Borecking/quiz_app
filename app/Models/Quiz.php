<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'code'];

    // Relacja: Quiz ma wiele pytań
    public function questions() {
        return $this->hasMany(Question::class);
    }

    // Relacja: Quiz ma wielu użytkowników (którzy dołączyli)
    public function users() {
        return $this->belongsToMany(User::class, 'quiz_user')->withPivot('score');
    }
}
