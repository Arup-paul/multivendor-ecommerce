@extends('frontend.layouts.layouts')
@section('content')


    <div class="container">
        <!--Cart Table-->
        <div class="shopping-cart-container  ">
            <div class="row" id="appendCartItems">
               @include('frontend.cart.items')
            </div>
        </div>
    </div>

@endsection
@push('frontend_scripts')
    <script>
        $(document).ready(function (){
           $(document).on('click','.updateCartItems',function (){
                if ($(this).hasClass('qtyPlus')) {
                    var qty = $(this).data('qty');
                    qty = parseInt(qty) + 1;
                    console.log(qty)
                }
                if ($(this).hasClass('qtyMinus')) {
                    var qty = $(this).data('qty');
                    if(qty <= 1) {
                        Notify('error','Quantity must be greater or equal than 1');
                        return false;
                    }
                    qty = parseInt(qty) - 1;
                    console.log(qty)
                }
                var cartId = $(this).data('cartid');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        qty:qty,
                        cartId:cartId,
                    },
                    url: "{{route('cart.update-qty')}}",
                    type: 'POST',
                    success: function (response) {
                        if(response.status == true){
                            $('#appendCartItems').html(response.view);
                        }else if(response.status == false){
                            Notify('error',response.message);
                            $('#appendCartItems').html(response.view);
                        }

                    },error: function (error) {
                        Notify('error','Something went wrong!' );
                    }

                })

            });

           $(document).on('click','.removddeCartItem',function (){
               var cartId = $(this).data('cartid');
               $.ajax({
                   headers: {
                       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                   },
                   data:{
                       cartId:cartId,
                   },
                   url: "{{route('cart.remove-item')}}",
                   type: 'POST',
                   success: function (response) {
                       if(response.status == true){
                           Notify('success',null,response.message);
                           $('#appendCartItems').html(response.view);
                       }
                   },error: function (error) {
                       Notify('error','Something went wrong!' );
                   }

               })
           })

            $(document).on('click','.removeCartItem',function (){
                var cartId = $(this).data('cartid');
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
                            url: "{{route('cart.remove-item')}}",
                            type: 'POST',
                            success: function (response) {
                                if(response.status == true){
                                    Notify('success',null,response.message);
                                    $('#appendCartItems').html(response.view);
                                }
                            },error: function (error) {
                                Notify('error','Something went wrong!' );
                            }

                        })
                    }
                })
            });

            $(document).on('submit','#ApplyCoupon',function (e){
                var user = $(this).attr("user");
                if(user != 1 ){
                    Notify('error','Please Login First' );
                    return false;
                }
                var code = $("#coupon_code").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    data:{code:code},
                    url:"{{route('apply.coupon')}}",
                    success:function (res){
                        console.log(res)
                        if(res.invalid_coupon){
                            Notify('error',res.invalid_coupon );
                        }
                        if(res.status == true){
                            Notify('success',null,res.message);
                            $('#appendCartItems').html(res.view);
                        }
                    },error:function (e){
                        Notify('error','Something went wrong!' );
                    }
                })

            })


        });
    </script>
@endpush
