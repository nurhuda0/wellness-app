@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $partner->name }}</div>

                <div class="card-body">
                    <p class="card-text"><strong>Description:</strong> {{ $partner->description }}</p>
                    <p class="card-text"><strong>City:</strong> {{ $partner->city }}</p>
                    <p class="card-text"><strong>Type:</strong> {{ $partner->type }}</p>

                    @if(auth()->check())
                        <a href="{{ route('bookings.create', ['partner' => $partner->id]) }}" class="btn btn-success">Book Session</a>
                    @endif

                    @if($partner->courses->count() > 0)
                        <h4>Courses</h4>
                        <div class="list-group">
                            @foreach($partner->courses as $course)
                                <div class="list-group-item">
                                    <h5>{{ $course->title }}</h5>
                                    <p><strong>Coach:</strong> {{ $course->coach }}</p>
                                    <p><strong>Age Group:</strong> {{ $course->age_group }}</p>
                                    <p><strong>Time:</strong> {{ $course->start_time->format('Y-m-d H:i') }} - {{ $course->end_time->format('Y-m-d H:i') }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
