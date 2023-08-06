@php
    use \App\Models\ProductFilter;
    $productFilters = ProductFilter::getFilter();
@endphp


@extends('frontend.layouts.layouts')
@section('content')

    @include('frontend.partials.category_nav',['section' => $product->section->name])




<div class="page-contain single-product">
    <div class="container container-xxl">

        <!-- Main content -->
        <div id="main-content" class="main-content">

            <!-- summary info -->
            <div class="sumary-product single-layout">
                <div class="media">
                    <ul class="biolife-carousel slider-for" data-slick='{"arrows":false,"dots":false,"slidesMargin":30,"slidesToShow":1,"slidesToScroll":1,"fade":true,"asNavFor":".slider-nav"}'>
                        <li><img src="{{asset($product->product_image ?? null)}}" alt="" width="500" height="500"></li>
                        @foreach($product->images as $image)
                            <li><img src="{{asset($image->image ?? null)}}" alt="" width="500" height="500"></li>
                        @endforeach
                    </ul>
                    <ul class="biolife-carousel slider-nav" data-slick='{"arrows":false,"dots":false,"centerMode":false,"focusOnSelect":true,"slidesMargin":10,"slidesToShow":4,"slidesToScroll":1,"asNavFor":".slider-for"}'>
                        <li><img src="{{asset($product->product_image ?? null)}}" alt="" width="88" height="88"></li>
                        @foreach($product->images as $image)
                            <li><img src="{{asset($image->image ?? null)}}" alt="" width="88" height="88"></li>
                        @endforeach
                    </ul>
                </div>
                <div class="product-attribute">
                    <h3 class="title">{{$product->product_name}}</h3>
                    <div class="rating">
                        @if($reviews->count() > 0)
                          <p class="star-rating"><span class="width-{{0 ? 0 : number_format(number_format($reviews->sum('rating') / $reviews->count(),2) * 20) }}percent"></span></p>
                        @endif
                        @if($product->attributes->sum('stock') > 0)
                        <span class="review-count main-font-color">In Stock</span>
                        @else
                        <span class="review-count main-font-color-red">Out Of Stock</span>
                        @endif
                    </div>
                    <span class="sku productAttributeSku">Sku: {{$product->attributes[0]->sku ?? null}}</span>
                    <div>
                        <span class="sku">Product Code: {{$product->product_code ?? null}}</span>
                    </div>
                    <div>
                        <span class="sku">Product Color: {{$product->product_color ?? null}}</span>
                    </div>
                    @if($product->vendor)
                    <div>
                        <span class="sku">Sold By: <a href="{{route('product.vendor-listing',$product->vendor->id)}}">{{$product->vendor->name ?? null}} ({{$product->vendor->vendorDetails->shop_name ?? null}})</a></span>
                    </div>
                    @endif

                    <p class="excerpt">{{\Illuminate\Support\Str::limit($product->description,100)}}</p>

                        @php
                            $discount =\App\Models\Product::getDiscountPrice($product->id)
                        @endphp
                        <div class="price ">
                            @if( $discount != 0)
                                <ins><span class="price-amount discount-price"><span class="currencySymbol">$</span>{{$discount}}</span></ins>
                                <del><span class="price-amount product-main-price"><span class="currencySymbol">$</span>{{$product->product_price}}</span></del>
                            @else
                                <ins><span class="price-amount product-main-price"><span class="currencySymbol">$</span>{{$product->product_price}}</span></ins>
                            @endif
                        </div>


                    <form action="{{route('cart.add')}}" method="post" class="cartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        <div class="action-form">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="location-shipping-to">
                                    <span class="title">Size:</span>
                                    <select name="size" id="getPrice" product_id="{{$product->id}}" class=" getPrice" required>
                                        <option value="">Select Size</option>
                                        @foreach($product->attributes as $attribute)
                                            <option value="{{$attribute->size}}">{{$attribute->size}}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6 col-12">
                                <div class="quantity-box location-shipping-to">
                                    <span class="title">Quantity:</span>
                                    <div class="qty-input">
                                        <input type="number" name="qty" value="1" data-max_value="20" data-min_value="1" data-step="1" required>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="buttons">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn add-to-cart-btn mr-5">add to cart</button>
                                    <button type="button" class="btn add-to-cart-btn mr-5 addWishlist"   data-productid="{{$product->id}}">Wish List</button>
                                    <button type="button" class="btn add-to-cart-btn mr-5">Compare</button>

                                </div>
                                <div>
                                    <ul class="social-list a2a_kit a2a_kit_size_32 a2a_default_style" data-a2a-icon-color="#05f5b5">
                                        <a class="a2a_button_facebook"></a>
                                        <a class="a2a_button_twitter"></a>
                                        <a class="a2a_button_linkedin"></a>
                                        <a class="a2a_button_pinterest"></a>
                                    </ul>
                                </div>

                            </div>

                        </div>
                        <div class="social-media">

                        </div>
                    </div>
                    </form>
                </div>
            </div>

            <!-- Tab info -->
            <div class="product-tabs single-layout biolife-tab-contain">
                <div class="tab-head">
                    <ul class="tabs">
                        <li class="tab-element active"><a href="#tab_1st" class="tab-link">Products Descriptions</a></li>
                        <li class="tab-element" ><a href="#tab_2nd" class="tab-link">Addtional information</a></li>
                        <li class="tab-element" ><a href="#tab_3rd" class="tab-link">Shipping & Delivery</a></li>
                        <li class="tab-element" ><a href="#tab_4th" class="tab-link">Customer Reviews <sup>({{$reviews->count()}})</sup></a></li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div id="tab_1st" class="tab-contain desc-tab active">
                        <p class="desc">{{$product->description}} </p>
                    </div>
                    <div id="tab_2nd" class="tab-contain addtional-info-tab">
                        <table class="tbl_attributes">
                            <tbody>
                            @foreach($productFilters as $filter)
                                @php $filterAvailable = ProductFilter::filterAvailable($filter->id,$product->category->id);  @endphp
                                @if($filterAvailable)
                                    @if(count($filter->filterValues) > 0)
                               <tr>
                                 <th>{{$filter->filter_name}}</th>
                                 <td>
                                     <p>
                                         @foreach($filter->filterValues as $filter_value)
                                             {{$filter_value->filter_value}} @if(!$loop->last),@endif
                                         @endforeach
                                     </p>
                                 </td>
                                   </tr>
                                    @endif
                                @endif
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div id="tab_3rd" class="tab-contain shipping-delivery-tab">
                        <div class="accodition-tab biolife-accodition">
                            <ul class="tabs">
                                <li class="tab-item">
                                    <span class="title btn-expand">How long will it take to receive my order?</span>
                                    <div class="content">
                                        <p>Orders placed before 3pm eastern time will normally be processed and shipped by the following business day. For orders received after 3pm, they will generally be processed and shipped on the second business day. For example if you place your order after 3pm on Monday the order will ship on Wednesday. Business days do not include Saturday and Sunday and all Holidays. Please allow additional processing time if you order is placed on a weekend or holiday. Once an order is processed, speed of delivery will be determined as follows based on the shipping mode selected:</p>
                                        <div class="desc-expand">
                                            <span class="title">Shipping mode</span>
                                            <ul class="list">
                                                <li>Standard (in transit 3-5 business days)</li>
                                                <li>Priority (in transit 2-3 business days)</li>
                                                <li>Express (in transit 1-2 business days)</li>
                                                <li>Gift Card Orders are shipped via USPS First Class Mail. First Class mail will be delivered within 8 business days</li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="tab-item">
                                    <span class="title btn-expand">How is the shipping cost calculated?</span>
                                    <div class="content">
                                        <p>You will pay a shipping rate based on the weight and size of the order. Large or heavy items may include an oversized handling fee. Total shipping fees are shown in your shopping cart. Please refer to the following shipping table:</p>
                                        <p>Note: Shipping weight calculated in cart may differ from weights listed on product pages due to size and actual weight of the item.</p>
                                    </div>
                                </li>
                                <li class="tab-item">
                                    <span class="title btn-expand">Why Didn’t My Order Qualify for FREE shipping?</span>
                                    <div class="content">
                                        <p>We do not deliver to P.O. boxes or military (APO, FPO, PSC) boxes. We deliver to all 50 states plus Puerto Rico. Certain items may be excluded for delivery to Puerto Rico. This will be indicated on the product page.</p>
                                    </div>
                                </li>
                                <li class="tab-item">
                                    <span class="title btn-expand">Shipping Restrictions?</span>
                                    <div class="content">
                                        <p>We do not deliver to P.O. boxes or military (APO, FPO, PSC) boxes. We deliver to all 50 states plus Puerto Rico. Certain items may be excluded for delivery to Puerto Rico. This will be indicated on the product page.</p>
                                    </div>
                                </li>
                                <li class="tab-item">
                                    <span class="title btn-expand">Undeliverable Packages?</span>
                                    <div class="content">
                                        <p>Occasionally packages are returned to us as undeliverable by the carrier. When the carrier returns an undeliverable package to us, we will cancel the order and refund the purchase price less the shipping charges. Here are a few reasons packages may be returned to us as undeliverable:</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="tab_4th" class="tab-contain review-tab">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7 col-md-7 col-sm-6 col-xs-12 d-none">
                                    @if(auth()->user() && $orderCount > 0)

                                    <div class="review-form-wrapper">
                                        <span class="title">Submit your review</span>

                                            <form method="POST" action="{{route('user.review.store')}}" class="reviewRating"  >
                                                @csrf
                                            <div class="comment-form-rating">
                                                <label>1. Your rating of this products:</label>
                                                <input type="hidden" value="{{$product->id}}" class="product_id" name="product_id">
                                                <p class="stars">
                                                        <span>
                                                            <a class="btn-rating"  data-value="1" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                            <a class="btn-rating" data-value="2" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                            <a class="btn-rating" data-value="3" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                            <a class="btn-rating" data-value="4" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                            <a class="btn-rating" data-value="5" href="#"><i class="fa fa-star-o" aria-hidden="true"></i></a>
                                                        </span>
                                                </p>
                                            </div>
                                            <p class="form-row">
                                                <textarea name="comment" id="txt-comment"  class="review" cols="30" rows="10" placeholder="Write your review here..."></textarea>
                                            </p>
                                            <p class="form-row">
                                                <button type="submit" class="basicbtn" name="submit">submit review</button>
                                            </p>
                                        </form>
                                    </div>
                                    @endif
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-6 col-xs-12">
                                    @if($reviews->count() > 0)
                                    <div class="rating-info">
                                        <p class="index"><strong class="rating">{{number_format($reviews->sum('rating') / $reviews->count(),2)}}</strong>out of 5</p>
                                        <div class="rating"><p class="star-rating"><span class="width-{{number_format(number_format($reviews->sum('rating') / $reviews->count(),2) * 20)}}percent"></span></p></div>
                                    </div>
                                        @endif
                                </div>

                            </div>
                            @if($reviews->count() > 0)
                            <div id="comments">
                                <ol class="commentlist">
                                    @foreach($reviews as $review)
                                    <li class="review">
                                        <div class="comment-container">
                                            <div class="row">
                                                <div class="comment-content col-lg-8 col-md-9 col-sm-8 col-xs-12">
                                                    <div class="rating"><p class="star-rating"><span class="width-{{$review->rating*20}}percent"></span></p></div>
                                                    <p class="author">by: <b>{{$review->user->name}}</b></p>
                                                    <p class="comment-text">{{$review->review ?? ''}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                  @endforeach

                                </ol>
                                <div class="biolife-panigations-block version-2">
                                    {{$reviews->links('vendor.pagination.custom')}}
                                </div>
                            </div>
                                @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- related products -->
            @if(count($relatedProducts) > 0)
            <div class="product-related-box single-layout">
                <div class="biolife-title-box lg-margin-bottom-26px-im">
                    <h3 class="main-title">Related Products</h3>
                </div>
                <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>

                    @foreach($relatedProducts as $product)
                        @include('frontend.products.product')
                    @endforeach

                </ul>
            </div>
            @endif

            <!-- recent viewd products -->
            @if(count($recent_viewed_products) > 0)

            <div class="product-related-box single-layout">
                <div class="biolife-title-box lg-margin-bottom-26px-im">
                    <span class="biolife-icon icon-organic"></span>
                    <span class="subtitle">All the best item for You</span>
                    <h3 class="main-title">Recent Viewed Products</h3>
                </div>
                <ul class="products-list biolife-carousel nav-center-02 nav-none-on-mobile" data-slick='{"rows":1,"arrows":true,"dots":false,"infinite":false,"speed":400,"slidesMargin":0,"slidesToShow":5, "responsive":[{"breakpoint":1200, "settings":{ "slidesToShow": 4}},{"breakpoint":992, "settings":{ "slidesToShow": 3, "slidesMargin":20 }},{"breakpoint":768, "settings":{ "slidesToShow": 2, "slidesMargin":10}}]}'>

                    @foreach($recent_viewed_products as $product)
                        @include('frontend.products.product')
                    @endforeach

                </ul>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection

@push('frontend_scripts')

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#getPrice').on('change', function() {
            var size = $(this).val();
            var product_id = $(this).attr('product_id');

            $.ajax({
                url: "{{ url('/get-product-price') }}",
                type: 'post',
                data: {
                    size: size,
                    product_id: product_id
                },
                success: function(resp) {
                   $('.discount-price').text(resp['total_price']);
                   $('.product-main-price').text(resp['product_price']);
                   $('.productAttributeSku').text("Sku: " + resp['sku']);
                },
                error: function() {
                    Notify('error', 'Something went wrong');

                }
            });


        });
    });




    $(document).on("submit", ".reviewRating", function (e) {
        e.preventDefault();
       let rating = $(".selected").data('value');
       let product_id = $('.product_id').val();
       let review = $('.review').val();

       var formData = new FormData();
       formData.append('rating',rating);
       formData.append('product_id',product_id);
       formData.append('review',review);


        var $this = $(this);
        var basicBtnHtml = $this.find(".basicbtn").html();

        $.ajax({
            type: "POST",
            url: this.action,
            data: formData,
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
                $('.reviewRating').trigger('reset');
                Notify("success", response);
                if (response.redirect) {
                    location.href = response.redirect;
                }
            },
            error: function (xhr, status, error) {
                console.log(xhr)
                $this.find(".basicbtn").html(basicBtnHtml);
                $this.find(".basicbtn").removeAttr("disabled");
                Notify("error", xhr.responseJSON.message);
            },
        });
    });




</script>
@endpush
@push('frontend_css')
    <style>
        @for($i = 1; $i <= 100; $i++)
             .width-{{$i}}percent{
                width: {{$i}}%;
              }
        @endfor
    </style>
@endpush
