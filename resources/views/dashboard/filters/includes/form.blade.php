<div class="card-body row">
    <div class="form-group col-lg-4">
        <label for="exampleInputPassword1">Kategorija</label>
        <select name="category_id" class="form-control select2 select2-warning" data-dropdown-css-class="select2-warning"
                style="width: 100%;">
            <option value="" selected>Kategorija</option>
             @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        @if(isset($filter)
                            && $filter->kat_id == $category->id || old('category_id') == $category->id)
                        selected
                    @endif
                >{{ $category->tip }}</option>
            @endforeach
        </select>
        @error('regija_id')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

   <!-- <div class="form-group col-lg-4">
        <label for="exampleInputPassword1">Category</label>
        <select name="category_id" class="form-control"
                style="width: 100%;">
            <option value="" selected>Categories</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}"
                        @if(isset($filter)
                            && $filter->kat_id == $category->id || old('category_id') == $category->id)
                        selected
                    @endif
                >{{ $category->tip }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>-->



    <div class="form-group col-lg-4">
        <label for="exampleInputEmail1">Ime filtra</label>
        <input type="text"
               class="form-control"
               name="name"
               value="{{ isset($filter) ? $filter->naziv : '' || old('name') }}"
               placeholder="Enter name">
        @error('name')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-lg-4">
        <label for="exampleInputPassword1">Tip filtra</label>
        <select name="filter_type" class="form-control filter_type"
                style="width: 100%;">
            <option value="" selected>Tip filtra</option>
            @foreach(config('constants.filter_type') as $key => $filterType)
{{--                @dd($filterType)--}}
                <option value="{{ $key }}"
                        @if(isset($filter) && $filter->tip == $key || old('filter_type') == $key)
                            selected
                        @endif
                >{{ $filterType }}</option>
            @endforeach
        </select>
        @error('category_id')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>



    <div id="range_option" class="form-group hide-options {{ isset($filter) && $filter->tip == 2 ? '' : 'filter-options' }} col-lg-4">
        <label class="control-label" for="ContactNo">Option</label>
        <input type="text"
               class="form-control"
               name="option_range"
               value="{{ isset($filter) && $filter->tip == 2 ? $filter->filtersOptions[0]->option : '' || old('option_range') }}"
               placeholder="Enter name"
        >
        @error('option_range')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div id="options" class="form-group hide-options {{ isset($filter) && $filter->tip !== 2 ? '' : 'filter-options' }} col-lg-4">
        <label class="control-label" for="ContactNo">Options</label>
{{--        <div class="form-group">--}}
            <div class="input-group control-group after-add-more">
                <input
                    type="text"
                    name="options[]"
                    id="options"
                    class="form-control"
                    value="{{ isset($filter) && count($filter->filtersOptions) > 1 ? $filter->filtersOptions[0]->option : '' || old('option_range') }}"
                    placeholder="Enter Option">
                <div class="input-group-btn">
                    <button class="btn btn-success add-more" type="button">
                        <i style="font-weight: 600;" class="fas fa-plus"></i>
                    </button>
                </div>
            </div>
{{--        </div>--}}
        @if(isset($filter) && count($filter->filtersOptions) > 1)
            @foreach($filter->filtersOptions as $options)
                @if (!$loop->first)
                    <div class="copy hide">
                        <div class="control-group input-group" style="margin-top:10px">
                            <input
                                type="text"
                                name="options[]"
                                class="form-control"
                                value="{{ $filter->tip == 1 ? $options->option : null }}"
                                placeholder="Enter Other Option"
                            >
                            <div class="input-group-btn">
                                <button class="btn btn-danger remove" type="button">
                                    <i style="font-weight: 600;" class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

            @endforeach
        @else
            <div class="copy hide">
                <div class="control-group input-group" style="margin-top:10px">
                    <input type="text" name="options[]" class="form-control" placeholder="Enter Other Option">
                    <div class="input-group-btn">
                        <button class="btn btn-danger remove" type="button">
                            <i style="font-weight: 600;" class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @error('options')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>



    <div class="form-group col-lg-4">
        <label class="control-label" for="ContactNo">Is Mandatory:
            <input type="checkbox"
                   name="is_mandatory"
                   @if(isset($filter) && $filter->is_mandatory == 'required' || old('is_mandatory') == 'required')
                       checked
                    @endif
            >
        </label>
        @error('is_mandatory')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>
<!-- /.card-body -->


