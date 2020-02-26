@extends('layouts.full-screen')

@section('content')
<div class="loginBox register-page">
    <a href="{{ route('register') }}" class="left top-reg-nav"><img src="{{ asset('images/thin-arrow.png') }}" alt="arrow pointing left"/> GO BACK</a>
    @if($role === 'sitter')
    <a href="{{ route('register.role', 'parent') }}" class="right top-reg-nav">I'M A PARENT</a>
    @elseif($role === 'parent')
    <a href="{{ route('register.role', 'sitter') }}" class="right top-reg-nav">I'M A SITTER</a>
    @endif
    <h2>Tell Us a Little About Yourself ({{ $role }})</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
    <form class="register" action="{{ route('register') }}" method="post">
        @csrf
        <div class="register-field">
            <label>First Name
                <input type="text" class="inline @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" autocomplete="given-name" autofocus>
                @error('first_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
        </div>

        <div class="register-field">
            <label>Last Name
                <input type="text" class="inline @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" autocomplete="family-name" autofocus>
                @error('last_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
        </div>

        <div class="register-field city">
            <label>City
                <input type="text" name="city" value="{{ old('city') }}" class="inline @error('city') is-invalid @enderror" autocomplete="address-level2">
                @error('city')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
        </div>
        <div class="register-field state">
            <label>State
                <div class="select-wrapper">
                    @include('dropins/form/stateSelect')
                </div>
                @error('region')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
            <!--select-wrapper-->
        </div>
        <!--city-state-->

        <div class="register-field">
            <label>Email Address
                <input type="email" class="inline @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email">
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
        </div>

        <div class="register-field">
            <label>Phone
                <input type="tel" class="inline @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="tel">
                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
        </div>

        @if($role === 'sitter')
        <div class="register-field dob">
            <label for="dob-month">Date of Birth</label>
            <div class="dob-wrapper
                @if($errors->has('dob_month') || $errors->has('dob_day') || $errors->has('dob_year'))
                is-invalid
                @endif
            ">
                <div class="select-wrapper dob-select">
                    @include('dropins/form/monthSelect')
                </div>
                <div class="select-wrapper dob-select">
                    @include('dropins/form/daySelect')
                </div>
                <div class="select-wrapper dob-select">
                    @include('dropins/form/yearSelect')
                </div>
            </div>
            @if($errors->has('dob_month') || $errors->has('dob_day') || $errors->has('dob_year'))
            <span class="invalid-feedback full-width-feedback" role="alert">
                @error('dob_month')
                <strong>{{ $message }}</strong>
                @enderror
                @error('dob_day')
                <strong>{{ $message }}</strong>
                @enderror
                @error('dob_year')
                <strong>{{ $message }}</strong>
                @enderror
            </span>
            @endif
        </div>
        @endif

        <div class="register-field">
            <label>Password
                <input type="password" class="inline @error('password') is-invalid @enderror" name="password">
            </label>
        </div>

        <div class="register-field">
            <label>Confirm Password
                <input type="password" class="inline @error('password_confirmation') is-invalid @enderror" name="password_confirmation">
                @error('password_confirmation')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </label>
        </div>
        @error('password')
        <span class="invalid-feedback full-width-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror

        <input type="hidden" name="role" value="{{ $role }}">
        <input type="hidden" name="validator" value="{{ bcrypt($role . csrf_token()) }}">

        <div class="btn-container">
            <button class="btn-outline dash-btn" href="{{ route('register.role', 'parent') }}">CANCEL</button>
            <button class="btn dash-btn" type="submit">NEXT</button>
        </div>
    </form>
    <!--loginoptions-->

</div>
<!--loginBox-->
@endsection
