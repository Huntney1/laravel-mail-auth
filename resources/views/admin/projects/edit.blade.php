{{-- * Projects\Edit.blade.php --}}
@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between my-2">
                <div>
                    <h1>Modifica {{ $project->title }}</h1>
                </div>

                @if (session('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif

                <div>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary my-2">Torna all'Elenco</a>
                </div>
            </div>

            <div class="col-12">

                <form action="{{ route('admin.projects.update', $project->slug) }} " method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- * TITOLO --}}
                    <div class="form-group my-3">
                        <label class="control-label">
                            Titolo
                        </label>
                        <input type="text" class="form-control" placeholder="Inserisci Titolo Progetto" id="title"
                            name="title" value="{{ old('title') ?? $project->title }}">
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    {{-- * AUTORE --}}
                    <div class="form-group my-3">
                        <label class="control-label">
                            Autore
                        </label>
                        <input type="text" class="form-control" placeholder="Inserisci Autore" id="author"
                            name="author" value="{{ old('author') ?? $project->author }}">
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
                                <option value="{{ $category->id }}"
                                    {{ $category->id == old('$category_id', $project->category_id) ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
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

                                @if ($errors->any())
                                    {{-- ? PRIMO CASO --}}
                                    {{-- * Ci Sono Degli Errori di Validazione Quindi Bisogna Ricaricare i Progetti selezionati tramite la funzione old() --}}

                                    {{-- ? Controlliamo --}}
                                    {{-- se è presente il valore di Technology->id nel Array technologies allora mettiamo il checked. --}}
                                    <input class="form-chechk-input" type="checkbox" value="{{ $technology->id }}"
                                        name="technologies[]" {{-- * name="technologies[]" = crea un array con gli Id delle tecnologie --}}
                                        {{ in_array($technology->id, old('technologies', [])) ? 'checkd' : '' }}>
                                    <label for="" class="form-check-label">{{ $technology->name }}</label>
                                @else
                                    {{-- ? SECONDO CASO --}}
                                    {{-- * Se Non Sono Presenti Errori di Validazione Significa Che la Pagina è Stata Aperta Per la Prima Volta,Quindi Dobbiamo Recuperare le Tecnologie in Relazione hai Progetti --}}

                                    {{-- ? Controlliamo --}}
                                    {{-- recupero nel project le technologies che contengono il singolo technology, Se è vero metto check altrimenti stringa vuota --}}
                                    <input class="form-check-input" type="checkbox" value="{{ $technology->id }}"
                                        name="technology[]"{{ $project->technologies->contains($technology) ? 'checked' : '' }}>
                                        <label for="" class="form-check-label">{{ $technology->name }}</label>
                                @endif

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
                        <textarea type="text" class="form-control" placeholder="Inserisci Descrizione del Progetto" id="description"
                            name="description" value="{{ old('description') ?? $categories->description }}"></textarea>
                    </div>

                    {{-- * PUBBLICATO --}}
                    <div class="form-group my-3">
                        <label class="control-label">
                            Pubblicato
                        </label>
                        <input type="date" class="form-control" placeholder="Inserisci l'Immagine" id="published"
                            name="published" value="{{ old('published') ?? $project->published }}">
                    </div>

                    <div class="form-group my-3">
                        <button type="submit" class="btn btn-success">SALVA</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
