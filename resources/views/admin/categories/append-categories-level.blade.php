 <div class="form-group">
    <label for="name"  >{{ __('Category Level') }} </label>
    <select name="parent_id" class="form-control">
        <option value="">Main Category</option>
        @foreach($getCategories as $parentCategory)
            <option @isset($category) @selected($category->parent_id == $parentCategory->id) @endif value="{{$parentCategory->id}}">{{$parentCategory->category_name}}</option>
            @foreach($parentCategory->subcategories as $subCategory)
                <option  @isset($category) @selected($category->parent_id == $subCategory->id) @endif value="{{$subCategory->id}}">&nbsp;&raquo;&nbsp;{{$subCategory->category_name}}</option>
            @endforeach
       @endforeach
    </select>
</div>
