<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Panel Administratora</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <a href="{{ route('admin.create') }}" 
                    class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest"
                    style="background-color: green; color: white;"> + Stwórz Nowy Quiz
                </a>
                
                <h3 class="mt-6 mb-4 text-lg font-bold">Lista Quizów</h3>
                <table class="min-w-full border">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Tytuł</th>
                            <th class="border p-2">Kod</th>
                            <th class="border p-2">Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($quizzes as $quiz)
                        <tr>
                            <td class="border p-2">{{ $quiz->title }}</td>
                            <td class="border p-2 font-mono">{{ $quiz->code }}</td>
                            <td class="border p-2">
                                <a href="{{ route('admin.show', $quiz->id) }}" class="text-blue-600 underline">Szczegóły</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>