

"use strict";
$(document).on("submit", ".auth-form", function (e) {
    e.preventDefault();


    var $this = $(this);
    var basicBtnHtml = $this.find(".basicbtn").html();

    $.ajax({
        type: "POST",
        url: this.action,
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $this.find(".basicbtn").html("Please Wait....");
            $this.find(".basicbtn").attr("disabled", "");
        },
        success: function (response) {
            $this.find(".basicbtn").removeAttr("disabled");
            $this.find(".basicbtn").html(basicBtnHtml);
            Notify("success", response);

            if (response.redirect) {
                setTimeout(function () {
                    location.href = response.redirect;
                },1000);
            }
        },
        error: function (xhr, status, error) {
            $this.find(".basicbtn").html(basicBtnHtml);
            $this.find(".basicbtn").removeAttr("disabled");
            Notify("error", xhr);
        },
    });
});
