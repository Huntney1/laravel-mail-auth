{{-- * Categories\Show.blade.php --}}
@extends('layouts.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-between my-2">
                <div>
                    <h2>Dettaglio Categoria: {{ $category->name }}
                        <span>({{ $category->slug }})</span>
                    </h2>
                </div>
                <div>
                    <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Torna all'Elenco</a>
                </div>
            </div>
            <hr>
            <div class="col-12">
                <h2>Projetti Appartenenti a Questa Categoria</h2>
                <div class="row mt-5 d-flex">
                    @forelse($category->projects as $project)
                        <div class="col-md-3 py-2">
                            <div class="card p-2">
                                <div class="card-body">
                                    <h5>{{ $project->title }}</h5>
                                    <p>{{ $project->description }}</p>
                                    <a class="btn btn-primary btn-sm"
                                        href="{{ route('admin.projects.show', $project->slug) }}">Continua a Leggere</a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <h5 class="text-center">Non ci Sono Progetti per Questa Categoria</h5>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
