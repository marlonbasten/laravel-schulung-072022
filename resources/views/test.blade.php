@extends('layouts.app')

@section('title')
    <h1>Blog</h1>
@endsection

@section('content')

    {{$name }}

    @if ($age >= 18)
        <p>Du darfst Alkohol kaufen!</p>
    @elseif($age >= 16)
        <p>Du darfst Bier kaufen!</p>
    @else
        <p>Du gehörst hier nicht hin!</p>
    @endif

    <ul>
        @foreach ($users as $user)
            <li>{{ $user }}</li>
        @endforeach
    </ul>

@endsection
