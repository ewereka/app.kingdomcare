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

                    <h2>Tell Us a Little Bit About Your Family</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                    <div class="loginOptions register-form  register-child" action="" method="post">
                        <div id="childContainer">
                            <div id="child0" class="clone">
                                <i class="im im-x-mark iGone"></i>
                                <label class="wrap-label">Child's Name
                                    <input type="text" name="children[0][name]" data-will-require="children[0][age]">
                                </label>
                                <label class="phone">Child's Age</label>
                                <radiogroup class="cAge">
                                    <label data-name="age-child">
                                        <input type="radio" name="children[0][age]" value="infant">
                                        @include('dropins.svg.infant-icon')
                                        <p class="radiolabel">Infant</p>
                                    </label>

                                    <label data-name="age-child">
                                        <input type="radio" name="children[0][age]" value="toddler">
                                        @include('dropins.svg.toddler-icon')
                                        <p class="radiolabel">Toddler</p>
                                    </label>

                                    <label data-name="age-child">
                                        <input type="radio" name="children[0][age]" value="school_age">
                                        @include('dropins.svg.school-age-icon')
                                        <p class="radiolabel">School Age</p>
                                    </label>
                                </radiogroup>
                            </div>
                        </div>
                        <!--cAge-->


                    </div>
                    <!--loginoptions-->
                    <div class="btn-container">
                        <button type="button" class="btn-outline addchild">ADD ANOTHER CHILD</button>
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
                                  maxlength="1200" class="simple-mce"></textarea>
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
