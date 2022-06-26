@extends('layout.layout')
<style>
    .starter-template {
        padding: 3rem 1.5rem;
    }
</style>
@section('content')
    <h1>Showing Category {{ $category->name }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Name:</strong> {{ $category->name }}<br>
            <strong>Description:</strong> {{ $category->slug }}
        </p>
    </div>
@endsection
