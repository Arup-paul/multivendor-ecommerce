<div class="hero-section hero-background"
     @if($image)
       style="background-image:url({{asset($image)}})
    @else
       style="background-image:url({{asset('admin/img/breadcrumb/hero_bg.jpg')}})
   @endif">
    <h1 class="page-title">{{$title}}</h1>
</div>
