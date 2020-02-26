@extends('layouts.dashboard')

@section('search-bar')
<div class="sitter-dash search admin-filter-bar">
    <div class="container">
        <h2 class="left">Administrative Dashboard</h2>
        {{--                <div class="status-wrapper right">--}}
        {{--                    <label>Global Filter</label>--}}

        {{--                    <h4 class="right filter-btn">This Week <i class="im im-care-down"></i></h4>--}}
        {{--                    <div class="filter-dropdown">--}}
        {{--                        <button>This Week</button>--}}
        {{--                        <button>This Month</button>--}}
        {{--                        <button>This Quarter</button>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        <div class="space"></div>
    </div>
</div>
@endsection

@section('content')
<div class="content">
    <div class="container admin-dash">
        <!-- START: New & Active Users -->
        <div class="two-section">
            @include('dropins.app.dashblocks.admin.newSignups')
            @include('dropins.app.dashblocks.admin.activeUsers')
        </div>
        <!-- END: New & Active Users -->

    </div>
</div>
@endsection
