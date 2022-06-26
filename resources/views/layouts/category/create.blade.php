@extends('layout.layout')
<style>
    body {
        padding-top: 5rem;
    }

    .starter-template {
        padding: 3rem 1.5rem;
    }
</style>
@section('content')
    {{-- <h1>Add New Category</h1> --}}
    <hr>
    <form action="{{ route('category.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="Name">Name</label>
            <input type="text" class="form-control" id="taskTitle" name="name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="taskDescription" name="slug">
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
