<div class="hero-section hero-background"
     @if(isset($image))
       style="background-image:url({{asset($image)}})
    @else
       style="background-color: #3db53d; opacity:.8"
   @endif">
    <h1 class="page-title">{{$title}}</h1>
</div>
