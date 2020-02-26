@php
    $navLinks = array();
    if (Auth::user()->hasRole('admin')) {
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Users'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Bookings'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'User Payments'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Background Checks'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Revenue'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Reviews'
        ));
    } elseif (Auth::user()->hasRole('sitter')) {
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Calendar'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Bookings'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Invoices & Payments'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Reviews'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Support'
        ));
        array_push($navLinks, (object)array(
            'href' => route('profile.self.edit'),
            'text' => 'Profile'
        ));
    } elseif (Auth::user()->hasRole('parent')) {
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Calendar'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Bookings'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Invoices & Payments'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Reviews'
        ));
        array_push($navLinks, (object)array(
            'href' => '#',
            'text' => 'Support'
        ));
        array_push($navLinks, (object)array(
            'href' => route('profile.self.edit'),
            'text' => 'Profile'
        ));
    }
@endphp<header>
    <nav>
        <div class="container">
            <h1><a href="{{ route('index') }}">@include('dropins/svg/logo')</a></h1>

            <div id="myNav" class="overlay">
                <a href=""><img src="{{ asset('images/logo.svg') }}" class="hamlogo" alt="hamburger menu" /></a>
                <a href="javascript:void(0)" class="closebtn">&times;</a>

                <div class="overlay-content-top">
                    <a href="{{ route('profile.self') }}"><img class="somepadding navatar" src="{{ asset('images/parentprofile-pic.png') }}" alt="profile picture"/></a>
                </div>

                <div class="overlay-content">
                    @foreach($navLinks as $navLink)
                    <a href="{{ $navLink->href }}" @isset($navLink->class) class="{{ $navLink->class }}" @endisset >{{ $navLink->text }}</a>
                    @endforeach
                    <a href="{{ route('logout') }}" class="logout-link">Logout</a>
                </div>
            </div><!-- #myNav -->

            <span id="ham" style="font-size:30px;cursor:pointer">&#9776;</span>

            <div class="nav-left">
                <div class="nav-top">
                    <a href="{{ route('profile.self') }}"><img class="somepadding navatar" src="{{ asset('images/parentprofile-pic.png') }}" alt="profile picture"/></a>
                    <a href="{{ route('logout') }}" class="btn btn-logout somepadding logout-link"><i class="im im-sign-out"></i><span class="text">Logout</span></a>
                </div>
                <ul class="nav-bottom">
                @foreach($navLinks as $navLink)
                    <li><a href="{{ $navLink->href }}" @isset($navLink->class) class="{{ $navLink->class }}" @endisset >{{ $navLink->text }}</a></li>
                @endforeach
                </ul>
            </div><!-- .nav-left -->
        </div>
    </nav>
</header>
