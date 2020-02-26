window.bigArrowDown = function () {
    $(".clicked").removeClass("clicked");
    $(".labelclick").find(".arrow-down").addClass("clicked").hide();
    $(".labelclick").find(".arrow-up").addClass("clicked").show();
};

window.bigArrowUp = function () {
    $(".clicked").removeClass("clicked");
    $(".labelclick").find(".arrow-down").addClass("clicked").show();
    $(".labelclick").find(".arrow-up").addClass("clicked").hide();
};

window.showArrows = function () {
    $(".arrow-down").show();
    $(".arrow-up").show();
};

window.sortDescendingReviews = function (a, b) {
    var date1 = $(a).find(".date strong").text();
    date1 = date1.split('/');
    date1 = new Date(date1[2], date1[1] - 1, date1[0]);
    var date2 = $(b).find(".date strong").text();
    date2 = date2.split('/');
    date2 = new Date(date2[2], date2[1] - 1, date2[0]);

    // return date1 < date2 ? 1 : -1;

    if (date1 < date2) {
        return -1;
    } else {
        return 1;
    }
};

window.sortAscendingReviews = function (a, b) {
    var date1 = $(a).find(".date strong").text();
    date1 = date1.split('/');
    date1 = new Date(date1[2], date1[1] - 1, date1[0]);
    var date2 = $(b).find(".date strong").text();
    date2 = date2.split('/');
    date2 = new Date(date2[2], date2[1] - 1, date2[0]);

    if (date1 > date2) {
        return -1;
    } else {
        return 1;
    }
};

window.dateUpReviews = function () {
    $('.sortme').sort(sortAscendingReviews).insertAfter('.header');
    $(".sortdate").addClass('up');
    $(".sortdate").removeClass('down');
    $(".sortdate").removeClass('start');

};

window.dateDownReviews = function () {
    $('.sortme').sort(sortDescendingReviews).insertAfter('.header');
    $(".sortdate").addClass('down');
    $(".sortdate").removeClass('up');
};

window.sortDescending = function (a, b) {
    var date1 = $(a).find(".date").data("date");
    date1 = date1.split('/');
    date1 = new Date(date1[2], date1[1] - 1, date1[0]);
    var date2 = $(b).find(".date").data("date");
    date2 = date2.split('/');
    date2 = new Date(date2[2], date2[1] - 1, date2[0]);

    // return date1 < date2 ? 1 : -1;

    if (date1 < date2) {
        return -1;
    } else {
        return 1;
    }
};

window.sortAscending = function (a, b) {
    var date1 = $(a).find(".date").data("date");
    date1 = date1.split('/');
    date1 = new Date(date1[2], date1[1] - 1, date1[0]);
    var date2 = $(b).find(".date").data("date");
    date2 = date2.split('/');
    date2 = new Date(date2[2], date2[1] - 1, date2[0]);

    if (date1 > date2) {
        return -1;
    } else {
        return 1;
    }
};


window.dateUp = function () {
    $('.sortme').sort(sortAscending).insertAfter('.header');
    $(".sortdate").addClass('up');
    $(".sortdate").removeClass('down');
    $(".sortdate").removeClass('start');

};

window.dateDown = function () {
    $('.sortme').sort(sortDescending).insertAfter('.header');
    $(".sortdate").addClass('down');
    $(".sortdate").removeClass('up');
};


window.date2Descending = function (a, b) {
    var date1 = $(a).find(".date2").data("date");
    date1 = date1.split('/');
    date1 = new Date(date1[2], date1[1] - 1, date1[0]);
    var date2 = $(b).find(".date2").data("date");
    date2 = date2.split('/');
    date2 = new Date(date2[2], date2[1] - 1, date2[0]);

    // return date1 < date2 ? 1 : -1;

    if (date1 < date2) {
        return -1;
    } else {
        return 1;
    }
};

window.date2Ascending = function (a, b) {
    var date1 = $(a).find(".date2").data("date");
    date1 = date1.split('/');
    date1 = new Date(date1[2], date1[1] - 1, date1[0]);
    var date2 = $(b).find(".date2").data("date");
    date2 = date2.split('/');
    date2 = new Date(date2[2], date2[1] - 1, date2[0]);

    if (date1 > date2) {
        return -1;
    } else {
        return 1;
    }
};


window.date2Up = function () {
    $('.sortme').sort(date2Ascending).insertAfter('.header');
    $(".active").addClass('up');
    $(".active").removeClass('down');
    $(".active").removeClass('start');

}

window.date2Down = function () {
    $('.sortme').sort(date2Descending).insertAfter('.header');
    $(".active").addClass('down');
    $(".active").removeClass('up');
};



window.durDescending = function (a, b) {
    var time1 = $(a).find(".dur").text();

    var time2 = $(b).find(".dur").text();



    // return date1 < date2 ? 1 : -1;

    if (time1 < time2) {
        return -1;
    } else {
        return 1;
    }
};

window.durAscending = function (a, b) {
    var time1 = $(a).find(".dur").text();

    var time2 = $(b).find(".dur").text();

    if (time1 > time2) {
        return -1;
    } else {
        return 1;
    }
};





window.durUp = function () {
    $('.sortme').sort(durAscending).insertAfter('.header');
    $(".durcontain").addClass('up');
    $(".durcontain").removeClass('down');
    $(".durcontain").removeClass('start');

};

window.durDown = function () {
    $('.sortme').sort(durDescending).insertAfter('.header');
    $(".durcontain").addClass('down');
    $(".durcontain").removeClass('up');
};


window.timeDescending = function (a, b) {
    var time1 = $(a).find(".Time span").text();

    var time2 = $(b).find(".Time span").text();



    // return date1 < date2 ? 1 : -1;

    if (time1 < time2) {
        return -1;
    } else {
        return 1;
    }
};

window.timeAscending = function (a, b) {
    var time1 = $(a).find(".Time span").text();

    var time2 = $(b).find(".Time span").text();

    if (time1 > time2) {
        return -1;
    } else {
        return 1;
    }
};


window.timeUp = function () {
    $('.sortme').sort(timeAscending).insertAfter('.header');
    $(".timecontain").addClass('up');
    $(".timecontain").removeClass('down');
    $(".timecontain").removeClass('start');

};

window.timeDown = function () {
    $('.sortme').sort(timeDescending).insertAfter('.header');
    $(".timecontain").addClass('down');
    $(".timecontain").removeClass('up');
};

window.ratingAscending = function (a, b) {

    var contentA = $(a).find('.unchecked').length;
    var contentB = $(b).find('.unchecked').length;
    return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
};

window.ratingUp = function () {
    $('.sortme').sort(ratingAscending).insertAfter('.header');
    $(".sortrate").addClass('up');
    $(".sortrate").removeClass('down');
    $(".sortrate").removeClass('start');
};

window.ratingDescending = function (a, b) {

    var contentA = $(a).find('.unchecked').length;
    var contentB = $(b).find('.unchecked').length;
    return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
};

window.ratingDown = function () {
    $('.sortme').sort(ratingDescending).insertAfter('.header');
    $(".sortrate").addClass('down');
    $(".sortrate").removeClass('up');
};

window.rating4 = function (a, b) {

    var contentA = $(a).find('.unchecked').length;
    var contentB = $(b).find('.unchecked').length;
    return contentA == "1" ? -1 : contentB == "1" ? 1 : 0;
};

window.rating3 = function (a, b) {

    var contentA = $(a).find('.unchecked').length;
    var contentB = $(b).find('.unchecked').length;
    return contentA == "2" ? -1 : contentB == "2" ? 1 : 0;
};

window.rating2 = function (a, b) {

    var contentA = $(a).find('.unchecked').length;
    var contentB = $(b).find('.unchecked').length;
    return contentA == "3" ? -1 : contentB == "3" ? 1 : 0;
};

window.rating1 = function (a, b) {

    var contentA = $(a).find('.unchecked').length;
    var contentB = $(b).find('.unchecked').length;
    return contentA == "4" ? -1 : contentB == "4" ? 1 : 0;
};

window.rating5 = function (a, b) {

    var contentA = $(a).find('.unchecked').length;
    var contentB = $(b).find('.unchecked').length;
    return contentA == "0" ? -1 : contentB == "0" ? 1 : 0;
};


window.alphaAscending = function (a, b) {
    if (a.textContent < b.textContent) {
        return -1;
    } else {
        return 1;
    }

};

window.nameUp = function () {
    $('.sortme').sort(alphaAscending).insertAfter('.header');
    $(".sortname").addClass('up');
    $(".sortname").removeClass('down');
    $(".sortname").removeClass('start');
};

window.alphaDescending = function (a, b) {
    if (a.textContent > b.textContent) {
        return -1;
    } else {
        return 1;
    }
};

window.nameDown = function () {
    $('.sortme').sort(alphaDescending).insertAfter('.header');
    $(".sortname").addClass('down');
    $(".sortname").removeClass('up');
};

window.statAscending = function (a, b) {

    var contentA = parseInt($(a).find(".stat-con").attr('data-stat'));
    var contentB = parseInt($(b).find(".stat-con").attr('data-stat'));
    return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
};

window.statDescending = function (a, b) {

    var contentA = parseInt($(a).find(".stat-con").attr('data-stat'));
    var contentB = parseInt($(b).find(".stat-con").attr('data-stat'));
    return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
};


window.progressSort = function (a, b) {

    var contentA = parseInt($(a).find(".stat-con").attr('data-stat'));
    var contentB = parseInt($(b).find(".stat-con").attr('data-stat'));
    return contentA === 2 ? -1 : contentB === 2 ? 1 : 0;
};

window.approvedSort = function (a, b) {

    var contentA = parseInt($(a).find(".stat-con").attr('data-stat'));
    var contentB = parseInt($(b).find(".stat-con").attr('data-stat'));
    return contentA === 3 ? -1 : contentB === 3 ? 1 : 0;
};

window.statUp = function () {
    $('.sortme').sort(statAscending).insertAfter('.header');
    $(".sortstat").addClass('up');
    $(".sortstat").removeClass('down');
    $(".sortstat").removeClass('start');

};

window.statDown = function () {
    $('.sortme').sort(statDescending).insertAfter('.header');
    $(".sortstat").addClass('down');
    $(".sortstat").removeClass('up');
};

window.typeAscending = function (a, b) {

    var contentA = parseInt($(a).find(".type").attr('data-type'));
    var contentB = parseInt($(b).find(".type").attr('data-type'));
    return (contentA < contentB) ? -1 : (contentA > contentB) ? 1 : 0;
};

window.typeDescending = function (a, b) {

    var contentA = parseInt($(a).find(".type").attr('data-type'));
    var contentB = parseInt($(b).find(".type").attr('data-type'));
    return (contentA > contentB) ? -1 : (contentA < contentB) ? 1 : 0;
};


window.typeUp = function () {
    $('.sortme').sort(typeAscending).insertAfter('.header');
    $(".type").addClass('up');
    $(".type").removeClass('down');
    $(".type").removeClass('start');

};

window.typeDown = function () {
    $('.sortme').sort(typeDescending).insertAfter('.header');
    $(".type").addClass('down');
    $(".type").removeClass('up');
};

window.scheduled2 = function (a, b) {
    var contentA = $(a).find(".stat-con").attr('value');
    var contentB = $(b).find(".stat-con").attr('value');
    return contentA === "scheduled" ? -1 : contentB === "scheduled" ? 1 : 0;
};

window.sortResponse = function (a, b) {
    var contentA = $(a).find(".stat-con").attr('value');
    var contentB = $(b).find(".stat-con").attr('value');
    return contentA === "response" ? -1 : contentB === "response" ? 1 : 0;
};

window.sortPay = function (a, b) {
    var contentA = $(a).find(".stat-con").attr('value');
    var contentB = $(b).find(".stat-con").attr('value');
    return contentA === "payment" ? -1 : contentB === "response" ? 1 : 0;
};


window.sortBilling = function (a, b) {
    var contentA = $(a).find(".stat-con").attr('value');
    var contentB = $(b).find(".stat-con").attr('value');
    return contentA === "billing" ? -1 : contentB === "response" ? 1 : 0;
};

window.amountAscending = function (a, b) {

    var amountA = $(a).find(".amount").text();
    var amountB = $(b).find(".amount").text();
    return amountB.localeCompare(amountA, undefined, { numeric: true, sensitivity: 'base' });
};



window.amountDescending = function (a, b) {
    var amountA = $(a).find(".amount").text();
    var amountB = $(b).find(".amount").text();
    return amountA.localeCompare(amountB, undefined, { numeric: true, sensitivity: 'base' });

};


window.amountUp = function () {
    $('.sortme').sort(amountAscending).insertAfter('.header');
    $(".sortamount").addClass('up');
    $(".sortamount").removeClass('down');
    $(".sortamount").removeClass('start');

};

window.amountDown = function () {
    $('.sortme').sort(amountDescending).insertAfter('.header');
    $(".sortamount").addClass('down');
    $(".sortamount").removeClass('up');
};

window.paySort = function (a, b) {
    var contentA = $(a).find(".stat-con").attr('value');
    var contentB = $(b).find(".stat-con").attr('value');
    return contentA === "pay" ? -1 : contentB === "pay" ? 1 : 0;
};

window.cashSort = function (a, b) {
    var contentA = $(a).find(".stat-con").attr('value');
    var contentB = $(b).find(".stat-con").attr('value');
    return contentA === "cash" ? -1 : contentB === "cash" ? 1 : 0;
};

window.cardSort = function (a, b) {
    var contentA = $(a).find(".stat-con").attr('value');
    var contentB = $(b).find(".stat-con").attr('value');
    return contentA === "card" ? -1 : contentB === "card" ? 1 : 0;
};

window.inactiveSort = function (a, b) {
    var contentA = $(a).find(".stat-con").data("stat");
    var contentB = $(b).find(".stat-con").data("stat");
    return contentA === 2 ? -1 : contentB === 2 ? 1 : 0;
};

window.cash2Sort = function (a, b) {
    var contentA = $(a).find(".type").data("type");
    var contentB = $(b).find(".type").data("type");
    return contentA === 2 ? -1 : contentB === 2 ? 1 : 0;
};


$(document).ready(function () {
    $(".button-wrapper").mouseover(function () {
        $(".add-invoice-contain").animate({ width: "170px" }, 300);
        $(".add-invoice").animate({ width: "160px", color: "white", "background-color": "#f4ba46" }, 300);
        $(".button-wrapper").find("h6").show(100).animate({ left: "48px", color: "white" }, 300);
    });

    $(".button-wrapper").mouseleave(function () {
        $(".add-invoice-contain").animate({ width: "70px" }, 300);
        $(".add-invoice").animate({ width: "60px", color: "#f4ba46", "background-color": "white" }, 300);
        $(".button-wrapper").find("h6").hide(100).animate({ left: "40px" }, 300);
    });
});
