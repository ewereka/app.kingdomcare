@extends('layouts.dashboard', ['bodyClass' => 'admin', 'hasAPI' => true])

@section('search-bar')
    <div class="booking search admin-user">
        <div class="container">
            <h2>Users</h2>
            <div class="booking-search-wrapper">
                <div class="name-wrapper">
                    <label for="sitterName">Name</label>
                    <input class="filter" type="text" name="name" placeholder="Type Name Here..." onfocus="this.placeholder=''" onblur="this.placeholder='Type Name Here...'">
                    <button type="button"><i class="im im-magnifier"></i></button>
                </div>

                <div class="status-wrapper">
                    <label for="status">Status</label>
                    <select class="filter" id="status" name="status" size=1 onmousedown="if(this.options.length>1){this.size=4;}"  onchange='this.size=1;' onblur="this.size=1;">
                        <option value="" selected>All Statuses</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>

                <div class="type-wrapper">
                    <label for="typefilter">Account Type</label>
                    <select class="filter" id="typefilter" name="type" size=1 onmousedown="if(this.options.length>1){this.size=5;}"  onchange='this.size=1;' onblur="this.size=1;">
                        <option value="" selected>All Types</option>
                        <option value="parent">Parent</option>
                        <option value="sitter">Sitter</option>
                        <option value="admin">Administrator</option>
                        <option value="unknown">Unknown</option>
                    </select>
                </div>

            </div>
            <div class="space" style="margin-top: .5rem;"></div>
        </div>
        <div class="space container button-wrapper"><div class="add-invoice-contain">
                <div class="add-invoice">+<h6 class="btn-text">Add User</h6> </div>
        </div></div>
    </div>
@endsection

@section('content')
    <div class="content">
        <div class="container sitter-search admin-user">

            <div class="content-block bookings admin-user-page">
                <h3 class="left">All Users</h3>
                <div class="sortby">
                    <h4 class="right dropbtn">Sort by <i class="im im-care-down"></i></h4>
                    <div class="dropdown-content myDropdown">
                        <button class="a-z">Alphabetical (A-Z)</button>
                        <button class="z-a">Alphabetical (Z-A)</button>
                        <button class="past-pres">Past - Present</button>
                        <button class="pres-pass">Present - Past</button>
                        <button class="l2h">Type</button>
                        <button class="for-stat">Active - Cancelled </button>
                        <button class="back-stat">Cancelled - Active </button></div>

                </div>
                <hr>
                <div class="table-container list">
                    <div class="flex-table header">
                        <div class="flex-row first sitter">
                            <div class="namecontain">
                                Name
                                <div class="name-arrow sortname">
                                    <div class="name-arrow-up arrow-up"></div><div class="name-arrow-down arrow-down"></div>
                                </div><!--namearrow-->
                            </div><!--namecontain-->
                        </div><!--flex-row-->
                        <div class="flex-row second bookingdate">
                            <div class="datecontain">
                                Created
                                <div class="name-arrow sortdate">
                                    <div class="date-arrow-up arrow-up"></div><div class="date-arrow-down arrow-down"></div>
                                </div><!--namearrow-->
                            </div><!--datecontain-->
                        </div><!--flex-row-->
                        <div class="flex-row third sortamount">
                            <div class="typecontain">
                                Type
                                <div class="name-arrow">
                                    <div class="amount-arrow-up arrow-up"></div><div class="amount-arrow-down arrow-down"></div>
                                </div><!--namearrow-->
                            </div><!--amountcontain-->
                        </div><!--flex-row-->
                        <div class="flex-row fourth statusbtn">
                            <div class="statcontain sortstat">Last Active
                                <div class="name-arrow sortstat">
                                    <div class="stat-arrow-up arrow-up"></div><div class="stat-arrow-down arrow-down"></div>
                                </div><!--namearrow-->
                            </div><!--statcontain-->
                        </div><!--flex-row-->
                        <div class="flex-row fourth-2 statusbtn">
                            <div class="active">Status
                                <div class="name-arrow sortstat">
                                    <div class="stat-arrow-up arrow-up"></div><div class="stat-arrow-down arrow-down"></div>
                                </div><!--namearrow-->
                            </div><!--statcontain-->
                        </div><!--flex-row-->

                        <div class="flex-row fifth"></div>
                    </div><!--header-->

                </div><!--table container-->

            </div><!--bookings-->

            <div class="space"></div>

        </div><!--container-->

    </div><!--content-->
@endsection

@section('overlays')
    <!-- START: Overlays -->
    <div class="content overlaybox overlay1 admin-user edituser-overlay">
        <div class="overlaybox-content profile-info">
            <h3 class="left">Edit User</h3>
            <hr>
            <div class="pinfo left">
                <div class="btn-con">
                    <!--<button class="newphoto"><img src="images/camera.svg" alt="camera icon"/> <span>Add Photo</span>--></div>
                <div class="img-wrapper">
                    <img class="parent-profile" src="images/parentprofile-pic.png" alt="profile picture"/></div>
                <div class="btn-con">
                    <button class="delphoto"><img src="images/trash.svg" alt="trash can icon"/><span>Remove Photo</span></button></div>
            </div>
            <div class="pinfo right">
                <form>
                    <input type="hidden" name="user">
                    <div class="profile-infoleft">
                        <label for="edit_first_name">First Name</label>
                        <input type="text" id="edit_first_name" name="first_name" autocomplete="off"></div>
                    <div class="profile-inforight">
                        <label for="edit_last_name">Last Name</label>
                        <input type="text" id="edit_last_name" name="last_name" autocomplete="off"></div>

                    <div class="date-wrapper clear">
                        <label for="edit_dob">Birthdate</label>
                        <input type="text" id="edit_dob" name="dob" class="birthdatepicker" autocomplete="off"></div>

                    <div class="left citystate1">
                        <label for="edit_city">City</label>
                        <input type="text" id="edit_city" name="city" class="inline" autocomplete="off">
                    </div>
                    <div class="right citystate2">
                        <label for="edit_region">State</label>
                        <div class="select-wrapper">
                            <select id="edit_region" name="region" class="inline" size=1 onmousedown="if(this.options.length>6){this.size=6;}"  onchange='this.size=1;' onblur="this.size=1;" value="PA" autocomplete="off">
                                <option value="">--</option>
                                <option value="AL">AL</option>
                                <option value="AK">AK</option>
                                <option value="AR">AR</option>
                                <option value="AZ">AZ</option>
                                <option value="CA">CA</option>
                                <option value="CO">CO</option>
                                <option value="CT">CT</option>
                                <option value="DC">DC</option>
                                <option value="DE">DE</option>
                                <option value="FL">FL</option>
                                <option value="GA">GA</option>
                                <option value="HI">HI</option>
                                <option value="IA">IA</option>
                                <option value="ID">ID</option>
                                <option value="IL">IL</option>
                                <option value="IN">IN</option>
                                <option value="KS">KS</option>
                                <option value="KY">KY</option>
                                <option value="LA">LA</option>
                                <option value="MA">MA</option>
                                <option value="MD">MD</option>
                                <option value="ME">ME</option>
                                <option value="MI">MI</option>
                                <option value="MN">MN</option>
                                <option value="MO">MO</option>
                                <option value="MS">MS</option>
                                <option value="MT">MT</option>
                                <option value="NC">NC</option>
                                <option value="NE">NE</option>
                                <option value="NH">NH</option>
                                <option value="NJ">NJ</option>
                                <option value="NM">NM</option>
                                <option value="NV">NV</option>
                                <option value="NY">NY</option>
                                <option value="ND">ND</option>
                                <option value="OH">OH</option>
                                <option value="OK">OK</option>
                                <option value="OR">OR</option>
                                <option value="PA">PA</option>
                                <option value="RI">RI</option>
                                <option value="SC">SC</option>
                                <option value="SD">SD</option>
                                <option value="TN">TN</option>
                                <option value="TX">TX</option>
                                <option value="UT">UT</option>
                                <option value="VT">VT</option>
                                <option value="VA">VA</option>
                                <option value="WA">WA</option>
                                <option value="WI">WI</option>
                                <option value="WV">WV</option>
                                <option value="WY">WY</option>
                            </select>
                        </div>
                        <!--select-wrapper-->
                    </div>
                    <!--city-state-->

                    <label for="edit_email" class="clear">Email Address</label>
                    <input id="edit_email" type="email" name="email" autocomplete="off">

                    <label for="edit_phone">Phone</label>
                    <input id="edit_phone" type="text" name="phone" autocomplete="off">

                    <label for="edit_video_resume">Video URL</label>
                    <input id="edit_video_resume" type="text" name="video_resume" autocomplete="off">

                </form>
            </div><!--pinfo right-->
            <div class="btns-left">
                <button class="btn-outline delprofile">Delete Permanently</button>
                <button class="reset">RESET PASSWORD</button>
            </div>
            <div class="btn-container">
                <button type="button" class="btn-outline close">Cancel</button>
                <button class="btn save">Save Changes</button></div><div class="space"></div>

        </div><!--paybox-->

    </div>

    <div class="content overlaybox overlay2 admin-user deluser-overlay">
        <div class="overlaybox-content">
            <h3 class="left">Delete User</h3>
            <hr>
            <img src="images/delprof.svg" alt="x icon"/>
            <h3>Are you sure you want to delete this user?</h3>

            <div class="btn-container">
                <button class="btn-outline close">Cancel</button>
                <button class="btn finaldel">Delete User</button>
            </div><!--btncontainer-->
        </div><!--overlaycontent-->

    </div><!--overlay2-->

    <div class="content overlaybox overlay3 admin-user delconfirmation">
        <div class="overlaybox-content">
            <h3 class="left">User Deleted</h3>
            <hr>

            <h3>The user has been deleted and removed from the database.</h3>

            <div class="btn-container">
                <button class="btn-outline close">Close</button>

            </div><!--btncontainer-->
            <div class="space"></div>
        </div><!--overlaycontent-->

    </div><!--overlay3-->

    <div class="content overlaybox overlay3 admin-user delconfirmation">
        <div class="overlaybox-content">
            <h3 class="left">User Deleted</h3>
            <hr>

            <h3>The user has been deleted and removed from the database.</h3>

            <div class="btn-container">
                <button class="btn-outline close">Close</button>

            </div><!--btncontainer-->
            <div class="space"></div>
        </div><!--overlaycontent-->

    </div><!--overlay3-->

    <div class="content overlaybox overlay5 admin-user resetpassword">
        <div class="overlaybox-content">
            <h3 class="left">Password Reset</h3>
            <hr>
            <img src="images/pay-check.svg" alt="checkmark icon"/>
            <h3>A password reset link has been emailed to the user.</h3>

            <div class="btn-container">
                <button class="btn-outline close">Close</button>

            </div><!--btncontainer-->
            <div class="space"></div>
        </div><!--overlaycontent-->

    </div><!--overlay2-->

    <div class="content overlaybox overlay5 admin-user savechanges">
        <div class="overlaybox-content">
            <h3 class="left">Edit User</h3>
            <hr>
            <img src="images/pay-check.svg" alt="checkmark icon"/>
            <h3>Changes to this user have been saved.</h3>

            <div class="btn-container">
                <button class="btn-outline close">Close</button>

            </div><!--btncontainer-->
            <div class="space"></div>
        </div><!--overlaycontent-->

    </div><!--overlay2-->
    <!-- END: Overlays -->
@endsection

@section('extra-scripts')
<style>
body.admin .search.admin-user .name-wrapper {
    display: flex-item;
    width: auto;
    flex-basis: 48%;
}

body.admin .search.admin-user .type-wrapper,
body.admin .search.admin-user .status-wrapper {
    display: flex-item;
    width: auto;
    flex-basis: 24%;
    margin-top: 0;
}

@media screen and (max-width: 750px) {
    body.admin .search.admin-user .type-wrapper,
    body.admin .search.admin-user .status-wrapper {
        margin-top: 2rem;
    }
}
</style>

<script>
$(document).ready(function() {
    var filterRequest = null;
    var userRequest = null;

    function getSortDate(date) {
        date = new Date(date);
        var string = date.getDate() + '/' +
            date.getMonth() + '/' +
            date.getFullYear();
        return string;
    }
    function getDisplayDate(date) {
        if (date !== null) {
            date = new Date(date);
            var string = date.getMonth() + '/' +
                date.getDate() + '/' +
                date.getFullYear();
        } else string = "---";
        return string;
    }
    function loadTable(data = null) {
        filterRequest = null;
        filterRequest = $.ajax({
            url: '/api/users',
            type: 'GET',
            data: data,
            headers: { 'Authorization' : 'Bearer ' + _BT }
        }).done(function(data) {
            if (typeof data === 'object') {
                if (data.hasOwnProperty('data')) {
                    if (typeof data.data === 'object') {
                        var users = data.data;
                        html = "";

                        $(users).each(function() {
                            primaryRole = 'Unknown';
                            primaryRoleID = 0;
                            if (this.attributes.hasOwnProperty('roles') && typeof this.attributes.roles === 'object' && this.attributes.roles.length > 0) {
                                primaryRole = this.attributes.roles[0].description;
                                primaryRoleID = this.attributes.roles[0].id;
                            }
                            switch(this.attributes.status) {
                                case "cancelled":
                                    status = '<div class="flex-row fourth status stat-con scheduled btn-outline" data-stat="3">' +
                                        '<img src="images/cancelled.svg"> Cancelled</div>\n';
                                    break;
                                case "inactive":
                                    status='<div class="flex-row fourth status stat-con awaiting-pay btn-outline" data-stat="2">' +
                                        '<img src="images/inactive.svg" alt="hour glass icon"> Inactive</div>\n';
                                    break;
                                case "active":
                                default:
                                    status='<div class="flex-row fourth status stat-con completed btn-outline" data-stat="1">' +
                                        '<img src="images/active.svg" alt="lightning bolt icon"> Active</div>\n';
                            }

                            html += '<div class="flex-table row list_item sortme">\n' +
                                '    <div class="flex-row first sitter-info">\n' +
                                '        <div class="img-wrapper">\n' +
                                '            <img class="circle-clip" src="images/profileimg.jpg" alt="profile image"/>\n' +
                                '        </div><!--imgwrapper-->\n' +
                                '        <h6 class="name">' + this.attributes.first_name + ' ' + this.attributes.last_name + '</h6>\n' +
                                '    </div>\n' +
                                '    <div class="flex-row second date" data-date="' + getSortDate(this.attributes.created_at) + '">\n' +
                                '        <div class="labelhide">Creation On: </div>\n' +
                                '        ' + getDisplayDate(this.attributes.created_at) + '\n' +
                                '    </div>\n' +
                                '    <div class="flex-row third type" data-type="' + primaryRoleID + '">' +
                                '        <div class="labelhide">\n' +
                                '            Type: ' +
                                '        </div>' +
                                '        ' + primaryRole + '\n' +
                                '    </div>\n' +
                                '    <div class="space"></div>\n' +
                                '\n' +
                                '    <div class="flex-row fourth-2 date2" data-date="' + getSortDate(this.attributes.last_active_at) + '">' +
                                '        <div class="labelhide">Last Active: </div>' +
                                '        ' + getDisplayDate(this.attributes.last_active_at) + '\n' +
                                '    </div>\n' +
                                '    ' + status +
                                '    <div class="flex-row fifth">\n' +
                                '        <a href="#" data-user="' + this.id + '" class="btn details edituser">View/Edit Profile</a>\n' +
                                '    </div>\n' +
                                '    <hr>\n' +
                                '</div><!--row-->'
                        });
                        $('.table-container.list').find('.list_item').remove();
                        $('.table-container.list').append(html);
                    }
                }
            }
        });
    }


    /* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
    $(".dropbtn").click(function(){
        $(this).next(".myDropdown").addClass("show");
    });

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
        var dropdowns = document.getElementsByClassName("dropdown-content");
        var i;
        for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.classList.contains('show')) {
            openDropdown.classList.remove('show');
        }
        }
    }
    }

    $('.namecontain').click(function(){
        showArrows();

        $(".labelclick").removeClass("labelclick");
        $(this).addClass("labelclick");

        if($(".sortname").hasClass('down') || $(".sortname").hasClass('start')){
            bigArrowUp();
            nameUp();
        } else {
            bigArrowDown();
            nameDown();
        }

    });

    $('.a-z').click(function(){
        $('.sortme').sort(alphaAscending).insertAfter('.header');
    });


    $('.z-a').click(function(){
        $('.sortme').sort(alphaDescending).insertAfter('.header');
    });


    $('.datecontain').click(function(){
        showArrows();

        $(".labelclick").removeClass("labelclick");
        $(this).addClass("labelclick");
        if($(".sortdate").hasClass('down') || $(".sortdate").hasClass('start')){
            bigArrowUp();
            dateUp();
        } else {
            bigArrowDown();
            dateDown();
        }
    });

    $('.past-pres').click(function() {
    $('.sortme').sort(sortDescending).insertAfter('.header');
    });


    $('.pres-pass').click(function() {
    $('.sortme').sort(sortAscending).insertAfter('.header');
    });



    $('.statcontain').click(function(){
        showArrows();

        $(".labelclick").removeClass("labelclick");
        $(this).addClass("labelclick");
        if($(".sortstat").hasClass('down') || $(".sortstat").hasClass('start')){
            statUp();
            bigArrowUp();
        } else {
            statDown();
            bigArrowDown();
        }
    });

    $('.for-stat').on('click', function () {
        $('.sortme').sort(statAscending).insertAfter('.header');

    });

    $('.back-stat').on('click', function () {
        $('.sortme').sort(statDescending).insertAfter('.header');

    });

    $('.typecontain').click(function(){
        showArrows();

        $(".labelclick").removeClass("labelclick");
        $(this).addClass("labelclick");
        if($(".type").hasClass('down') || $(".type").hasClass('start')){

            typeUp();
            bigArrowUp();
        } else {
            typeDown();
            bigArrowDown();
        }
    });

    $('.active').click(function(){
        showArrows();

        $(".labelclick").removeClass("labelclick");
        $(this).addClass("labelclick");
        if($(".active").hasClass('down') || $(".active").hasClass('start')){

            date2Up();
            bigArrowUp();
        } else {

            date2Down();
            bigArrowDown();
        }
    });

    $('.h2l').on('click', function () {
        $('.sortme').sort(amountAscending).insertAfter('.header');

    });

    $('.l2h').on('click', function () {
        $('.sortme').sort(amountDescending).insertAfter('.header');

    });





    // Filters
    $('input.filter, select.filter').on('change blur keyup', function(e) {
        filters = {};
        if ($('.filter[name=name]').val()) {
            filters.name = $('.filter[name=name]').val()
        }
        if ($('.filter[name=status]').val()) {
            filters.status = $('.filter[name=status]').val()
        }
        if ($('.filter[name=type]').val()) {
            filters.type = $('.filter[name=type]').val()
        }
        loadTable(filters);
    }).trigger('blur');

    // Overlays
    $(document).on('click', '.edituser', function(e) {
        var $edituser_overlay = $('.edituser-overlay');
        var $form = $edituser_overlay.find('form');
        var $button = $(this);
        var user_id = parseInt($button.data('user'));

        e.preventDefault();
        userRequest = null;
        $form.data('user', null).removeData('user').trigger('reset');

        if (!isNaN(user_id) && user_id > 0) {
            userRequest = $.ajax({
                url: '/api/users/' + user_id,
                type: 'GET',
                headers: {
                    'Authorization' : 'Bearer ' + _BT,
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            }).done(function(data) {
                if (typeof data === 'object') {
                    if (data.hasOwnProperty('data')) {
                        if (typeof data.data === 'object') {
                            var user = data.data;

                            if (user.hasOwnProperty('type') && user.type === 'users') {
                                $form.data('user', user.id);
                                $form.find('input[name=first_name]').val(user.attributes.first_name);
                                $form.find('input[name=last_name]').val(user.attributes.last_name);
                                $form.find('input[name=city]').val(user.attributes.city);
                                $form.find('select[name=region]').val(user.attributes.region);
                                $form.find('input[name=email]').val(user.attributes.email);
                                $form.find('input[name=phone]').val(user.attributes.phone);

                                if (typeof user.attributes.roles === 'object') {
                                    $(user.attributes.roles).each(function() {
                                        var role = this;
                                        if (role.name === 'sitter') {
                                            $form.find('input[name=video_resume]')
                                                .removeProp('disabled')
                                                .val(user.attributes.video_resume)
                                                .show().prev('label').show();
                                            $form.find('input[name=dob]')
                                                .removeProp('disabled')
                                                .datepicker('setDate', new Date(Date.parse(user.attributes.dob + 'T00:00:00')))
                                                .parents('.date-wrapper').show();
                                        } else {
                                            $form.find('input[name=video_resume]')
                                                .prop('disabled', true)
                                                .val('')
                                                .hide().prev('label').hide();
                                            $form.find('input[name=dob]')
                                                .prop('disabled', true)
                                                .val('')
                                                .parents('.date-wrapper').hide();
                                        }
                                    });
                                }

                                $edituser_overlay.addClass('show');
                            }
                        }
                    }
                }
            });
        }
    });

    $(document).on('click', '.close', function(e) {
        var $overlays = $('.overlaybox');
        var $form = $overlays.find('form');

        e.preventDefault();
        userRequest = null;
        $form.data('user', null).removeData('user').trigger('reset');
        $overlays.removeClass('show');
    });

    $(document).on('click', '.delprofile', function(e) {
        var $edituser_overlay = $('.edituser-overlay').removeClass('show');
        var $delprofile_overlay = $('.deluser-overlay').addClass('show');
        var $form = $edituser_overlay.find('form');
        var user_id = $form.data('user');
        var $finaldel_button = $delprofile_overlay.find('.finaldel');

        $finaldel_button.data('user', user_id);

        e.preventDefault();
        userRequest = null;
    });

    $(document).on('click', '.finaldel', function(e) {
        var $edituser_overlay = $('.edituser-overlay');
        var $delprofile_overlay = $('.deluser-overlay');
        var $confirm_overlay = $('.delconfirmation');
        var $form = $edituser_overlay.find('form');
        var $finaldel_button = $delprofile_overlay.find('.finaldel');

        var user_id = $finaldel_button.data('user');

        e.preventDefault();
        userRequest = null;
        userRequest = $.ajax({
            url: '/api/users/' + user_id + '/delete',
            type: 'GET',
            headers: {
                'Authorization' : 'Bearer ' + _BT,
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        }).done(function(data) {
            $('input.filter').trigger('change');
            $edituser_overlay.removeClass('show');
            $delprofile_overlay.removeClass('show');
            $confirm_overlay.addClass('show');
            $form.data('user', null).removeData('user').trigger('reset');
        });
    });

    $(document).on('click', '.save', function(e) {
        var $edituser_overlay = $('.edituser-overlay');
        var $savechanges_overlay = $('.savechanges');
        var $form = $edituser_overlay.find('form');
        var $button = $(this);
        var user_id = $form.data('user');

        e.preventDefault();
        userRequest = null;
        userRequest = $.ajax({
            url: '/api/users/' + user_id + '/update',
            type: 'PATCH',
            data: $form.serialize(),
            headers: {
                'Authorization' : 'Bearer ' + _BT,
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        }).done(function(data) {
            $('input.filter').trigger('change');
            $edituser_overlay.removeClass('show');
            $savechanges_overlay.addClass('show');
            $form.data('user', null).removeData('user').trigger('reset');
        });
    });

    $(document).on('click', '.reset', function(e) {
        var $edituser_overlay = $('.edituser-overlay');
        var $resetpassword_overlay = $('.resetpassword');
        var $form = $edituser_overlay.find('form');
        var user_id = $form.data('user');

        e.preventDefault();
        userRequest = null;
        userRequest = $.ajax({
            url: '/api/users/' + user_id + '/reset',
            type: 'GET',
            headers: {
                'Authorization' : 'Bearer ' + _BT,
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        }).done(function(data) {
            $('input.filter').trigger('change');
            $edituser_overlay.removeClass('show');
            $resetpassword_overlay.addClass('show');
            $form.data('user', null).removeData('user').trigger('reset');
        });
    });

});
</script>
@endsection
