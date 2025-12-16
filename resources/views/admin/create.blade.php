<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nowy Quiz</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow sm:rounded-lg">
            
            @if($questionsCount == 0)
                <form method="GET" action="{{ route('admin.create') }}">
                    <label>Ile pytań ma mieć quiz?</label>
                    <input type="number" name="count" value="3" class="border-gray-300 rounded-md shadow-sm">
                    <button type="submit" 
                            class="px-4 py-2 bg-gray-800 text-white rounded-md" 
                            style="background-color: green; color: white;"> Dalej
                    </button>
                </form>
            @else
                <form method="POST" action="{{ route('admin.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label class="block font-bold">Tytuł Quizu:</label>
                        <input type="text" name="title" class="w-full border-gray-300 rounded-md" required>
                    </div>

                    @for($i = 0; $i < $questionsCount; $i++)
                        <div class="mb-6 p-4 border rounded bg-gray-50">
                            <h4 class="font-bold mb-2">Pytanie {{ $i + 1 }}</h4>
                            <input type="text" name="questions[{{$i}}][content]" placeholder="Treść pytania" class="w-full mb-2 border-gray-300 rounded-md" required>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <input type="text" name="questions[{{$i}}][a]" placeholder="Odp A" class="border-gray-300 rounded-md" required>
                                <input type="text" name="questions[{{$i}}][b]" placeholder="Odp B" class="border-gray-300 rounded-md" required>
                                <input type="text" name="questions[{{$i}}][c]" placeholder="Odp C" class="border-gray-300 rounded-md" required>
                                <input type="text" name="questions[{{$i}}][d]" placeholder="Odp D" class="border-gray-300 rounded-md" required>
                            </div>
                            
                            <label class="block mt-2">Poprawna:</label>
                            <select name="questions[{{$i}}][correct]" class="border-gray-300 rounded-md">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                    @endfor

                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md" 
                            style="background-color: green; color: white;"> Zapisz Quiz
                    </button>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>