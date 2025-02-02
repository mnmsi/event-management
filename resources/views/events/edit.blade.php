@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Event</h2>

        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="category_id">Category</label>
                <select name="category_id" id="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $event->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" value="{{ $event->title }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required>{{ $event->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" name="date" id="date" class="form-control" value="{{ $event->date }}" required>
            </div>

            <div class="form-group">
                <label for="location">Location</label>
                <input type="text" name="location" id="location" class="form-control" value="{{ $event->location }}" required>
            </div>

            <div class="form-group">
                <label for="max_participants">Max Participants</label>
                <input type="number" name="max_participants" id="max_participants" class="form-control" value="{{ $event->max_participants }}" required>
            </div>

            <div class="form-group">
                <label for="registration_fee">Registration Fee</label>
                <input type="number" name="registration_fee" id="registration_fee" class="form-control" value="{{ $event->registration_fee }}" required>
            </div>

            <button type="submit" class="btn btn-warning">Update Event</button>
        </form>
    </div>
@endsection
