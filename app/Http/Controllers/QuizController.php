<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index() {
        $user = Auth::user();
        $myQuizzes = $user->quizzes;
        // Zwracamy widok dashboard, który nadpiszemy w kroku z widokami
        return view('dashboard', compact('myQuizzes'));
    }

    public function join(Request $request) {
        $request->validate(['code' => 'required']);
        $quiz = Quiz::where('code', $request->code)->first();

        if (!$quiz) {
            return back()->withErrors(['code' => 'Nieprawidłowy kod quizu.']);
        }

        if (!$quiz->users->contains(Auth::id())) {
            $quiz->users()->attach(Auth::id(), ['score' => null]);
        }

        return redirect()->route('dashboard');
    }

    public function show(Quiz $quiz) {
        // Blokada: user musi być przypisany do quizu
        if (!$quiz->users->contains(Auth::id())) abort(403);
        
        return view('quiz.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz) {
        $score = 0;
        $answers = $request->input('answers');

        foreach ($quiz->questions as $question) {
            if (isset($answers[$question->id]) && $answers[$question->id] == $question->correct_answer) {
                $score++;
            }
        }

        $quiz->users()->updateExistingPivot(Auth::id(), ['score' => $score]);

        return redirect()->route('dashboard')->with('status', "Ukończono quiz! Twój wynik: $score");
    }
}