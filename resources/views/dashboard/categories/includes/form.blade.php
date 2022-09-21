<div class="card-body row">
    @if($is_child)
        <div class="form-group col-lg-4">
            <label for="exampleInputPassword1">Parent Category</label>
            <select name="parentCategory_id" class="custom-select form-control-borde">
                <option value="" selected>Categories</option>
                @foreach($parentCategories as $parentCategory)
                    <option value="{{ $parentCategory->id }}"
                            @if(isset($category) && $category->parent_id == $parentCategory->id || old('parentCategory_id') == $parentCategory->id)
                            selected
                        @endif>{{ $parentCategory->tip }}</option>
                @endforeach
            </select>
            @error('parentCategory_id')
            <div class="error text-danger">{{ $message }}</div>
            @enderror
        </div>
    @endif
    <div class="form-group col-lg-4">
        <label for="exampleInputEmail1">Name</label>
        <input type="text"
               class="form-control"
               name="tip"
               value="{{ $category->tip ?? old('tip') }}"
               placeholder="Enter name">
        @error('tip')
        <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    {{--        @dd($is_child, !$is_child)--}}
    @if($is_parent)
        <div class="form-group col-lg-4">
            <label>Color Filters</label>
            <input name="color_filters" type="color" class="form-control"
                   value="{{ $category->color_filters ?? old('color_filters') }}">
            @error('color_filters')
            <div class="error text-danger">{{ $message }}</div>
            @enderror
        </div>

        @if(isset($category) && count($customFilters))
            <div class="form-group col-lg-4">
                <label for="exampleInputPassword1">Custom Filters</label>
                <div>
                    <select name="custom_filters[]"
                            class="select2"
                            multiple="multiple"
                            data-placeholder="Custom Filters"
                            data-dropdown-css-class="select2-blue" style="width: 100%;"
                            disabled
                    >
                        @foreach($customFilters as $customFilter)
                            <option
                                @if(isset($customFilter) && in_array($customFilter->id, $category->filters()->pluck('id')->toArray())  || in_array($customFilter->id, old('custom_filters') ?? []))
                                selected
                                @endif
                                value="{{ $customFilter->id }}">{{ $customFilter->naziv }}</option>
                        @endforeach
                    </select>
                </div>
                @error('custom_filters')
                <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
        @endif

        <div class="form-group col-lg-4">
            <label for="exampleInputPassword1">Color Dropdown</label>
            <select name="color_dropdown" class="custom-select form-control-borde">
                <option value="" selected>Color</option>
                @foreach(config('constants.color_dropdown') as $color)
                    <option value="{{ $color }}"
                            @if(isset($category) && $category->color_dropdown == $color || old('color_dropdown') == $color)
                            selected
                        @endif
                    >{{ $color }}</option>
                @endforeach
            </select>
            @error('color_dropdown')
            <div class="error text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-lg-2">
            <label for="exampleInputPassword1">Paid Advertising:
                <input type="checkbox" name="paid"
                       @if(isset($category) && $category->paid == 1 || old('paid') == 1)
                       checked
                       @endif
                       data-bootstrap-switch>
                {{--            <input type="checkbox" name="my-checkbox" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">--}}
            </label>
            @error('paid')
            <div class="error text-danger">{{ $message }}</div>
            @enderror
        </div>
    @endif

    <div class="form-group col-lg-2">
        <label for="exampleInputPassword1">Status:
            <input type="checkbox" name="status"
                   @if(isset($category) && $category->status == 1 || old('status') == 1)
                   checked
                   @endif
                   data-bootstrap-switch>
        </label>
        @error('status')
        <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    @if($is_child)
            <div class="form-group col-lg-4">
                <label for="vrstniRed">Vrstni Red</label>
                <input type="number"
                       class="form-control"
                       name="vrstni_red"
                       value="{{ $category->vrstni_red ?? old('vrstni_red') }}"
                       placeholder="Enter vrstni red">
                @error('vrstni_red')
                    <div class="error text-danger">{{ $message }}</div>
                @enderror
            </div>
    @endif

</div>
<!-- /.card-body -->


