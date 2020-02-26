@extends('layouts.full-screen')

@section('content')
    <div class="loginBox register-page">
        <a href="{{ route('login') }}" class="left top-reg-nav"><img src="{{ asset('images/thin-arrow.png') }}" alt="arrow pointing left"/> GO BACK</a>

        <h2>Tell Us a Little About Yourself</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>

        <div class="btn-container">
            <a class="btn dash-btn" href="{{ route('register.role', 'sitter') }}">I'M A SITTER</a>
            <a class="btn-outline dash-btn" href="{{ route('register.role', 'parent') }}">I'M A PARENT</a>
        </div>
    </div>
    <!--loginBox-->
@endsection
