@extends('layouts.app')

@section('content')
    <script>
        Pusher.logToConsole = true;

        var pusher = new Pusher('a289aedfa2621be51a99', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('contact-request');
        channel.bind('contact-request-created', function(data) {
            alert(JSON.stringify(data));
        });
    </script>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Blog::greet(auth()->user()->name) }}

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
