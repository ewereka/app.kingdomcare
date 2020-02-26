@extends('layouts.dashboard', ['bodyClass' => 'sticky'])

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
                        <button data-href="#PayInfo" class="push-right">&#187;</button>
                    </h3>

                    <h3 class="inactivebig bigpay">
                        <button data-href="#PersonalInfo" class="push-left">&#171;</button>
                        <span data-href="#PayInfo" class="inactive tablinks underline payinfotab">Payment Information</span>
                        <button data-href="#AccInfo" class="push-right">&#187;</button>
                    </h3>

                    <h3 class="inactivebig bigacc" >
                        <button data-href="#PayInfo" class="push-left">&#171;</button>
                        <span data-href="#AccInfo" class="inactive tablinks underline accinfotab">Account Information</span>
                        <button data-href="#BackInfo" class="push-right">&#187;</button>
                    </h3>

                    <h3 class="inactivebig bigback" >
                        <button data-href="#AccInfo" class="push-left">&#171;</button>
                        <span data-href="#BackInfo" class="inactive tablinks underline backinfotab">Background Status</span>
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

                                <label for="field_journey">Tell us a little bit about your journey with Christ</label>
                                <textarea class="simple-mce" id="field_journey" name="journey">{{ $profile->journey }}</textarea>
                            </div>

                            <div class="profile-inforight">
                                <h2>Babysitting</h2>

                                <label for="childName" class="phone">Years of Experience & Relevant Experience</label>
                                <textarea class="simple-mce" required name="experience_description">{{ $profile->experience_description }}</textarea>

                                <label for="field_video_resume">Video Resume URL (YouTube or Vimeo)</label>
                                <input type="text" id="field_video_resume" name="video_resume" class="inline" value="{{ $profile->video_resume }}">

                                <label for="standard_hourly_rate">Standard Hourly Rate</label>
                                <div class="money-wrapper">
                                    <input type="number" id="standard_hourly_rate" name="standard_hourly_rate" class="inline money" min="0.00" step="0.01" value="{{ $profile->standard_hourly_rate }}" placeholder="0.00">
                                </div>

                                <div class="loginOptions register-form  register-child">
                                    <div id="childContainer">
                                        <div id="child_1">
                                            <label>Age Groups You Have The Most Experience With</label>
                                            <div class="cAge" id="sitter-cAge">
                                                <input type="hidden" name="experience_infant" value="0">
                                                <label for="sitterInfant1" id="sitterInfantlabel1">
                                                    <input type="checkbox" class="imagetoggle" name="experience_infant"
                                                           id="sitterInfant1" value="1" @if($profile->experience_infant) checked @endif >
                                                    @include('dropins.svg.infant-icon')
                                                    <p class="radiolabel">Infant</p>
                                                </label>

                                                <input type="hidden" name="experience_toddler" value="0">
                                                <label for="sitterToddler1" id="sitterToddlerlabel1">
                                                    <input type="checkbox" class="imagetoggle" name="experience_toddler"
                                                           id="sitterToddler1" value="1" @if($profile->experience_toddler) checked @endif >
                                                    @include('dropins.svg.toddler-icon')
                                                    <p class="radiolabel">Toddler</p>
                                                </label>

                                                <input type="hidden" name="experience_school_age" value="0">
                                                <label for="sitterSchoolAge1" id="sitterSchoolAgelabel1">
                                                    <input type="checkbox" class="imagetoggle" name="experience_school_age"
                                                           id="sitterSchoolAge1" value="1" @if($profile->experience_school_age) checked @endif >
                                                    @include('dropins.svg.school-age-icon')
                                                    <p class="radiolabel">School Age</p>
                                                </label>
                                            </div><!-- cAge -->
                                        </div><!-- child_1 -->
                                    </div><!-- childContainer -->
                                </div><!-- register-child -->
                            </div>

                            <h2>Special Eperience</h2>
                            <fieldgroup class="checky-group columns">
                                <input type="hidden" name="experience_add_adhd" value="0">
                                <label for="experience_add_adhd" class="checky">
                                    <input type="checkbox" name="experience_add_adhd"
                                           id="experience_add_adhd" value="1" @if($profile->experience_add_adhd) checked @endif >
                                    <span>{{ getExperienceNiceName("experience_add_adhd") }}</span>
                                </label>

                                <input type="hidden" name="experience_asd" value="0">
                                <label for="experience_asd" class="checky">
                                    <input type="checkbox" name="experience_asd"
                                           id="experience_asd" value="1" @if($profile->experience_asd) checked @endif >
                                    <span>{{ getExperienceNiceName("experience_asd") }}</span>
                                </label>

                                <input type="hidden" name="experience_visually_impaired" value="0">
                                <label for="experience_visually_impaired" class="checky">
                                    <input type="checkbox" name="experience_visually_impaired"
                                           id="experience_visually_impaired" value="1" @if($profile->experience_visually_impaired) checked @endif >
                                    <span>{{ getExperienceNiceName("experience_visually_impaired") }}</span>
                                </label>

                                <input type="hidden" name="experience_hearing_impaired" value="0">
                                <label for="experience_hearing_impaired" class="checky">
                                    <input type="checkbox" name="experience_hearing_impaired"
                                           id="experience_hearing_impaired" value="1" @if($profile->experience_hearing_impaired) checked @endif >
                                    <span>{{ getExperienceNiceName("experience_hearing_impaired") }}</span>
                                </label>

                                <input type="hidden" name="experience_developmental" value="0">
                                <label for="experience_developmental" class="checky">
                                    <input type="checkbox" name="experience_developmental"
                                           id="experience_developmental" value="1" @if($profile->experience_developmental) checked @endif >
                                    <span>{{ getExperienceNiceName("experience_developmental") }}</span>
                                </label>

                                <input type="hidden" name="experience_behavioral" value="0">
                                <label for="experience_behavioral" class="checky">
                                    <input type="checkbox" name="experience_behavioral"
                                           id="experience_behavioral" value="1" @if($profile->experience_behavioral) checked @endif >
                                    <span>{{ getExperienceNiceName("experience_behavioral") }}</span>
                                </label>

                                <input type="hidden" name="experience_down_syndrome" value="0">
                                <label for="experience_down_syndrome" class="checky">
                                    <input type="checkbox" name="experience_down_syndrome"
                                           id="experience_down_syndrome" value="1" @if($profile->experience_down_syndrome) checked @endif >
                                    <span>{{ getExperienceNiceName("experience_down_syndrome") }}</span>
                                </label>

                                <input type="hidden" name="experience_seizures" value="0">
                                <label for="experience_seizures" class="checky">
                                    <input type="checkbox" name="experience_seizures"
                                           id="experience_seizures" value="1" @if($profile->experience_seizures) checked @endif >
                                    <span>{{ getExperienceNiceName("experience_seizures") }}</span>
                                </label>
                            </fieldgroup>

                            <div class="btn-container" id="personal-btns">
                                <button class="btn-outline">Cancel</button>
                                <button type="submit" class="btn" id="save-personal">Save</button>
                            </div>
                        </div>

                        <div class="space"></div>
                    </form>
                </div><!--PersonalInfo-->

                <div id="PayInfo" class="tabcontent">

                </div><!-- PayInfo -->

                <div id="AccInfo" class="tabcontent">

                </div><!--accinfo-->

                <div id="BackInfo" class="tabcontent">

                </div><!--payinfo-->

            </div><!--contentblock-->
        </div><!--container-->
    </div><!--content-->
@endsection
