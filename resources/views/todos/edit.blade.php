@extends('layouts.app')

@section('title', 'Modifier la todo')

@section('content')
    <main class="max-w-2xl mx-auto px-4 py-12">

        <header class="mb-8">
            <a href="{{ route('todos.index') }}" class="text-sm text-gray-500 hover:text-gray-800 transition">← Retour à la liste</a>
            <h1 class="text-2xl font-semibold text-gray-900 mt-2">Modifier la todo</h1>
        </header>

        <form action="{{ route('todos.update', ['todo' => 1]) }}" method="POST"
              class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom de la tâche</label>
                <input type="text" id="name" name="name" value="Faire les courses"
                       class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-gray-900 focus:border-gray-900">
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="completed" name="completed"
                       class="h-4 w-4 rounded border-gray-300">
                <label for="completed" class="text-sm text-gray-700">Marquer comme terminée</label>
            </div>

            <div class="flex items-center gap-3 pt-2">
                <button type="submit"
                        class="bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                    Enregistrer
                </button>
                <a href="{{ route('todos.index') }}"
                   class="text-sm text-gray-600 hover:text-gray-900 px-3 py-2 rounded-md hover:bg-gray-100 transition">
                    Annuler
                </a>
            </div>
        </form>

    </main>
@endsection
