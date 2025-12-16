<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    // Modyfikacja tabeli users (dodanie is_admin)
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('is_admin')->default(false); // Domyślnie zwykły user
    });

    // Tabela quizów
    Schema::create('quizzes', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('code')->unique(); // Unikalny kod do dołączenia
        $table->timestamps();
    });

    // Tabela pytań
    Schema::create('questions', function (Blueprint $table) {
        $table->id();
        $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
        $table->string('content');
        $table->string('answer_a');
        $table->string('answer_b');
        $table->string('answer_c');
        $table->string('answer_d');
        $table->string('correct_answer'); // np. 'a', 'b', 'c', 'd'
        $table->timestamps();
    });

    // Tabela łącząca userów z quizami (wyniki)
    Schema::create('quiz_user', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained();
        $table->foreignId('quiz_id')->constrained();
        $table->integer('score')->nullable(); // Wynik
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quizzes_tables');
    }
};
