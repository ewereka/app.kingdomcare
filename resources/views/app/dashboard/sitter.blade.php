@extends('layouts.dashboard')

@section('search-bar')
    <div class="sitter-dash search">
        <div class="container">
            <h2 class="left">Dashboard</h2>
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
        <div class="container dash-container sitter">
            <div class="left-dash">
                <div class="tripleblock">
                    @include('dropins.app.dashblocks.sitter.income')
                    @include('dropins.app.dashblocks.sitter.bookings')
                    @include('dropins.app.dashblocks.sitter.familiesServed')
                </div>

                <div class="singleblock">
                    @include('dropins.app.dashblocks.global.recentNotifications')
                </div>
            </div>
        </div>
    </div>
@endsection
