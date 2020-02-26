@extends('layouts.full-screen')

@section('content')
    <div class="loginBox register-page">
        <a href="{{ route('logout') }}" class="right top-reg-nav logout-link"><i class="im im-sign-out"></i> LOGOUT</a>

        <h2>Tell Us a Little About Yourself</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

        <form method="POST" action="{{ route('user.select-role', [Auth::user()]) }}" class="btn-container select-role-form">
            @method('PATCH')
            @csrf
            <input type="hidden" name="role" value="">
            <button type="button" class="btn dash-btn role-submit" data-role="sitter">I'M A SITTER</button>
            <button type="button" class="btn-outline dash-btn role-submit" data-role="parent">I'M A PARENT</button>
        </form>
        @include('dropins.form.logoutForm')
    </div>
    <!--loginBox-->
@endsection
