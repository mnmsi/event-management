@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create Category</h2>

        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Category Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Create Category</button>
        </form>
    </div>
@endsection
