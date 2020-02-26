@extends('layouts.app')

@section('content')
<div class="loginBox">
    <h2>{{ __('Verify Your Email Address') }}</h2>

    <p>Before proceeding, please check your email for a verification link.</p>
    <p>If you did not receive the email:</p>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A new verification link has been sent to your email address.') }}
        </div>
    @endif


    <form action="{{ route('verification.resend') }}" method="POST" class="loginType forgotpass">
        @csrf

        <input class="login-btn btn" type="submit" name="submit" value="RESEND VERIFICATION EMAIL">
    </form>
</div>
@endsection
