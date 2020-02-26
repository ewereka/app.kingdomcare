@extends('layouts.dashboard')

@section('search-bar')
    <div class="dash search">
        <div class="container">
            <h2>Your Next Sitter is Just a Couple Clicks Away!</h2>
            <form action="" method="">
                <div class="dash-search-wrapper">


                    <div class="date-wrapper selectwrap">
                        <input type="text" name="date" class="datepicker" placeholder="Date Needed" onfocus="this.placeholder=''" onblur="this.placeholder='Date Needed'" autocomplete="off"></div>
                    <div class="number-wrapper selectwrap">
                        <select size=1 onmousedown="if(this.options.length>5){this.size=5;}"  onchange='this.size=1;' onblur="this.size=1;" autocomplete="off">
                            <option value="" selected># of Children</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6+</option>
                        </select></div>
                    <div class="rate-wrapper selectwrap">
                        <select size=1 onmousedown="if(this.options.length>3){this.size=4;}"  onchange='this.size=1;' onblur="this.size=1;" autocomplete="off">
                            <option value="" selected>Rate Range</option>
                            <option>$0-$10</option>
                            <option>$10-$20</option>
                            <option>$20-$30</option>
                            <option>$30+</option>
                        </select></div>
                    <div class="location-wrapper selectwrap">
                        <input type="text" name="location" placeholder="Zip Code" onfocus="this.placeholder=''" onblur="this.placeholder='Zip Code" autocomplete="off"></div>
                    <div class="current-location-wrapper selectwrap">
                        <p><a href="#">Current Location</a></p>
                        <input type="hidden" name="locLat">
                        <input type="hidden" name="locLng"></div>
                    <button type="submit" class="search-submit">Search</button>
                </div>
            </form>
        </div>
        <div class="space"></div>
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="container dash-container sitter">
            <div class="left-dash">
                <div class="singleblock">
                    @include('dropins.app.dashblocks.global.recentNotifications')

                    <div class="calendar left">
                        <div class="dncalendar-container"></div>
                    </div><!--calendar-->



                </div>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script>
        $(".dncalendar-container").dnCalendar({
            dataTitles: { defaultDate: 'default', today : 'Today' },
            dayUseShortName: true,
            // notes: [
            //     { "date": "2020-02-23", "href": "http://www.google.com" },
            //     { "date": "2020-02-28", "note": [" "] }
            // ],
            // showNotes: true,
        }).build();
        // my_calendar.build();
        // $(".note").on("click", function(){
        //     $(".calendar").append('<div class="cal-pop"> <h3>2/23/20</h3><p>Janet is scheduled to watch Johnny at 3pm</p><a href="#">View Details</a></div>');
        //
        // });
    </script>
@endsection
