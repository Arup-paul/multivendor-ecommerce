(function ($) {
    "use strict";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#sort').on('change', function() {
            var sort = $("#sort").val();
            var url = $("#url").val();

            $.ajax({
                url:url,
                method:'POST',
                data:{sort:sort,url:url},
                success:function(data) {
                    $('.filter-products').html(data);
                },error:function() {
                     // Notify('error', 'Oops! Something went wrong');
                }
            })
        });
    })

})(jQuery);
