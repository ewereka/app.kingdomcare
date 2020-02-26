<div class="dashblock signups">
    <h3 class="left">New Signups</h3>
{{--    <h4 class="right filter-btn">This Week <i class="im im-care-down"></i></h4>--}}
{{--    <div class="filter-dropdown">--}}
{{--        <button>This Week</button>--}}
{{--        <button>This Month</button>--}}
{{--        <button>This Quarter</button>--}}
{{--    </div><!--filter-dropdown-->--}}
    <hr>
    <div class="contentcontain"><div class="bignum">{{ $currentNewSignups }}</div>
        <div class="rightside">
            <div class="newparents">
                @include('dropins.svg.dashicon-parents')
                <h6><strong>{{ $currentNewParents }}</strong> Parents</h6>
            </div><!--newparents-->
            <div class="newsitters">
                @include('dropins.svg.dashicon-sitters')
                <h6><strong>{{ $currentNewSitters }}</strong> Sitters</h6>
            </div><!--newsitters-->
            <div class="space"></div>

            <div class="statpercent">
                @if(isset($newSignupsDelta) && isset($newSignupsTimeline))
                    @if(is_int($newSignupsDelta))
                        @if($newSignupsDelta > 0)
                            @include('dropins.svg.greenarrow')
                            <p class="statup"><strong>Up {{ $newSignupsDelta }}% </strong>from previous {{ $newSignupsTimeline }}</p>
                        @elseif($newSignupsDelta < 0)
                            @include('dropins.svg.redarrow')
                            <p class="statdown"><strong>Down {{ abs($newSignupsDelta) }}% </strong>from previous {{ $newSignupsTimeline }}</p>
                        @elseif($newSignupsDelta === 0)
                            <p><strong>No change </strong>from previous {{ $newSignupsTimeline }}</p>
                        @endif
                    @else
                        <p><strong>Can't calculate </strong>change from previous {{ $newSignupsTimeline }}</p>
                    @endif
                @else
                    <p>&nbsp;</p>
                @endif
            </div><!--statpercent-->

        </div><!--rightside-->
    </div><!--contentcontain-->

    <a href="#" class="btn">View Full Report </a>
</div>
