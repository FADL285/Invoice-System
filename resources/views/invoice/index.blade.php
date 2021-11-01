@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <p>Index Page</p>
                        <p>locale: {{ config('app.locale') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
