{{-- * Categorie\Index.blade.php --}}
@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12 my-4">
                <div class="d-flex justify-content-between">
                    <div>
                        <h2>Lista Categorie</h2>
                    </div>
                </div>
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('admin.categories.create') }}"> Nuova Categoria</a>
                </div>
            </div>
        </div>
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif


        <div class="col-12">
            <table class="table table-striped">
                <tr>

                    <th scope="col">Id</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Slug</th>
                    <th scope="col" style="display:flex; justify-content:center ">Setting</th>

                </tr>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td class="d-flex justify-content-center">
                            {{-- * questa rotta visualizza il dettaglio del progetto --}}
                            <a href="{{ route('admin.categories.show', $category->slug) }}" title="Visualizza Dettaglio"
                                class="btn btn-square btn-primary">
                                <i class="fas fa-eye"></i>
                            </a>

                            {{-- * questa rotta modifica il progetto --}}
                            <a class="btn btn-warning btn-square"
                                href="{{ route('admin.categories.edit', $category->slug) }}" title="Modifica Dettaglio"><i
                                    class="fas fa-edit"></i></a>

                            {{-- * questa rotta elimina il progetto --}}
                            <form action="{{ route('admin.categories.destroy', $category->slug) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-square btn-danger" type="submit" title="Elimina"><i class="fas fa-trash"></i></button>
                            </form>

                        </td>
                @endforeach
            </table>
        </div>
    </div>
    @include('admin.partials.modals')
@endsection
