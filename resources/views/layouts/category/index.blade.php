@extends('layout.layout')
<style>
    .starter-template {
        padding: 3rem 1.5rem;
    }
</style>
@section('content')
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif
    <a href="{{ route('category.create') }}" class="btn btn-warning">Add Category</a>
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Category Name</th>
                <th scope="col">Category Description</th>
                <th scope="col">Created At</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <th scope="row">{{ $category->id }}</th>
                    <td><a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a></td>
                    <td>{{ $category->slug }}</td>
                    <td>{{ $category->created_at }}</td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="{{ route('category.edit', $category->id) }}">
                                <button type="button" class="btn btn-warning">Edit</button>
                            </a>&nbsp;
                            <form action="{{ route('category.delete', $category->id) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-danger" value="Delete" />
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
