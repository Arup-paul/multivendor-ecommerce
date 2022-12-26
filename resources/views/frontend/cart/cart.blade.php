@extends('frontend.layouts.layouts')
@section('content')


    <div class="container">
        <!--Cart Table-->
        <div class="shopping-cart-container  ">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif
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
                    var qtyClass = 'qtyPlus';
                }
                if ($(this).hasClass('qtyMinus')) {
                    var qty = $(this).data('qty');
                    if(qty <= 1) {
                        Notify('error','Quantity must be greater or equal than 1');
                        return false;
                    }
                    qty = parseInt(qty) - 1;
                    var qtyClass = 'qtyMinus';

                }
                var cartId = $(this).data('cartid');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data:{
                        qty:qty,
                        cartId:cartId,
                        qtyClass:qtyClass
                    },
                    url: "{{route('cart.update-qty')}}",
                    type: 'POST',
                    success: function (response) {
                         if(response.totalCartItems){
                            $('#totalCartItems').html(response.totalCartItems);
                         }
                        if(response.status == true){
                            $('#appendCartItems').html(response.view);
                            $('#appendMiniCartItem').html(response.minicart);
                        }else if(response.status == false){
                            Notify('error',response.message);
                            $('#appendCartItems').html(response.view);
                            $('#appendMiniCartItem').html(response.minicart);
                        }

                    },error: function (error) {
                        Notify('error','Something went wrong!' );
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
                        if(res.invalid_coupon){
                            Notify('error',res.invalid_coupon );
                        }
                        if(res.status == true){
                            Notify('success',null,res.message);
                            $('#appendCartItems').html(res.view);
                            $('#appendMiniCartItem').html(response.minicart);
                        }
                    },error:function (e){
                        Notify('error','Something went wrong!' );
                    }
                })

            })


        });
    </script>
@endpush
