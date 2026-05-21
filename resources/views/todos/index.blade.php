@extends('layouts.app')

@section('title', 'Mes todos')

@section('content')
    <main class="max-w-2xl mx-auto px-4 py-12">

        {{-- En-tête : titre + bouton "créer" --}}
        <header class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">Mes todos</h1>
                <p class="text-sm text-gray-500 mt-1">3 tâches · 1 terminée</p>
            </div>

            <a href="{{ route('todos.create') }}"
               class="inline-flex items-center gap-2 bg-gray-900 text-white text-sm font-medium px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                + Nouvelle todo
            </a>
        </header>

        {{-- Liste des todos --}}
        <ul class="bg-white rounded-xl shadow-sm border border-gray-200 divide-y divide-gray-200">

            {{-- Todo à faire --}}
            <li class="flex items-center gap-4 px-5 py-4">
                <form action="{{ route('todos.toggle', ['todo' => 1]) }}" method="POST" class="shrink-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit" title="Marquer comme terminée"
                            class="h-5 w-5 rounded-full border-2 border-gray-300 hover:border-gray-500 transition cursor-pointer"></button>
                </form>

                <a href="{{ route('todos.show', ['todo' => 1]) }}"
                   class="flex-1 text-gray-800 hover:underline">Faire les courses</a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('todos.edit', ['todo' => 1]) }}"
                       class="text-sm text-gray-600 hover:text-gray-900 px-3 py-1 rounded-md hover:bg-gray-100 transition">
                        Modifier
                    </a>
                    <form action="{{ route('todos.destroy', ['todo' => 1]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-sm text-red-600 hover:text-red-700 px-3 py-1 rounded-md hover:bg-red-50 transition">
                            Supprimer
                        </button>
                    </form>
                </div>
            </li>

            {{-- Todo terminée --}}
            <li class="flex items-center gap-4 px-5 py-4">
                <form action="{{ route('todos.toggle', ['todo' => 2]) }}" method="POST" class="shrink-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit" title="Marquer comme à faire"
                            class="h-5 w-5 rounded-full bg-green-500 border-2 border-green-500 hover:bg-green-600 hover:border-green-600 transition cursor-pointer flex items-center justify-center">
                        <svg class="h-3 w-3 text-white" viewBox="0 0 12 12" fill="none">
                            <path d="M2 6l3 3 5-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>

                <a href="{{ route('todos.show', ['todo' => 2]) }}"
                   class="flex-1 text-gray-400 line-through hover:underline">Apprendre Laravel</a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('todos.edit', ['todo' => 2]) }}"
                       class="text-sm text-gray-600 hover:text-gray-900 px-3 py-1 rounded-md hover:bg-gray-100 transition">
                        Modifier
                    </a>
                    <form action="{{ route('todos.destroy', ['todo' => 2]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-sm text-red-600 hover:text-red-700 px-3 py-1 rounded-md hover:bg-red-50 transition">
                            Supprimer
                        </button>
                    </form>
                </div>
            </li>

            {{-- Todo à faire --}}
            <li class="flex items-center gap-4 px-5 py-4">
                <form action="{{ route('todos.toggle', ['todo' => 3]) }}" method="POST" class="shrink-0">
                    @csrf
                    @method('PATCH')
                    <button type="submit" title="Marquer comme terminée"
                            class="h-5 w-5 rounded-full border-2 border-gray-300 hover:border-gray-500 transition cursor-pointer"></button>
                </form>

                <a href="{{ route('todos.show', ['todo' => 3]) }}"
                   class="flex-1 text-gray-800 hover:underline">Réviser Tailwind</a>

                <div class="flex items-center gap-2">
                    <a href="{{ route('todos.edit', ['todo' => 3]) }}"
                       class="text-sm text-gray-600 hover:text-gray-900 px-3 py-1 rounded-md hover:bg-gray-100 transition">
                        Modifier
                    </a>
                    <form action="{{ route('todos.destroy', ['todo' => 3]) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-sm text-red-600 hover:text-red-700 px-3 py-1 rounded-md hover:bg-red-50 transition">
                            Supprimer
                        </button>
                    </form>
                </div>
            </li>

        </ul>

    </main>
@endsection
