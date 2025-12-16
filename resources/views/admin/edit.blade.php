<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edytuj Quiz: {{ $quiz->title }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow sm:rounded-lg">
            
            <form method="POST" action="{{ route('admin.update', $quiz->id) }}">
                @csrf
                @method('PUT') <div class="mb-4">
                    <label class="block font-bold">Tytuł Quizu:</label>
                    <input type="text" name="title" value="{{ $quiz->title }}" class="w-full border-gray-300 rounded-md" required>
                </div>

                @foreach($quiz->questions as $q)
                    <div class="mb-6 p-4 border rounded bg-gray-50">
                        <h4 class="font-bold mb-2">Pytanie (ID: {{ $q->id }})</h4>
                        
                        <input type="text" name="questions[{{$q->id}}][content]" value="{{ $q->content }}" class="w-full mb-2 border-gray-300 rounded-md" required>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <input type="text" name="questions[{{$q->id}}][a]" value="{{ $q->answer_a }}" class="border-gray-300 rounded-md" required>
                            <input type="text" name="questions[{{$q->id}}][b]" value="{{ $q->answer_b }}" class="border-gray-300 rounded-md" required>
                            <input type="text" name="questions[{{$q->id}}][c]" value="{{ $q->answer_c }}" class="border-gray-300 rounded-md" required>
                            <input type="text" name="questions[{{$q->id}}][d]" value="{{ $q->answer_d }}" class="border-gray-300 rounded-md" required>
                        </div>
                        
                        <label class="block mt-2">Poprawna:</label>
                        <select name="questions[{{$q->id}}][correct]" class="border-gray-300 rounded-md">
                            <option value="a" {{ $q->correct_answer == 'a' ? 'selected' : '' }}>A</option>
                            <option value="b" {{ $q->correct_answer == 'b' ? 'selected' : '' }}>B</option>
                            <option value="c" {{ $q->correct_answer == 'c' ? 'selected' : '' }}>C</option>
                            <option value="d" {{ $q->correct_answer == 'd' ? 'selected' : '' }}>D</option>
                        </select>
                    </div>
                @endforeach

                <div class="flex items-center gap-4">
                    <button type="submit" 
                            class="px-4 py-2 text-white rounded-md" 
                            style="background-color: #d97706;"> Zaktualizuj Quiz
                    </button>
                    <a href="{{ route('admin.index') }}" class="text-gray-600 underline">Anuluj</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>