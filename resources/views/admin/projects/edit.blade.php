@extends('layouts.admin')

@section('content')
    <h1>Modifica progetto</h1>
    <form class="form-control" action="{{ route('admin.projects.update', $project) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Titolo</label>
            <input class="form-control me-2" type="text" name="title" id="title"
                value="{{ old('title', $project->title) }}">
            @error('title')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
            <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select class="form-select" name="type" id="type">
                    @foreach ($types as $type)
                        <option value="{{ $type->id }}"
                            {{ old('type', $project->type_id) == $type->id ? 'selected' : '' }}>
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
                            name="tecnologies[]" value="{{ $tecnology->id }}"
                            {{ in_array($tecnology->id, old('tecnologies', $project->tecnologies->pluck('id')->toArray())) ? 'checked' : '' }}>
                        <label class="btn btn-outline-primary"
                            for="tecnology_{{ $tecnology->id }}">{{ $tecnology->title }}</label>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Inserire l'immagine</label>
                <input class="form-control" placeholder="Immagine" name="image" id="image" type="file">
            </div>
        </div>
        <div class="my-3">
            <button type="submit" class="btn btn-success me-3">Modifica</button>
            <button type="reset" class="btn btn-warning me-3">Reset</button>
        </div>
    </form>
@endsection
