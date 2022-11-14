<div class="container">
    <nav class="biolife-nav">
        <ul>
            <li class="nav-item"><a href="{{route('home')}}" class="permal-link">Home</a></li>
            @if(isset($section))
              <li class="nav-item"><a href="javascript:;" class="permal-link">{{$section}}</a></li>
            @endif
            @if($parentCategory)
                <li class="nav-item"><a href="{{url($parentCategory->url)}}" class="permal-link">{{$parentCategory->category_name}}  </a></li>
            @endif
            <li class="nav-item"><a href="{{url($breadCrumb->url)}}" class="permal-link">{{$breadCrumb->category_name}}</a></li>
        </ul>
    </nav>
</div>
