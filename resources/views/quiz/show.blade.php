<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800">{{ $quiz->title }}</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white p-6 shadow sm:rounded-lg">
            <form method="POST" action="{{ route('quiz.submit', $quiz->id) }}">
                @csrf
                @foreach($quiz->questions as $q)
                    <div class="mb-6 border-b pb-4">
                        <p class="font-bold text-lg mb-2">{{ $q->content }}</p>
                        <div class="space-y-2">
                            <label class="flex items-center"><input type="radio" name="answers[{{ $q->id }}]" value="a" class="mr-2"> {{ $q->answer_a }}</label>
                            <label class="flex items-center"><input type="radio" name="answers[{{ $q->id }}]" value="b" class="mr-2"> {{ $q->answer_b }}</label>
                            <label class="flex items-center"><input type="radio" name="answers[{{ $q->id }}]" value="c" class="mr-2"> {{ $q->answer_c }}</label>
                            <label class="flex items-center"><input type="radio" name="answers[{{ $q->id }}]" value="d" class="mr-2"> {{ $q->answer_d }}</label>
                        </div>
                    </div>
                @endforeach
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md">Wyślij Odpowiedzi</button>
            </form>
        </div>
    </div>
</x-app-layout>