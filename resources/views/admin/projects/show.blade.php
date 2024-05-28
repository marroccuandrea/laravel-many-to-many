@extends('layouts.admin')

@section('content')
    <h1>Progetto : {{ $project->title }}</h1>
    @if ($project->tecnologies)
        <p>Linguaggi:
            @foreach ($project->tecnologies as $tecnology)
                <span class="badge text-bg-dark">{{ $tecnology->title }}</span>
            @endforeach
        </p>
    @endif
    <div class="container">
        @if ($project->image)
            <img class="image-fluid w-50" src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
        @else
            <img class="image-fluid w-50" src="/img/no-image.jpeg" alt="{{ $project->title }}">
        @endif
    </div>
@endsection
