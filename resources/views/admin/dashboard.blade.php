@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Admin Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text display-4">{{ \App\Models\User::count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Active Bookings</h5>
                                    <p class="card-text display-4">{{ \App\Models\Booking::where('status', 'pending')->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Partners</h5>
                                    <p class="card-text display-4">{{ \App\Models\Partner::count() }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Total Companies</h5>
                                    <p class="card-text display-4">{{ \App\Models\Company::count() }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <h4>Recent Bookings</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>User</th>
                                        <th>Partner</th>
                                        <th>Booking Time</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Booking::with('user', 'partner')->latest()->take(10)->get() as $booking)
                                    <tr>
                                        <td>{{ $booking->user->name }}</td>
                                        <td>{{ $booking->partner->name }}</td>
                                        <td>{{ $booking->booking_time->format('Y-m-d H:i') }}</td>
                                        <td>
                                            <span class="badge bg-{{ $booking->status === 'pending' ? 'warning' : ($booking->status === 'completed' ? 'success' : 'danger') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
