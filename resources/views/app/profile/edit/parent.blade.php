@extends('layouts.dashboard', ['bodyClass' => 'sticky'])

@php
    $tempChildrenBirthYears = array('' => 'Year');
    $currentYear = date('Y');
    $minChildrenBirthYear = $currentYear - 18;
    for ($i = $currentYear; $i > $minChildrenBirthYear; $i--) {
        $tempChildrenBirthYears[sprintf('%d', $i)] = sprintf('%d', $i);
    }
    $currentChildren = json_decode($profile->children);
    $currentChildrenCount = 0;
    if (is_array($currentChildren)) {
        $currentChildrenCount = count($currentChildren);
    }

@endphp

@section('search-bar')
    <div class="search sitter-dash">
        <div class="container">
            <h2>My Profile</h2>
            <div class="space"></div>
        </div><!--container-->
    </div><!--search-->
@endsection

@section('content')
    <div class="content">
        <div class="container sitter-search pprofile">
            <div class="content-block profile-info">
                <div class="profile-tabs tab">
                    <h3 class="activebig bigper">
                        <button> </button>
                        <span data-href="#PersonalInfo" class="tablinks underline pinfotab active">Personal Information</span>
                        <button data-href="#FamilyInfo" class="push-right">&#187;</button>
                    </h3>

                    <h3 class="inactivebig bigfam">
                        <button data-href="#PersonalInfo" class="push-left">&#171;</button>
                        <span data-href="#FamilyInfo" class="inactive tablinks underline payinfotab">Family Information</span>
                        <button data-href="#AccInfo" class="push-right">&#187;</button>
                    </h3>

                    <h3 class="inactivebig bigpay" >
                        <button data-href="#FamilyInfo" class="push-left">&#171;</button>
                        <span data-href="#PayInfo" class="inactive tablinks underline accinfotab">Payment Information</span>
                        <button data-href="#AccInfo" class="push-right">&#187;</button>
                    </h3>

                    <h3 class="inactivebig bigacc" >
                        <button data-href="#PayInfo" class="push-left">&#171;</button>
                        <span data-href="#AccInfo" class="inactive tablinks underline backinfotab">Account Information</span>
                        <button></button>
                    </h3>

                    <div class="o-block"></div>
                </div>
                <hr>

                <div id="PersonalInfo" class="tabcontent" style="display: block;">
                    <form action="{{ route('user.update', $profile) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        {{ modelkey_field(Auth::user()) }}
                        <div class="pinfo left">
                            <div class="btn-con">
                                <button class="newphoto">
                                    <img src="{{ asset('images/camera.svg') }}" alt="camera icon"/>
                                    <span>Add Photo</span>
                                </button>
                            </div>
                            <div class="img-wrapper">
                                <img class="parent-profile" src="{{ asset('images/parentprofile-pic.png') }}" alt="profile picture"/>
                            </div>
                            <div class="btn-con">
                                <button class="delphoto">
                                    <img src="{{ asset('images/trash.svg') }}" alt="trash can icon"/>
                                    <span>Remove Photo</span>
                                </button>
                            </div>
                        </div>

                        <div class="pinfo right">
                            <div class="profile-infoleft">
                                <label for="edit_first_name">First Name</label>
                                <input type="text" id="edit-first_name" name="first_name" value="{{ $profile->first_name }}">
                            </div>
                            <div class="profile-inforight">
                                <label for="lname">Last Name</label>
                                <input type="text" id="edit_last_name" name="last_name" value="{{ $profile->last_name }}">
                            </div>

                            <div class="profile-info">
                                <label for="edit_display_name">Display Name @isset($profile->last_name) (e.g. {{ $profile->last_name }} Family) @endisset</label>
                                <input type="text" id="edit-display_name" name="display_name" value="{{ $profile->display_name }}">
                            </div>

                            <div class="left citystate1">
                                <label for="edit_city">City</label>
                                <input type="text" id="edit_city" name="city" class="inline" value="{{ $profile->city }}">
                            </div><!-- citystate1 -->
                            <div class="right citystate2">
                                <label for="parent state">State</label>
                                <div class="select-wrapper">
                                    @include('dropins/form/stateSelect', ['stateValue' => $profile->region])
                                </div>
                            </div><!--citystate2-->
                        </div><!-- pinfo.right -->

                        <div class="pinfo full">
                            <div class="profile-infoleft">
                                <h2>About</h2>

                                <label for="field_about">Tell us a little bit about yourself.</label>
                                <textarea class="simple-mce" id="field_about" name="about">{{ $profile->about }}</textarea>
                            </div>

                            <div class="profile-inforight">
                                <h2>Journey with Christ</h2>

                                <label for="field_journey">Tell us a little bit about your journey with Christ</label>
                                <textarea class="simple-mce" id="field_journey" name="journey">{{ $profile->journey }}</textarea>
                            </div>

                            <div class="btn-container" id="personal-btns">
                                <button class="btn-outline">Cancel</button>
                                <button type="submit" class="btn" id="save-personal">Save</button>
                            </div>
                        </div>

                        <div class="space"></div>
                    </form>
                </div><!--PersonalInfo-->

                <div id="FamilyInfo" class="tabcontent">
                    <form action="{{ route('user.update', $profile) }}" method="post" class="update-children">
                        {{ csrf_field() }}
                        {{ method_field('patch') }}
                        {{ modelkey_field(Auth::user()) }}
                        <h4>Children</h4>

                        <div class="loginOptions standard-content register-form register-child">
                            <div id="childContainer" @if($currentChildrenCount > 0) data-record-index="{{ $currentChildrenCount - 1 }}"@endif>
                                @foreach($currentChildren as $childKey=>$child)
                                    @php
                                        $tempGender = property_exists($child, 'gender') ? $child->gender : null;
                                        $tempAge = property_exists($child, 'age') ? $child->age : null;
                                    @endphp
                                <div id="child{{ $childKey }}" class="clone">
                                    <i class="im im-x-mark @if($childKey === 0) iGone @endif "></i>
                                    <div class="profile-info" style="margin-bottom: 1rem;">
                                        <label class="wrap-label">Child's Name
                                            <input type="text" name="children[{{ $childKey }}][name]" data-will-require="children[{{ $childKey }}][age]" value="{{ $child->name }}">
                                        </label>
                                    </div>

                                    <div class="profile-infoleft">
                                        <label class="wrap-label disable-click">Child's Gender
                                            <radiogroup class="radiogroup">
                                                <label class="container" id="maleLabel">
                                                    <input type="radio" name="children[{{ $childKey }}][gender]"
                                                       value="male" @if($tempGender === 'male') checked @endif>
                                                    <span class="checkmark"></span>
                                                    <p>Male</p>
                                                </label>

                                                <label class="container" id="femaleLabel">
                                                    <input type="radio" name="children[{{ $childKey }}][gender]"
                                                       value="female" @if($tempGender === 'female') checked @endif>
                                                    <span class="checkmark"></span>
                                                    <p>Female</p>
                                                </label>
                                            </radiogroup>
                                        </label>
                                    </div>
                                    <div class="profile-inforight">
                                        <div class="register-field dob">
                                            <label class="wrap-label">Date of Birth
                                                <div class="dob-wrapper">
                                                    <div class="select-wrapper dob-select">
                                                        {{ Form::select('children['.$childKey.'][dob_month]', array(
                                                            '' => 'Month',
                                                            '01' => '1',
                                                            '02' => '2',
                                                            '03' => '3',
                                                            '04' => '4',
                                                            '05' => '5',
                                                            '06' => '6',
                                                            '07' => '7',
                                                            '08' => '8',
                                                            '09' => '9',
                                                            '10' => '10',
                                                            '11' => '11',
                                                            '12' => '12'
                                                        ), (property_exists($child, 'dob_month') ? $child->dob_month : null), array(
                                                            'class' => 'select',
                                                            'size' => 1,
                                                            'onmousedown' => 'if(this.options.length>3){this.size=3;}',
                                                            'onchange' => 'this.size=1;',
                                                            'onblur' => 'this.size=1;')
                                                        ) }}
                                                    </div>
                                                    <div class="select-wrapper dob-select">
                                                        {{ Form::select('children['.$childKey.'][dob_day]', array(
                                                            '' => 'Day',
                                                            '01' => '1',
                                                            '02' => '2',
                                                            '03' => '3',
                                                            '04' => '4',
                                                            '05' => '5',
                                                            '06' => '6',
                                                            '07' => '7',
                                                            '08' => '8',
                                                            '09' => '9',
                                                            '10' => '10',
                                                            '11' => '11',
                                                            '12' => '12',
                                                            '13' => '13',
                                                            '14' => '14',
                                                            '15' => '15',
                                                            '16' => '16',
                                                            '17' => '17',
                                                            '18' => '18',
                                                            '19' => '19',
                                                            '20' => '20',
                                                            '21' => '21',
                                                            '22' => '22',
                                                            '23' => '23',
                                                            '24' => '24',
                                                            '25' => '25',
                                                            '26' => '26',
                                                            '27' => '27',
                                                            '28' => '28',
                                                            '29' => '29',
                                                            '30' => '30',
                                                            '31' => '31'
                                                        ) , (property_exists($child, 'dob_day') ? $child->dob_day : null), array(
                                                            'class' => 'select',
                                                            'size' => 1,
                                                            'onmousedown' => 'if(this.options.length>3){this.size=3;}',
                                                            'onchange' => 'this.size=1;',
                                                            'onblur' => 'this.size=1;')
                                                        ) }}
                                                    </div>
                                                    <div class="select-wrapper dob-select">
                                                        {{ Form::select('children['.$childKey.'][dob_year]', $tempChildrenBirthYears ,
                                                        (property_exists($child, 'dob_year') ? $child->dob_year : null) , array(
                                                            'class' => 'select',
                                                            'size' => 1,
                                                            'onmousedown' => 'if(this.options.length>3){this.size=3;}',
                                                            'onchange' => 'this.size=1;',
                                                            'onblur' => 'this.size=1;')
                                                        ) }}
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>

                                    <radiogroup class="cAge" style="clear: both;">
                                        <label data-name="age-child">
                                            <input type="radio" name="children[{{ $childKey }}][age]"
                                               value="infant" @if($tempAge === 'infant') checked @endif>
                                            @include('dropins.svg.infant-icon')
                                            <p class="radiolabel">Infant</p>
                                        </label>

                                        <label data-name="age-child">
                                            <input type="radio" name="children[{{ $childKey }}][age]"
                                               value="toddler" @if($tempAge === 'toddler') checked @endif>
                                            @include('dropins.svg.toddler-icon')
                                            <p class="radiolabel">Toddler</p>
                                        </label>

                                        <label data-name="age-child">
                                            <input type="radio" name="children[{{ $childKey }}][age]"
                                               value="school_age" @if($tempAge === 'school_age') checked @endif>
                                            @include('dropins.svg.school-age-icon')
                                            <p class="radiolabel">School Age</p>
                                        </label>
                                    </radiogroup>
                                </div>
                                @endforeach
                            </div>
                            <!--cAge-->

                        </div>

                        <div class="btn-container">
                            <button type="button" class="btn-outline addchild">ADD ANOTHER CHILD</button>
                            <button type="submit" class="btn">SAVE</button>
                        </div>
                        <div class="space"></div>
                    </form>
                </div><!--familyinfo-->

                <div id="PayInfo" class="tabcontent">

                </div><!-- PayInfo -->

                <div id="AccInfo" class="tabcontent">

                </div><!--accinfo-->


                <div id="BackInfo" class="tabcontent">


                    <div class="back-passed">
                        <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24.49 24"><defs><style>.cls-1{fill:#bcb0c4;}.cls-2{fill:#1f1844;fill-rule:evenodd;}</style></defs><title>pay-check</title><circle class="cls-1" cx="13.48" cy="12.99" r="11.01"/><path class="cls-2" d="M12,0A12,12,0,1,1,0,12,12,12,0,0,1,12,0Zm0,1A11,11,0,1,1,1,12,11,11,0,0,1,12,1Zm7,7.46L10,18,5,12.16l.76-.65,4.27,5,8.24-8.75.73.69Z"/></svg>

                        <h4>Passed</h4>
                        <p>Congratulations! Your background check has been completed and you passed!</p>
                        <a href="#" class="btn">View Report</a>
                    </div><!--back-passed-->

                    <div class="back-notstarted">
                        <h4>You Have Not Started<br>a Background Check</h4>

                        <div class="btn-container">
                            <a href="#" class="btn go-prem">Go Premium</a>
                            <a href="premium.html" class="btn-outline">Learn More</a>
                        </div><!--btn-container-->
                    </div><!--back-notstarted-->
                </div><!--payinfo-->

            </div><!--contentblock-->
        </div><!--container-->
    </div><!--content-->
@endsection
