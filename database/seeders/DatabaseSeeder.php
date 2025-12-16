<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Quiz;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        //administrator
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@email.com',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        //zwykly uzytkownik
        User::create([
            'name' => 'Student',
            'email' => 'user@email.com',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        //quiz 1
        $quizGeo = Quiz::create([
            'title' => 'Stolice Europy',
            'code'  => 'EUROPA',
        ]);

        //pytania quiz 1
        $quizGeo->questions()->createMany([
            [
                'content' => 'Stolicą Francji jest:',
                'answer_a' => 'Lyon',
                'answer_b' => 'Paryż',
                'answer_c' => 'Marsylia',
                'answer_d' => 'Nicea',
                'correct_answer' => 'b',
            ],
            [
                'content' => 'Stolicą Polski jest:',
                'answer_a' => 'Kraków',
                'answer_b' => 'Gdańsk',
                'answer_c' => 'Warszawa',
                'answer_d' => 'Poznań',
                'correct_answer' => 'c',
            ],
            [
                'content' => 'Stolicą Hiszpanii jest:',
                'answer_a' => 'Madryt',
                'answer_b' => 'Barcelona',
                'answer_c' => 'Sewilla',
                'answer_d' => 'Walencja',
                'correct_answer' => 'a',
            ],
        ]);

        //quiz 2
        $quizPhp = Quiz::create([
            'title' => 'Podstawy Laravel',
            'code'  => 'LARAVEL',
        ]);

        //pytania quiz 2
        $quizPhp->questions()->createMany([
            [
                'content' => 'Jakim znakiem rozpoczynają się zmienne w PHP?',
                'answer_a' => '@',
                'answer_b' => '#',
                'answer_c' => '%',
                'answer_d' => '$',
                'correct_answer' => 'd',
            ],
            [
                'content' => 'Katalog, w którym znajdują się widoki to:',
                'answer_a' => 'app/Views',
                'answer_b' => 'resources/views',
                'answer_c' => 'public/views',
                'answer_d' => 'database/views',
                'correct_answer' => 'b',
            ],
        ]);
    }
}