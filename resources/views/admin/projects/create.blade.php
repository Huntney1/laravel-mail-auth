{{-- * Projects\Create.blade.php --}}
@extends('layouts.admin')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 my-4">
                <h2>Aggiungi Nuovo Progetto</h2>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-12">

                <form action="{{ route('admin.projects.store') }} " method="POST" enctype="multipart/form-data">
                    @csrf
                    {{-- * TITOLO --}}
                    <div class="form-group my-3">
                        <label class="control-label">
                            Titolo
                        </label>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <input type="text" class="form-control" placeholder="Inserisci Titolo Progetto" id="title"
                            name="title">
                    </div>

                    {{-- * COPERTINA --}}
                    <div class="form-group my-3">
                        <label class="control-label">Copertina</label>
                        <input type="file" name="cover_image" id="cover_image" class="form-control
                        @error('cover_image')is-invalid @enderror">

                        @error('cover_image')
                        <div class="text-danger"> {{ $message }} </div>
                        @enderror


                    {{-- * AUTORE --}}
                    <div class="form-group my-3">
                        <label class="control-label">
                            Autore
                        </label>
                        <input type="text" class="form-control" placeholder="Inserisci Autore" id="author"
                            name="author">
                        @error('author')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- * CATEGORIE --}}
                    <div class="form-group my-3">
                        <label class="control-label">
                            Categorie
                        </label>
                        <select class="form-control" name="category_id" id="category_id">
                            <option value="">Seleziona Categoria...</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- * TECNOLOGIA --}}
                    <div class="form-group my-3">
                        <div class="control-label">
                            Tecnologia
                        </div>
                        @foreach ($technologies as $technology)
                            <div class="form-check @error('technologies') is-invalid @enderror">
                                <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                                    name="technologies[]">{{-- * name="technologies[]" = crea una specie di array --}}
                                <label for="" class="form-check-label">{{ $technology->name }}</label>
                            </div>
                        @endforeach
                        @error('technologies')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- * DESCRIZIONE --}}
                    <div class="form-group my-3">
                        <label class="control-label">
                            Descrizione
                        </label>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <textarea type="text" class="form-control" placeholder="Inserisci Descrizione del Progetto" id="description"
                            name="description"></textarea>
                    </div>

                    {{-- * PUBBLICATO --}}
                    {{-- ! Utilizzare solo se si vuole inserire la data di creazione --}}
                    <div class="form-group my-3">
                        <label class="control-label">
                            Pubblicato
                        </label>
                        <input type="date" class="form-control" placeholder="Inserisci l'Immagine" id="published"
                            name="published">
                    </div>

                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-success">SALVA</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
