<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">Szczegóły: {{ $quiz->title }}</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow sm:rounded-lg">
            <p class="text-lg">Kod dostępu: <span class="font-mono font-bold bg-gray-200 p-1">{{ $quiz->code }}</span></p>
            
            <h3 class="mt-6 font-bold text-lg">Wyniki użytkowników:</h3>
            <ul class="list-disc pl-5 mt-2">
                @foreach($quiz->users as $user)
                    <li>
                        {{ $user->name }} ({{ $user->email }}) - 
                        <strong>Wynik: {{ $user->pivot->score ?? 'W trakcie' }}</strong>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</x-app-layout>