<div class="dashblock users">
    <h3 class="left">Active Users</h3>
{{--    <h4 class="right filter-btn">This Week <i class="im im-care-down"></i></h4>--}}
{{--    <div class="filter-dropdown">--}}
{{--        <button>This Week</button>--}}
{{--        <button>This Month</button>--}}
{{--        <button>This Quarter</button>--}}
{{--    </div><!--filter-dropdown-->--}}
    <hr>
    <div class="contentcontain"><div class="bignum">{{ $activeUsers }}</div>
        <div class="rightside">
            <div class="newparents">
                @include('dropins.svg.dashicon-parents')
                <h6><strong>{{ $activeParents }}</strong> Parents</h6>
            </div><!--newparents-->
            <div class="newsitters">
                @include('dropins.svg.dashicon-sitters')
                <h6><strong>{{ $activeSitters }}</strong> Sitters</h6>
            </div><!--newsitters-->
            <div class="space"></div>
            <div class="statpercent">
                <p>&nbsp;</p>
            </div><!--statpercent-->
        </div><!--rightside-->
    </div><!--contentcontain-->

    <a href="#" class="btn">View Full Report </a>

</div><!--users-->
