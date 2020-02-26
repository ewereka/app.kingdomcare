@extends('layouts.app')

@section('content')
<div class="loginBox">
    <h2>Confirm Password</h2>
    <p>Please confirm your password before continuing.</p>

    <form action="{{ route('password.confirm') }}" method="POST" class="loginType forgotpass">
        @csrf

        <input class="text-field @error('password') is-invalid @enderror" type="password" name="password" placeholder="password" required autocomplete="current-password" autofocus>
        @error('password')
        <div class="invalid-feedback" role="alert">{{ $message }}</div>
        @enderror

        <input class="login-btn btn" type="submit" name="submit" value="CONFIRM PASSWORD">
        @if (Route::has('password.request'))
        <a href="{{ route('password.request') }}">I Forgot my Password</a>
        @endif
    </form>
</div>
@endsection
