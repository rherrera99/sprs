$(document).ready(function() {

    $('select').on('change', function() {
        $(this).valid();
    });
});

/* Set Image preview on change of file input */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#photo-preview').attr('style', 'background-image: url(' + e.target.result + ')');
        }
        reader.readAsDataURL(input.files[0]);
    }
}

function clickToMoveNext(id_to_open, id, e) {
    var last_li_id = $('ul.building_tab li:last-child a').attr("id");
    //var previous_li = $("ul.building_tab").find("li.active").prev("li").find("a").attr("id");
    //$(".li_items").removeClass("active");
    //$("#" + previous_li).parent().addClass("active");
    var url = window.location.pathname.split("/");
    var controller = url[3];
    var validate = false;
    var current_li = $("ul.building_tab").find("li.active").find("a").attr("id");

    if (controller == 'buildings') {
        if (current_li == 'tab2') {
            if ($("#search-tab-gallery").css("display") != 'none') {
                var checked = false;

                $.each($("input.default_img"), function() {
                    var id = this.id;
                    if ($("#" + id).is(":checked")) {
                        checked = true;
                        return false;
                    }
                });
                if (checked) {
                    validate = true;
                } else {
                    alert("Please select 1 image as slider/gallery image");
                    e.stopImmediatePropagation();

                }
            }else{
                validate = true;
            }


        } else {
            validate = true;
        }
    } else {
        validate = true;
    }
    if (validate) {
        $("form").validate();
        if ($("form").valid()) {
            $(".li_items").removeClass("active");
            $("#" + id).parent().addClass("active");
            $(".tab-pane").removeClass("active");
            $("#" + id_to_open).addClass("active");
            if (id == last_li_id) {
                $("#submit_save").css("display", "");
                $("#next_tab").css("display", "none");
            } else {
                $("#submit_save").css("display", "none");
                $("#next_tab").css("display", "");
            }
        }
    }
}

function goToNext() {
    var current_li = $("ul.building_tab").find("li.active").find("a").attr("id");
    var active_li = $("ul.building_tab").find("li.active").next("li").find("a").attr("id");
    var url = window.location.pathname.split("/");
    var controller = url[3];
    if (controller == 'buildings') {
        if (current_li == 'tab2') {
            var checked = false;
            $.each($("input.default_img"), function() {
                var id = this.id;
                if ($("#" + id).is(":checked")) {
                    checked = true;
                    return false;
                }
            });
            if (checked) {
                $("#" + active_li).click();
            } else {
                alert("alert here Please select 1 image as slider/gallery image");
            }

        } else {
            //alert("active here");

            $("#" + active_li).click();
        }
    } else {
        $("#" + active_li).click();
    }
}