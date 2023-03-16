{{-- * Technologies\Index.blade.php --}}
@extends('layouts.admin')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between mt-3">
                <div>
                    <h1>Elenco Tecnologie</h1>
                </div>
                <div class="my-2">
                    <a href="" class="btn btn-primary">aggiungi progetto</a>
                </div>
            </div>

        </div>
        <div class="col-12">
            @if(session('message'))
            <div class="alert alert-success">
                {{session('message')}}
            </div>
            @endif
            <table class="table table-striped">
                <thead>
                    <th><strong>Id</strong></th>
                    <th><strong>Nome</strong></th>
                    <th><strong>Slug</strong></th>
                </thead>
                <tbody>
                    @foreach($technologies as $technology)
                    <tr>
                        <td>{{$technology->id}}</td>
                        <td>{{$technology->name}}</td>
                        <td>{{$technology->slug}}</td>


                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
