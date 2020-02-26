@extends('layouts.full-screen')

@section('content')
<div class="loginBox">
    <h2>Forgot Your Password?</h2>
    <p>Forgot password? No problem! We will send you and email with instructions to reset your password.</p>

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form action="{{ route('password.email') }}" method="POST" class="loginType forgotpass">
        @csrf

        <input class="text-field @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="email address" autofocus>
        @error('email')
        <div class="invalid-feedback" role="alert">{{ $message }}</div>
        @enderror

        <input class="login-btn btn" type="submit" name="submit" value="SEND">
        <a href="{{ route('login') }}" class="btn-outline"> CANCEL </a>

        <div class="space"></div>
    </form>
</div>
@endsection
