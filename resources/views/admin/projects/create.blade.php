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
            <label for="image" class="form-label">Inserire l'immagine</label>
            <input class="form-control" placeholder="Immagine" name="image" id="image" type="file">
        </div>
        <button class="btn btn-primary" type="submit">Aggiungi</button>
        <button class="btn btn-warning" type="reset">Reset</button>
    </form>
@endsection
