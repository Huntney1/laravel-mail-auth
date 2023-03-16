{{-- * Projects\Show.blade.php --}}
@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between my-2">
                <div>
                    <h2>Dettaglio: {{ $project->title }}</h2>
                </div>
                <div>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna all'Elenco</a>
                </div>
            </div>

            <div class="col-12">
                <strong>Progetto(Id)</strong>
                <p>{{ $project->id }}</p>

                <strong>Titolo</strong>
                <p>{{ $project->title }}</p>
                <img src="{{asset('storage/' .$project->cover_image)}}" alt="{{$project->title}}" class="w-50">

                <p><strong>Slug:</strong>{{ $project->slug }}</p>

                <p><strong>Autore:</strong>{{ $project->author }}</p>

                <p><strong>Categoria:</strong>{{ $project->category ? $project->category->name : 'Nessuna Categoria Selezionata' }}
                </p>

                <p><strong>tecnologie</strong>

                  @forelse($project->technologies as $technology)
                  <p>{{ $technology->name }}</p>
                  @empty
                  <p>nessuna tecnelogia selezionata</p>
                  @endforelse


                </p>

                <strong>Descrizione</strong>
                <p>{{ $project->description }}</p>

                <p><strong>Autore:</strong>{{ $project->author }}</p>

                <p><strong>Riassunto:</strong>{{ $project->excerpt }}</p>

                <div class="my-3">
                    <strong>Pubblicato</strong>
                    <p>{{ date('d/m/Y H:i:s', strtotime($project->published_at)) }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection
