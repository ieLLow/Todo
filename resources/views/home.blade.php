@extends('layouts.app')

@section('title', 'Accueil')

@section('content')
    <div class="max-w-2xl mx-auto px-4 py-12">
        Hello {{ $name }}
    </div>
@endsection
