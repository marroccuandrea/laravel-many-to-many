@extends('layouts.admin')

@section('content')
    <h1>Modifica progetto</h1>
    <form class="form-control" action="{{ route('admin.projects.update', $project) }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">Titolo</label>
            <input class="form-control me-2" type="text" name="title" id="title" value="{{ $project->title }}">
            @error('title')
                <small class="text-danger">
                    {{ $message }}
                </small>
            @enderror
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
