@extends('layouts.full-screen')

@section('content')
    <!-- Slideshow container -->
    <form method="POST" action="{{ route('user.update', Auth::user()) }}" class="slideshow-container">
        {{ csrf_field() }}
        {{ method_field('patch') }}
        {{ modelkey_field(Auth::user()) }}

        <input type="hidden" value="1" name="registration_complete">

        <!-- Full-width images with number and caption text -->
        <div class="mySlides">
            <div class="container">
                <div class="loginBox register-page">
                    <div class="left top-reg-nav">&nbsp;</div>

                    <h2>Tell Us a Little Bit About Your Experience</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                    <div class="loginOptions register-form register-child">
                        <div id="childContainer">
                            <div id="child_1">
                                <i class="im im-x-mark iGone"></i>
                                <label for="childName" class="phone">Years of Experience & Relevant Experience</label>
                                <textarea required name="experience_description">{{ Auth::user()->experience_description }}</textarea>

                                <label>Age Groups You Have The Most Experience With</label>
                                <div class="cAge" id="sitter-cAge">
                                    <input type="hidden" name="experience_infant" value="0">
                                    <label for="sitterInfant1" id="sitterInfantlabel1">
                                        <input type="checkbox" class="imagetoggle" name="experience_infant"
                                               id="sitterInfant1" value="1" @if(Auth::user()->experience_infant) checked @endif >
                                        @include('dropins.svg.infant-icon')
                                        <p class="radiolabel">Infant</p>
                                    </label>

                                    <input type="hidden" name="experience_toddler" value="0">
                                    <label for="sitterToddler1" id="sitterToddlerlabel1">
                                        <input type="checkbox" class="imagetoggle" name="experience_toddler"
                                               id="sitterToddler1" value="1" @if(Auth::user()->experience_toddler) checked @endif >
                                        @include('dropins.svg.toddler-icon')
                                        <p class="radiolabel">Toddler</p>
                                    </label>

                                    <input type="hidden" name="experience_school_age" value="0">
                                    <label for="sitterSchoolAge1" id="sitterSchoolAgelabel1">
                                        <input type="checkbox" class="imagetoggle" name="experience_school_age"
                                               id="sitterSchoolAge1" value="1" @if(Auth::user()->experience_school_age) checked @endif >
                                        @include('dropins.svg.school-age-icon')
                                        <p class="radiolabel">School Age</p>
                                    </label>
                                </div><!-- cAge -->
                            </div><!-- child_1 -->
                        </div><!-- childContainer -->
                    </div><!-- register-child -->
                    <!--loginoptions-->
                    <div class="btn-container">
                        <button type="button" class="btn next-slide verify-slide">NEXT</button>
                    </div>
                </div>
                <!--loginBox-->
            </div>
            <!--container-->
        </div>
        <!--slide-->

        <div class="mySlides">
            <div class="container">
                <div class="loginBox register-page">
                    <div class="left top-reg-nav prev-slide"><img src="{{ asset('images/thin-arrow.png') }}" alt="arrow pointing left"/> GO BACK
                    </div>

                    <h2>Tell Us a Little Bit About<br>Your Walk with Christ</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                    <div class="loginOptions register-form">
                        <textarea type="message" name="journey"
                            value="{{ Auth::user()->journey }}"
                            placeholder="You can enter a maximum of 1,200 characters here..."
                            maxlength="1200"></textarea>
                    </div>
                    <!--loginoptions-->
                    <div class="btn-container">
                        <button type="submit" class="btn">GO TO DASHBOARD</button>
                    </div>
                </div>
                <!--loginBox-->
            </div>
            <!--container-->
        </div>
        <!--slide-->
    </form>
@endsection

@section('extra-scripts')
    <script type="text/javascript" src="{{ asset('js/hammer-slider.js') }}"></script>
@endsection
