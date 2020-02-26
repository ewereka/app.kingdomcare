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
                    @if ($profile->averageRating !== null)
                    <div class="starrr read-only" data-rating="{{ $profile->averageRating }}"></div>
                    <p class="scrollhide">({{ $profile->reviewsReceived->count() }} {{Str::plural('Review', $profile->reviewsReceived->count())}})</p>
                    @else
                    <p class="scrollhide">(No Reviews)</p>
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
{{--                <a class="tablinks" href="#Reviews">Reviews</a>--}}
                <a class="tablinks" href="{{ route('profile.self.edit') }}">Edit</a>
            </div>
        </div>
    </div><!--search-->

@endsection

@section('content')
    <div class="content clear">
        <div class="container sitter-profile">
            <div id="About"  class="tabcontent active">
                <div class="content-block profile-info aboutbox">
                    <h3 class="left">About {{ $profile->first_name }}</h3>
                    @isset($profile->video_resume)
                    <h3 class="right">Video Interview</h3>
                    @endisset
                    <hr>

                    <div class="para @isset($profile->video_resume) left @endisset">
                        {!! $profile->about !!}

                        @isset($profile->journey)
                        <h4>Journey with Christ</h4>
                        {!! $profile->journey !!}
                        @endisset
                    </div>

                    @isset($profile->video_resume)
                        @php
                            $videoResume = $profile->getVideoResumeEmbed();
                        @endphp
                    <div class="right vid">
                        <h4>Video Interview</h4>

                        <div class="oembed" data-image="{{ $videoResume->image }}" data-aspect-ratio="{{ $videoResume->aspectRatio }}">
                            <svg class="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 79.78 79.04"><defs></defs><title>playbutton</title><circle class="z" cx="44.17" cy="43.43" r="35.61"/><circle class="b" cx="38.88" cy="38.88" r="37.38"/><polygon class="c" points="26.23 24.97 26.23 53.87 53.48 39.54 26.23 24.97"/></svg>
                            <div class="video">{!! $videoResume->code !!}</div>
                        </div>

                    </div>
                    @endisset
                    <div class="space"></div>





                </div><!--contentblock-->
                <div class="content-block profile-info babyexp">
                    <h3 class="left">Babysitting Experience</h3>
                    <hr>
                    <div class="babytext">
                        {!! $profile->experience_description !!}
                    </div>

                    <div class="left">
                        <h4>Age Range</h4>
                        @if ($profile->experience_infant || $profile->experience_toddler || $profile->experience_school_age)
                        <div class="icons">
                            @if ($profile->experience_infant)
                            <div class="icon">
                                <svg version="1.1" id="_ÎÓÈ_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 67.1 67.1" style="enable-background:new 0 0 67.1 67.1;" xml:space="preserve">
									<style type="text/css">
                                        .wow2{fill:#FFFFFF;}
                                        .wow{fill:#BCB0C4;}
                                    </style>

                                    <g id="icon">

                                        <title>infant-icon</title>
                                        <path class="wow" d="M28.6,32c-0.7,0-1.3-0.6-1.3-1.3s0.6-1.3,1.3-1.3s1.3,0.6,1.3,1.3l0,0C29.8,31.4,29.3,32,28.6,32z M28.6,30.6
									C28.5,30.6,28.5,30.7,28.6,30.6C28.5,30.8,28.6,30.8,28.6,30.6C28.7,30.7,28.6,30.6,28.6,30.6L28.6,30.6L28.6,30.6z"/>
                                        <path class="wow" d="M37.7,32c-0.7,0-1.3-0.6-1.2-1.3s0.6-1.3,1.3-1.2c0.7,0,1.2,0.6,1.2,1.2C39,31.4,38.5,32,37.7,32
									C37.7,32,37.7,32,37.7,32z M37.7,30.6C37.6,30.6,37.6,30.7,37.7,30.6C37.6,30.8,37.8,30.8,37.7,30.6C37.8,30.7,37.8,30.6,37.7,30.6
									L37.7,30.6L37.7,30.6z"/>
                                        <path class="wow" d="M33.5,40.5c-2.5,0-4.5,2-4.5,4.5s2,4.5,4.5,4.5c2.3,0,4.1-1.7,4.4-3.9c0-0.1,0-0.1,0-0.2c0-0.1,0-0.3,0-0.4
									l0,0C38,42.5,36,40.5,33.5,40.5z M33.5,41.7c0.4,0,0.8,0.1,1.2,0.2c-0.8,0.1-1.6,0.1-2.4,0C32.7,41.8,33.1,41.7,33.5,41.7z
									 M33.5,48.3c-1.4,0-2.5-0.8-3-2c1,0.2,2,0.3,3,0.3s2-0.1,3-0.3C36,47.5,34.9,48.3,33.5,48.3z M30.2,45c0-0.8,0.3-1.6,0.8-2.1
									c0.8,0.3,1.6,0.4,2.5,0.4c0.8,0,1.7-0.1,2.5-0.4c0.5,0.6,0.8,1.3,0.8,2.1C34.6,45.6,32.4,45.6,30.2,45z"/>
                                        <path class="wow" d="M48.2,28.8c-0.5,0-1,0.1-1.5,0.4c-0.6-2.2-1.8-4.3-3.5-5.9l1.2,0.1c0.2,0,0.5-0.1,0.6-0.4
									c1.1-2.8-1-5.6-1.1-5.8c-0.2-0.2-0.5-0.3-0.8-0.2l-4.9,2.5c-0.1-0.3-0.4-0.5-0.7-0.4l-1.3,0.3l0,0c-0.9-0.2-1.8-0.3-2.6-0.3l0,0
									c-1.9-0.2-3.6-1.1-4.9-2.5c-0.1-0.1-0.2-0.3-0.3-0.5c-0.2-0.6,0.2-1.2,0.8-1.4c0.3-0.1,0.6,0,0.9,0.1l0.4,0.2l0,0
									c0.3,0.2,0.6,0.1,0.8-0.2c0.2-0.3,0.1-0.7-0.2-0.8l-0.4-0.2c0,0,0,0-0.1,0c-1.1-0.6-2.6-0.2-3.2,0.9c-0.5,0.9-0.4,2,0.4,2.8
									s1.7,1.5,2.7,2c-0.6,0.1-1.3,0.3-1.9,0.6h-1.1c-0.3,0-0.6,0.2-0.6,0.5c0,0,0,0.1,0,0.3c-3.2,1.8-5.6,4.8-6.6,8.3
									c-0.4-0.3-1-0.4-1.5-0.4c-1.9,0-3.4,1.8-3.4,4.1s1.5,4.1,3.4,4.1c0.5,0,1-0.1,1.5-0.4c1,3.7,3.6,6.8,7,8.6c0.1,3.4,2.8,6.2,6.3,6.2
									c3.4,0,6.2-2.8,6.3-6.2c3.4-1.8,5.9-4.9,7-8.6c0.4,0.3,0.9,0.4,1.5,0.4c1.9,0,3.4-1.8,3.4-4.1S50.1,28.8,48.2,28.8z M43.3,18.3
									c0.7,1.1,1,2.4,0.8,3.8l-4.5-0.3l1.4-0.2c0.1,0,0.2,0,0.3-0.1c0.3-0.2,0.4-0.5,0.3-0.8s-0.5-0.4-0.8-0.3l-2.2,0.3l0,0L43.3,18.3z
									 M37.8,22.3l-1.9,0.5l-0.5-2l2-0.4L37.8,22.3z M34.1,21.4L31.6,22l0,0c-0.3,0.1-0.5,0.4-0.4,0.7c0.1,0.3,0.3,0.5,0.6,0.5h0.1
									l2.7-0.6l-5.3,2.7c-1-0.9-1.1-2.8-1.1-4L34.1,21.4z M38.6,45c0,2.8-2.3,5.1-5.1,5.1s-5.1-2.3-5.1-5.1s2.3-5.1,5.1-5.1
									S38.6,42.2,38.6,45L38.6,45z M29.4,39.7c0-1.3,1.9-2.3,4.2-2.3s4.2,1,4.2,2.3c0,0.2,0,0.4-0.1,0.5c-1.1-1-2.5-1.5-4.1-1.5
									c-1.5,0-3,0.6-4.1,1.5C29.4,40,29.4,39.9,29.4,39.7z M48.2,35.7c-0.5,0-1-0.2-1.4-0.6c-0.2-0.2-0.4-0.2-0.6-0.2
									c-0.2,0.1-0.4,0.2-0.4,0.5c-0.7,3.6-3,6.6-6.1,8.4c-0.2-1-0.6-1.9-1.2-2.6c0.3-0.4,0.4-0.9,0.4-1.4c0-2-2.4-3.5-5.4-3.5
									s-5.4,1.5-5.4,3.5c0,0.5,0.2,1,0.4,1.4c-0.6,0.8-1,1.7-1.2,2.7C24.2,42,22,39,21.2,35.4c0-0.2-0.2-0.4-0.4-0.5
									c-0.2-0.1-0.4,0-0.6,0.2c-0.4,0.4-0.9,0.6-1.4,0.6c-1.2,0-2.2-1.3-2.2-2.9c0-1.6,1-2.9,2.2-2.9c0.6,0,1.1,0.3,1.4,0.7
									c0.2,0.2,0.4,0.2,0.6,0.2c0.2-0.1,0.4-0.2,0.4-0.4c0.7-3.4,2.7-6.3,5.6-8.1c0.1,1.4,0.5,3.3,1.9,4.2c0.1,0.1,0.2,0.1,0.3,0.1
									c0.1,0,0.2,0,0.3-0.1l5.4-2.7c0,0.1,0.1,0.3,0.3,0.3c0.1,0.1,0.2,0.1,0.3,0.1s0.1,0,0.1-0.1l3.1-0.8c0.2-0.1,0.3-0.2,0.4-0.4
									l2.3,0.2c2.3,1.8,3.9,4.4,4.4,7.3c0,0.2,0.2,0.4,0.4,0.5s0.4,0,0.6-0.2c0.4-0.4,0.9-0.6,1.4-0.7c1.2,0,2.2,1.3,2.2,2.8
									C50.5,34.4,49.5,35.7,48.2,35.7z"/>
                                        <path class="wow" d="M20.7,34.1c-0.3,0-0.6-0.3-0.6-0.6v-1c0-0.3,0.3-0.6,0.6-0.6s0.6,0.3,0.6,0.6l0,0v1
									C21.3,33.8,21.1,34.1,20.7,34.1z"/>
                                        <path class="wow" d="M46.4,34.2L46.4,34.2c-0.4,0-0.6-0.3-0.6-0.6l0,0l0.1-1.2c0-0.3,0.3-0.6,0.7-0.5c0.3,0,0.6,0.3,0.6,0.6l0,0
									L47,33.7C47,34,46.7,34.2,46.4,34.2z"/>
                                    </g>
							</svg><p>Infant</p></div>
                            @endif

                            @if ($profile->experience_toddler)
                            <div class="icon">
                                <svg id="_ÎÓÈ_1" data-name="—ÎÓÈ_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 68 68"><defs>
                                        <style>.cls-1{fill:#bcb0c4;}</style></defs><title>toddler-icon_1</title><path class="cls-1" d="M25.19,28.6A3.78,3.78,0,0,0,29,32.38h11a3.78,3.78,0,0,0,3.77-3.78v-11a3.77,3.77,0,0,0-3.77-3.77H29a3.77,3.77,0,0,0-3.77,3.77ZM29,15.08h11a2.55,2.55,0,0,1,2.55,2.55v11a2.56,2.56,0,0,1-2.55,2.56H29a2.56,2.56,0,0,1-2.55-2.56v-11A2.55,2.55,0,0,1,29,15.08Z"/><path class="cls-1" d="M33.82,37.13a3.77,3.77,0,0,0-3.77-3.77h-11a3.77,3.77,0,0,0-3.77,3.77v11a3.78,3.78,0,0,0,3.77,3.78h11a3.78,3.78,0,0,0,3.77-3.78ZM30.05,50.66h-11a2.56,2.56,0,0,1-2.56-2.56v-11a2.56,2.56,0,0,1,2.56-2.56h11a2.56,2.56,0,0,1,2.56,2.56v11A2.56,2.56,0,0,1,30.05,50.66Z"/><path class="cls-1" d="M53.6,37.13a3.78,3.78,0,0,0-3.78-3.77h-11a3.77,3.77,0,0,0-3.77,3.77v11a3.78,3.78,0,0,0,3.77,3.78h11A3.79,3.79,0,0,0,53.6,48.1ZM49.82,50.66h-11A2.56,2.56,0,0,1,36.3,48.1v-11a2.56,2.56,0,0,1,2.55-2.56h11a2.56,2.56,0,0,1,2.56,2.56v11A2.56,2.56,0,0,1,49.82,50.66Z"/><path class="cls-1" d="M29.17,23a4.73,4.73,0,0,0,8.41,3,2.26,2.26,0,0,0,2.21,1.76,2.15,2.15,0,0,0,.75-.13l.41-.14a.61.61,0,0,0-.4-1.15l-.41.14a1.06,1.06,0,0,1-1.41-1v-5a.61.61,0,0,0-1.09-.37A4.72,4.72,0,0,0,29.17,23Zm4.73-3.51A3.51,3.51,0,1,1,30.39,23,3.51,3.51,0,0,1,33.9,19.51Z"/><path class="cls-1" d="M27.83,42.08H24.68a.61.61,0,0,0,0,1.21h2.48a3.51,3.51,0,1,1-3.45-4.12,3.56,3.56,0,0,1,2.23.8.59.59,0,0,0,.85-.08.61.61,0,0,0-.08-.86,4.73,4.73,0,1,0,1.72,3.65A.6.6,0,0,0,27.83,42.08Z"/><path class="cls-1" d="M47.51,42.37a2.52,2.52,0,0,0,.9-1.93,2.55,2.55,0,0,0-2.55-2.54H40.78a.61.61,0,0,0-.61.6v8.23a.62.62,0,0,0,.61.61h5.08a2.55,2.55,0,0,0,2.55-2.55v-.48A2.56,2.56,0,0,0,47.51,42.37Zm-6.12-3.26h4.47a1.33,1.33,0,0,1,0,2.66H41.39Zm5.8,5.68a1.33,1.33,0,0,1-1.33,1.33v0H41.39V43h4.47a1.34,1.34,0,0,1,1.33,1.33Z"/></svg><p>Toddler</p></div>
                            @endif

                            @if ($profile->experience_school_age)
                            <div class="icon">
                                <svg id="_ÎÓÈ_1" data-name="—ÎÓÈ_1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 68.31 68.31">
                                    <defs><style>.cls-1{fill:#bcb0c4;}</style></defs><title>toddler-icon</title><path class="cls-1" d="M48.49,44.22a2,2,0,1,0-2-2A2,2,0,0,0,48.49,44.22Zm0-2.8a.79.79,0,0,1,0,1.58.79.79,0,0,1,0-1.58Z"/><path class="cls-1" d="M50,24h-.93a5.63,5.63,0,0,0-3.22,1,4.34,4.34,0,0,1-2.51.79H41.76a2.07,2.07,0,1,0,0,4.13h3.32a1.85,1.85,0,0,1-.25.32c-.66.67-1.74,2-2.36,2.73a20.13,20.13,0,0,0-13.28-7.1.6.6,0,0,1-.52-.62l.09-1.77a1.36,1.36,0,0,1,.76-1.16,1.35,1.35,0,0,0,.76.25l.2,0,4.62-.7A2.09,2.09,0,0,0,36.52,21a2.13,2.13,0,0,0-2-3.36l-4.73.69a1.4,1.4,0,0,0-.9.55s-.05.1-.08.16a4.82,4.82,0,0,0-3.41,4.4l-.15,3H23.79a3,3,0,0,0-2.72-1.78H19.78a.61.61,0,0,0-.61.61v.43a2.09,2.09,0,0,0-1.28,1.92,2.06,2.06,0,0,0,1.28,1.92v.44a.61.61,0,0,0,.61.61h1.29a3,3,0,0,0,2.72-1.78H25.1L25,31.22a8.95,8.95,0,1,0,3.38.16l0-.79a.6.6,0,0,1,.22-.43.59.59,0,0,1,.45-.13c2.76.37,9.46,1.92,12.08,8.47a3.22,3.22,0,0,0,1.59,1.72,6,6,0,0,0-.34,2,6.08,6.08,0,1,0,2.68-5,.51.51,0,0,1-.37-.34.69.69,0,0,1,.08-.65,43.71,43.71,0,0,1,3.22-4A3.68,3.68,0,0,0,49.1,30H50A3,3,0,0,0,50,24ZM33,19.14,33.24,21l-1.09.16-.34-1.8Zm1.71-.25h.13a.9.9,0,0,1,.89.75.88.88,0,0,1-.15.69.86.86,0,0,1-.61.37l-.47.08L34.16,19Zm-4.8.73a.15.15,0,0,1,.06,0l.68-.1.34,1.81-.65.1h0a.11.11,0,0,1-.1-.08l-.34-1.61A.11.11,0,0,1,29.86,19.62ZM20.39,26h.68a1.75,1.75,0,0,1,0,3.49h-.68Zm-1.22,1.43V28a.78.78,0,0,1-.06-.31A.81.81,0,0,1,19.17,27.39Zm8.76,12.88L28,38.52a2.34,2.34,0,1,1-4.1,1.55,2.33,2.33,0,0,1,.74-1.7l-.08,1.74A1.66,1.66,0,0,0,25,41.35a1.68,1.68,0,0,0,2.89-1.08Zm6.06-.2a7.73,7.73,0,1,1-9-7.61l-.21,4.4A3.56,3.56,0,1,0,28.1,37l.21-4.4A7.72,7.72,0,0,1,34,40.07Zm19.35,2.14a4.86,4.86,0,1,1-4.85-4.85A4.86,4.86,0,0,1,53.34,42.21ZM47.16,31.35a43,43,0,0,0-3.34,4.11,1.92,1.92,0,0,0-.25,1.81,1.83,1.83,0,0,0,.53.74,6,6,0,0,0-.83,1.11,2,2,0,0,1-1-1.07c-2.86-7.15-10.09-8.84-13.06-9.23a1.82,1.82,0,0,0-1.4.4,1.87,1.87,0,0,0-.65,1.31l-.48,9.68a.46.46,0,0,1-.45.44.41.41,0,0,1-.33-.15.42.42,0,0,1-.13-.33l.78-16.64a3.64,3.64,0,0,1,2-3.08l.24.9a2.57,2.57,0,0,0-1.29,2.12l-.09,1.77a1.82,1.82,0,0,0,1.61,1.9A18.84,18.84,0,0,1,42,34.37a.61.61,0,0,0,.48.24.58.58,0,0,0,.49-.23s1.83-2.31,2.75-3.22A3,3,0,0,0,46.41,30h1.46A2.52,2.52,0,0,1,47.16,31.35ZM50,28.74H41.76a.84.84,0,1,1,0-1.68h1.62a5.67,5.67,0,0,0,3.21-1,4.4,4.4,0,0,1,2.52-.79H50a1.74,1.74,0,1,1,0,3.47Z"/><path class="cls-1" d="M17,26.52h.14a.59.59,0,0,0,.59-.46.61.61,0,0,0-.45-.74L16,25a.61.61,0,0,0-.28,1.19Z"/><path class="cls-1" d="M14.88,28a.62.62,0,0,0,.61.62h1.32a.62.62,0,1,0,0-1.23H15.49A.62.62,0,0,0,14.88,28Z"/>
                                </svg><p>School Age</p></div>
                            @endif
                        </div><!--icons-->
                        @endif

                        @isset($profile->standard_hourly_rate)
                        <p><strong>Hourly Rate: </strong>${{ $profile->standard_hourly_rate }}/hr</p>
                        @endisset

                    </div><!--left-->
                    <div class="right">
                        @if ($profile->hasSpecialExperience())
                        <h4>Special Experience</h4>
                        {!! $profile->buildSpecialExperience() !!}
                        @endif
                    </div><!--right-->

                    <div class="space"></div>
                </div><!--contentblock-->



            </div><!--about-->

            <div id="Reviews"  class="tabcontent">
                <div class="content-block">
                    <h3 class="left">Jennifer's Reviews</h3>
                    <hr>
                    <div class="flexrow-1">
                        <div class="rateleft">
                            <div class="starrr"></div>
                            <p class="ratenum">(123)</p>
                            <p> <strong>4</strong> out of <strong>5</strong> Stars</p>
                        </div><!--rateleft-->
                    </div><!--flexrow1--><hr>
                    <div class="review-single">
                        <div class="review-info">
                            <div class="img-wrapper">
                                <img src="images/profileimg.jpg" class="circle-clip" alt="profile picture"/>
                            </div>
                            <div class="review-name">
                                <h6>Samantha Ashley</h6>
                                <div class="starrr"></div>
                                <p>April 14, 2018</p></div>
                        </div><!--reviewinfo-->
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p><hr>
                    </div><!--reviewsingle-->

                    <div class="review-single">
                        <div class="review-info">
                            <div class="img-wrapper">
                                <img src="images/profileimg.jpg" class="circle-clip" alt="profile picture"/>
                            </div>
                            <div class="review-name">
                                <h6>Samantha Ashley</h6>
                                <div class="starrr"></div>
                                <p>April 14, 2018</p></div>
                        </div><!--reviewinfo-->
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p><hr>
                    </div><!--reviewsingle-->

                    <div class="review-single">
                        <div class="review-info">
                            <div class="img-wrapper">
                                <img src="images/profileimg.jpg" class="circle-clip" alt="profile picture"/>
                            </div>
                            <div class="review-name">
                                <h6>Samantha Ashley</h6>
                                <div class="starrr"></div>
                                <p>April 14, 2018</p></div>
                        </div><!--reviewinfo-->
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p><hr>
                    </div><!--reviewsingle-->


                    <div class="review-single">
                        <div class="review-info">
                            <div class="img-wrapper">
                                <img src="images/profileimg.jpg" class="circle-clip" alt="profile picture"/>
                            </div>
                            <div class="review-name">
                                <h6>Samantha Ashley</h6>
                                <div class="starrr"></div>
                                <p>April 14, 2018</p></div>
                        </div><!--reviewinfo-->
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p><hr>
                    </div><!--reviewsingle-->



                </div><!--contentblock-->
            </div>
        </div><!--container-->
    </div>
@endsection
