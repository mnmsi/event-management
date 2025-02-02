@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>All Events</h2>
        <a href="{{ route('events.create') }}" class="btn btn-primary">Create Event</a>

        <table class="table table-striped mt-3">
            <thead>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Date</th>
                <th>Location</th>
                <th>Max Participants</th>
                <th>Registration Fee</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($events as $event)
                <tr>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->category->name }}</td>
                    <td>{{ $event->date }}</td>
                    <td>{{ $event->location }}</td>
                    <td>{{ $event->max_participants }}</td>
                    <td>{{ $event->registration_fee }}</td>
                    <td>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $events->links() }}
    </div>
@endsection
