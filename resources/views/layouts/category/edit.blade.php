@extends('layout.layout')

@section('content')
    <h1>Edit Category</h1>
    <hr>
    <form action="{{ route('category.update', $category->id) }}" method="POST">
        <input type="hidden" name="id" value="{{ $category->id }}">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Name</label>
            <input type="text" value="{{ $category->name }}" class="form-control" id="categoryTitle" name="name">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" value="{{ $category->slug }}" class="form-control" id="categoryDescription"
                name="slug">
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
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
@endsection
