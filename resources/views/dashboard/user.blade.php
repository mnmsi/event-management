@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h2 class="my-4">Your Dashboard</h2>
        <div class="row">
            <!-- User's Registered Events -->
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Your Registered Events
                    </div>
                    <div class="card-body">
                        @if($userEvents->isEmpty())
                            <p>You are not registered for any events yet.</p>
                        @else
                            <ul class="list-group">
                                @foreach($userEvents as $event)
                                    <li class="list-group-item">
                                        <strong>{{ $event->title }}</strong><br>
                                        Date: {{ $event->date }}<br>
                                        Location: {{ $event->location }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
