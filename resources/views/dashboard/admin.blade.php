@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="list-group">
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action active">Dashboard</a>
                    <a href="{{ route('admin.events.index') }}" class="list-group-item list-group-item-action">Manage Events</a>
                    <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action">Manage Categories</a>
                    <a href="{{ route('admin.reports') }}" class="list-group-item list-group-item-action">Reports</a>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9">
                <h2 class="my-4">Admin Dashboard</h2>
                <div class="row">
                    <!-- Upcoming Events -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Upcoming Events
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total: {{ $upcomingEventsCount }}</h5>
                                <p class="card-text">Events happening soon.</p>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-primary">View Events</a>
                            </div>
                        </div>
                    </div>

                    <!-- Events Reached Max Participants -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Max Participants Reached
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total: {{ $maxParticipantsEventsCount }}</h5>
                                <p class="card-text">Events where the participant limit has been reached.</p>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-warning">View Events</a>
                            </div>
                        </div>
                    </div>

                    <!-- Active Categories -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Active Categories
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total: {{ $activeCategoriesCount }}</h5>
                                <p class="card-text">Categories with upcoming events.</p>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-success">View Categories</a>
                            </div>
                        </div>
                    </div>
                </div>

                <hr>

                <!-- Revenue Report -->
                <h3 class="my-4">Revenue Report</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Total Revenue
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">Total Revenue: ${{ number_format($totalRevenue, 2) }}</h5>
                                <p class="card-text">Revenue generated from event registrations.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
