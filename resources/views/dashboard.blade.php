<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel Użytkownika') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            @if(Auth::user()->is_admin)
                <div class="bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4" role="alert">
                    <p class="font-bold">Jesteś Administratorem</p>
                    <a href="{{ route('admin.index') }}" class="underline">Przejdź do Panelu Administratora</a>
                </div>
            @endif

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900">Dołącz do Quizu</h3>
                <form method="POST" action="{{ route('quiz.join') }}" class="mt-4">
                    @csrf
                    <label>Podaj kod:</label>
                    <input type="text" name="code" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                    <button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                        Dołącz
                    </button>
                    @error('code') <div class="text-red-500 mt-2">{{ $message }}</div> @enderror
                </form>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Twoje Quizy</h3>
                @if($myQuizzes->isEmpty())
                    <p>Nie dołączyłeś jeszcze do żadnego quizu.</p>
                @else
                    <ul class="list-disc pl-5">
                        @foreach($myQuizzes as $quiz)
                            <li class="mb-2">
                                <strong>{{ $quiz->title }}</strong> 
                                (Wynik: {{ $quiz->pivot->score !== null ? $quiz->pivot->score . ' pkt' : 'Brak' }})
                                <a href="{{ route('quiz.show', $quiz->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-2">
                                    [Otwórz / Popraw]
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>