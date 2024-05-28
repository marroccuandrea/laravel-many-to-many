@extends('layouts.admin')

@section('content')
    <h1>Crea nuovo progetto</h1>
    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            @foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form class="my-5" action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Nome del progetto</label>
            <input class="form-control" placeholder="Nome progetto" name="title" id="title">
        </div>
        <div class="mb-3">
            <label for="type" class="form-label">Tipo</label>
            <select class="form-select" name="type" id="type">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->title }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Linguaggi: </label>
            <div class="btn-group btn-group-sm" role="group" aria-label="Small button group">
                @foreach ($tecnologies as $tecnology)
                    <input type="checkbox" class="btn-check" id="tecnology_{{ $tecnology->id }}" autocomplete="off"
                        name="tecnologies[]" value="{{ $tecnology->id }}">
                    <label class="btn btn-outline-primary"
                        for="tecnology_{{ $tecnology->id }}">{{ $tecnology->title }}</label>
                @endforeach
            </div>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Inserire l'immagine</label>
            <input class="form-control" placeholder="Immagine" name="image" id="image" type="file">
        </div>
        <button class="btn btn-primary" type="submit">Aggiungi</button>
        <button class="btn btn-warning" type="reset">Reset</button>
    </form>
@endsection
