@extends('layouts.app')

@section('title')
    <p>Kontaktiere uns!</p>
@endsection

@section('content')

    @if(session('message'))
        <p style="color: green;">{{ session('message') }}</p>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p style="color: red;">{{$error}}</p>
        @endforeach
    @endif

    @if(in_array($country, $countryList))
        <form action="{{ route('sendFormular') }}" method="POST">
            @csrf
            <input type="text" name="name" value="{{ old('name') }}"><br>
            <input type="text" name="email" value="{{ old('email') }}"><br>
            <textarea name="message">{{ old('message') }}</textarea><br><br>
            <input type="submit" value="Kontaktieren">
        </form>
    @else
        <h3>Dieses Land ist ungültig.</h3>
    @endif

@endsection
