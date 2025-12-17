<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private function checkAdmin() {
        if (!Auth::user()->is_admin) abort(403, 'Brak dostępu do panelu administratora.');
    }

    public function index() {
        $this->checkAdmin();
        $quizzes = Quiz::all();
        return view('admin.index', compact('quizzes'));
    }

    public function create(Request $request) {
        $this->checkAdmin();
        $questionsCount = $request->input('count', 0);
        return view('admin.create', compact('questionsCount'));
    }

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

    public function show(Quiz $quiz) {
        $this->checkAdmin();
        return view('admin.show', compact('quiz'));
    }

    public function edit(Quiz $quiz) {
        $this->checkAdmin();
        return view('admin.edit', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz) {
        $this->checkAdmin();

        $request->validate([
            'title' => 'required',
            'questions' => 'required|array',
            'questions.*.content' => 'required',
            'questions.*.correct' => 'required',
        ]);

        $quiz->title = $request->title;
        $quiz->save();

        foreach ($request->questions as $id => $qData) {
            $question = \App\Models\Question::find($id);
            if($question) {
                $question->update([
                    'content' => $qData['content'],
                    'answer_a' => $qData['a'],
                    'answer_b' => $qData['b'],
                    'answer_c' => $qData['c'],
                    'answer_d' => $qData['d'],
                    'correct_answer' => $qData['correct'],
                ]);
            }
        }

        return redirect()->route('admin.index')->with('status', 'Zaktualizowano quiz!');
    }

    public function destroy(Quiz $quiz) {
        $this->checkAdmin();
        
        $quiz->delete();

        return redirect()->route('admin.index')->with('status', 'Quiz został usunięty.');
    }
}