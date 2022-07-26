@extends('layouts.app')

@section('title')
    <p>{{ __('general.contact_us', ['country' => 'Deutschland']) }}</p>
@endsection

@section('content')

    {{ config('blog.blog_name') }}

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
            <select name="category_id">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select><br>
            <input type="text" name="name" value="{{ old('name') }}"><br>
            <input type="text" name="email" value="{{ old('email') }}"><br>
            <textarea name="message">{{ old('message') }}</textarea><br><br>
            <input type="submit" value="Kontaktieren">
        </form>
    @else
        <h3>Dieses Land ist ungültig.</h3>
    @endif

@endsection
