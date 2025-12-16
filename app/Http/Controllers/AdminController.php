<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //sprawdza czy admin
    private function checkAdmin() {
        if (!Auth::user()->is_admin) abort(403, 'Brak dostępu do panelu administratora.');
    }

    //zwraca widok ze wszystkimi quizami
    public function index() {
        $this->checkAdmin();
        $quizzes = Quiz::all(); //ORM pobierz wszystkie quizy
        return view('admin.index', compact('quizzes'));
    }

    //zwraca widok tworzenia quizu
    public function create(Request $request) {
        $this->checkAdmin();
        $questionsCount = $request->input('count', 0);
        return view('admin.create', compact('questionsCount'));
    }

    //zapisuje quiz i pytania do bazy danych
    public function store(Request $request) {
        $this->checkAdmin();
        
        $request->validate([
            'title' => 'required',
            'questions' => 'required|array',
            'questions.*.content' => 'required',
            'questions.*.correct' => 'required',
        ]);

        $quiz = new Quiz();
        $quiz->title = $request->title;
        $quiz->code = Str::upper(Str::random(6));
        $quiz->save();

        //zapisanie pytania i odpowiedzi
        foreach ($request->questions as $qData) {
            $quiz->questions()->create([
                'content' => $qData['content'],
                'answer_a' => $qData['a'],
                'answer_b' => $qData['b'],
                'answer_c' => $qData['c'],
                'answer_d' => $qData['d'],
                'correct_answer' => $qData['correct'],
            ]);
        }

        return redirect()->route('admin.index')->with('status', 'Utworzono quiz!');
    }

    //zwraca widok szczegolow quizu
    public function show(Quiz $quiz) {
        $this->checkAdmin();
        return view('admin.show', compact('quiz'));
    }
}