function diff_years(dt2, dt1) {
    var diff =(dt2.getTime() - dt1.getTime()) / 1000;
    diff /= (60 * 60 * 24);
    return Math.abs(Math.floor(diff/365.25));
}

function calculateAge(date) {
    var rVal = null;
    if (typeof date === 'object' && date instanceof Date) {
        var current = new Date();
        var age = diff_years(current, date);

        if (age < 1) {
            rVal = "infant";
        } else if (age >= 1 && age < 4) {
            rVal = "toddler";
        } else if (age >= 4) {
            rVal = "school_age";
        }
    }
    return rVal;
}

$(document).ready(function() {
    $(".addchild").click(function () {
        var clone = null;
        var childClasses = "clone register-clone";
        var idNumber = parseInt($("#childContainer").data("record-index"));
        idNumber = isNaN(idNumber) ? 1 : idNumber + 1;

        clone = $('#child0').clone().attr({"id": "child" + idNumber, "class": childClasses});

        clone.find("input, textarea, select").each(function() {
            var $this = $(this);
            var type = false;
            var name = null;
            var willRequire = null;

            name = $this.attr("name");
            name = name.replace("[0]", "[" + idNumber + "]");
            $this.attr("name", name);

            willRequire = $this.data("will-require");
            if (typeof willRequire === "string") {
                willRequire = willRequire.replace("[0]", "[" + idNumber + "]");
                $this.data('will-require', willRequire);
            }

            type = $this.attr("type");
            type = (typeof type === "string") ? type : false;

            if (type === "checkbox" || type === "radio") {
                $this.prop("checked", false).removeProp("checked");
            } else {
                $this.val('');
            }
        });

        clone.find(".im-x-mark").removeClass("iGone");

        clone.appendTo("#childContainer");
        $("#childContainer").data("record-index", idNumber);

    });

    $(document).on("change blur", "[data-will-require]", function() {
        var $parent = $(this);
        var willRequire = $(this).data("will-require");
        if (willRequire) {
            willRequire = willRequire.split("|");
            $(willRequire).each(function() {
                var selector = "[name=\"" + this + "\"]";
                var $selector = $(selector).eq(0);

                if ($parent.val()) {
                    $selector.prop("required", true);
                } else {
                    $selector.prop("required", false).removeProp("required");
                }
            });
        }
    });

    $(document).on('click', '.im-x-mark', function() {
        $(this).closest(".clone").empty().remove();
    });

    $(document).on("change blur", ".dob-wrapper select", function() {
        var $parent = $(this).parents('.dob-wrapper');
        var month = $parent.find('select[name*=dob_month]').val();
        var day = $parent.find('select[name*=dob_day]').val();
        var year = $parent.find('select[name*=dob_year]').val();
        var date = null;
        var age = null;

        console.log(month, day, year);
        if (month !== '' && day !== '' && year !== '') {
            month = parseInt(month);
            day = parseInt(day);
            year = parseInt(year);
            date = new Date(year, month, day);
            age = calculateAge(date);
            $(this).parents('.clone').find('input[type=radio][value=' + age +']').prop("checked", true);
        }
    });
});

