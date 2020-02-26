@extends('layouts.dashboard', ['bodyClass' => 'sticky'])

@section('search-bar')
    <div class="search sprofile">
        <div class="container">
            <div class="left">
                <div class="img-wrapper">
                    <img class="parent-profile" src="{{ asset('images/parentprofile-pic.png') }}" alt="profile picture"/>
                </div>
                <div class="sitterinfo">
                    <h2>{{ $profile->first_name }} {{ $profile->last_name }}</h2>
                    @if ($profile->city || $profile->region)
                    <p class="loc">{{ $profile->city }}, {{ $profile->region }}</p><br>
                    @endif
                    @if ($profile->hasChildren())
                    {{ $profile->buildChildIcons() }}
                    @endif
                </div>
            </div><!--left-->
            <div class="right">
            </div>
            <div class="space"></div>
        </div><!--container-->
        <div class="sitter-tab">
            <div class="tab-contain">
                <div class="leftspace"></div><!--space-->
                <a class="tablinks active" href="#About">Profile</a>
                <a class="tablinks" href="{{ route('profile.self.edit') }}">Edit</a>
            </div>
        </div>
    </div><!--search-->

@endsection

@section('content')
    <div class="content clear">
        <div class="container sitter-profile parent-profile">
            <div id="About"  class="tabcontent active">
                <div class="content-block profile-info aboutbox">
                    <h3 class="left">About the Family</h3>
                    <hr>
                    <div class="clear para">
                        {!! $profile->about !!}

                        @isset($profile->journey)
                            <h4>Journey with Christ</h4>
                            {!! $profile->journey !!}
                        @endisset
                    </div>
                    <div class="space"></div>
                </div><!--contentblock-->
            </div><!--about-->
    </div>
@endsection
