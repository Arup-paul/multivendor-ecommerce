@php
    use \App\Models\ProductFilter;
    $productFilters = ProductFilter::getFilter();
    if(isset($product->category_id)){
        $category_id = $product->category_id;
    }
@endphp

@foreach($productFilters as $filter)
   @if(isset($category_id))
    @php $filterAvailable = ProductFilter::filterAvailable($filter->id,$category_id);  @endphp
      @if($filterAvailable)
        @if(count($filter->filterValues) > 0)
            <div class="form-group">
                <label for="filter_id" class="required">{{$filter->filter_name}}   </label>
                <select name="{{$filter->filter_column}}" id="{{$filter->filter_column}}" class="form-control">
                    <option value="">Select</option>
                    @foreach($filter->filterValues as $filter_value)
                        <option @if(!empty($product[$filter->filter_column]) && $product[$filter->filter_column] == $filter_value->filter_value) selected @endif  value="{{$filter_value->filter_value}}">{{$filter_value->filter_value}}</option>
                    @endforeach
                </select>
            </div>
        @endif
      @endif
   @endif
@endforeach

