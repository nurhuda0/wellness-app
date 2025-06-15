@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Partners Directory') }}</div>

                <div class="card-body">
                    <div class="row">
                        @foreach($partners as $partner)
                            <div class="col-md-4 mb-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $partner->name }}</h5>
                                        <p class="card-text">{{ $partner->description }}</p>
                                        <p class="card-text"><strong>City:</strong> {{ $partner->city }}</p>
                                        <p class="card-text"><strong>Type:</strong> {{ $partner->type }}</p>
                                        <a href="{{ route('partners.show', $partner) }}" class="btn btn-primary">View Details</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
