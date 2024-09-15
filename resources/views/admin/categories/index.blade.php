@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Categories</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Add New Category</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
