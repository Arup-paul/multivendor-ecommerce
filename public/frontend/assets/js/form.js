

"use strict";


$(document).on('submit', '.ajaxform', function (e) {
    e.preventDefault();

    var $submitBtn = $('.basic-btn')
    var $submitBtnOld = $submitBtn.html();

    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $submitBtn.html("Please Wait....");
            $submitBtn.attr('disabled', '');
        },

        success: function (response) {
            $submitBtn.removeAttr('disabled');
            $submitBtn.html($submitBtnOld);
            Notify('success', response)

            if (response.redirect){
                window.setTimeout(function () {
                    location.href = response.redirect;
                }, 1000)
            }
        },
        error: function (xhr, status, error) {
            console.log(xhr.responseJSON)
            $submitBtn.html($submitBtnOld);
            $submitBtn.removeAttr('disabled');


            if(xhr.responseJSON.message){
                Notify('error', null, xhr.responseJSON.message)
            }
            if (xhr.responseJSON.redirect){
                window.setTimeout(function () {
                    location.href = xhr.responseJSON.redirect;
                }, 2000)
            }




            if (xhr.responseJSON.errors){
                $.each(xhr.responseJSON.errors, function (i, error) {
                    Notify('error', null, error[0])
                })
            }
        }
    });
});

$(document).on('submit', '.ajaxform_with_reset', function (e) {
    e.preventDefault();

    var $submitBtn = $('.basic-btn')
    var $submitBtnOld = $submitBtn.html();

    $.ajax({
        type: 'POST',
        url: this.action,
        data: new FormData(this),
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        beforeSend: function () {
            $submitBtn.html("Please Wait....");
            $submitBtn.attr('disabled', '');
        },

        success: function (response) {
            $submitBtn.removeAttr('disabled');
            $submitBtn.html($submitBtnOld);
            $('.ajaxform_with_reset').trigger('reset');
            Notify('success', response)

            if (response.redirect){
                window.setTimeout(function () {
                    location.href = response.redirect;
                }, 2000)
            }
        },
        error: function (xhr, status, error) {
            $submitBtn.html($submitBtnOld);
            $submitBtn.removeAttr('disabled');

            if (xhr.responseJSON.errors){
                $.each(xhr.responseJSON.errors, function (i, error) {
                    Notify('error', null, error[0])
                })
            }else{
                Notify('error', xhr)
            }
        }
    });
});

$(".ajaxform_with_reload").on('submit', function (e) {
    e.preventDefault();

    var $submitBtn = $('.basic-btn')
    var $submitBtnOld = $submitBtn.html();

        $.ajax({
            type: 'POST',
            url: this.action,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function () {
                $submitBtn.html("Please Wait....");
                $submitBtn.attr('disabled', '');
            },

            success: function (response) {
                $submitBtn.removeAttr('disabled');
                $submitBtn.html($submitBtnOld);
                Notify('success', response)

                window.setTimeout(function () {
                    location.reload();
                }, 1500);

            },
            error: function (xhr, status, error) {
                $submitBtn.html($submitBtnOld);
                $submitBtn.removeAttr('disabled');

                if (xhr.responseJSON.message) {
                    Notify('error', xhr.responseJSON.message);
                } else if (xhr.responseJSON) {
                    Notify('error', xhr.responseJSON);
                } else {
                    Notify('error', xhr.responseText);
                }
            }
        });
});


//cart add
$(document).on("submit", ".cartForm", function (e) {
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
            if(response.totalCartItems){
                $('#totalCartItems').html(response.totalCartItems);
            }
            if(response.minicart){
                $('#appendMiniCartItem').html(response.minicart);
            }
            if (response.redirect) {
                location.href = response.redirect;
            }
        },
        error: function (xhr, status, error) {
            $this.find(".basicbtn").html(basicBtnHtml);
            $this.find(".basicbtn").removeAttr("disabled");
            Notify("error", xhr.responseText);
        },
    });
});

//cart remove item
$(document).on('click','.removeCartItem',function (){
    var cartId = $(this).data('cartid');
    var url = $(this).data('url');

    Swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            event.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:{
                    cartId:cartId,
                },
                url: url,
                type: 'POST',
                success: function (response) {
                    $('#totalCartItems').html(response.totalCartItems);
                    if(response.status == true){
                        Notify('success',null,response.message);
                        $('#appendCartItems').html(response.view);
                        $('#appendMiniCartItem').html(response.minicart);
                    }
                },error: function (error) {
                    Notify('error','Something went wrong!' );
                }

            })
        }
    })
});


$(document).on("click", ".addWishlist", function (e) {
    e.preventDefault();

    let product_id = $(this).data("productid")

    var formData = new FormData();
    formData.append('product_id',product_id);



    $.ajax({
        type: "POST",
        url: '/user/wishlist',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,

        success: function (response) {
            Notify("success", response);
            if(response.total_wish_list){
                $('#totalWishlistItems').html(response.total_wish_list);
            }
            if (response.redirect) {
                location.href = response.redirect;
            }
        },
        error: function (xhr, status, error) {
            Notify("error", xhr.responseText);
        },
    });
});

//wishlist remove
$(document).on('click','.removeWishlistItem',function (){
    var wishlistId = $(this).data('wishlistid');
    var url = $(this).data('url');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data:{
            wishlistId:wishlistId,
        },
        type: "POST",
        url: url,
        success: function (response) {
            Notify("success", response);
            if (response.redirect){
                window.setTimeout(function () {
                    location.href = response.redirect;
                }, 2000)
            }
        },
        error: function (xhr, status, error) {
            Notify("error", xhr.responseText);
        },
    });
});

$(document).on('click','.removeWishlistALlItem',function (){
    var url = $(this).data('url');
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: url,
        success: function (response) {
            Notify("success", response);
            if (response.redirect){
                window.setTimeout(function () {
                    location.href = response.redirect;
                }, 2000)
            }
        },
        error: function (xhr, status, error) {
            Notify("error", xhr.responseText);
        },
    });
});











