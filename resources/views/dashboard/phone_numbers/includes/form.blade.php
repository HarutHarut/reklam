<div class="card-body row">

    <div class="form-group col-lg-4">
        <label for="exampleInputEmail1">Filter Phone Number</label>
        <input type="text"
               class="form-control"
               name="phone_number"
               value="{{ isset($phone_number) ? $phone_number->phone_number : '' || old('phone_number') }}"
               placeholder="Enter phone number">
        @error('phone_number')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-lg-4">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" rows="5" placeholder="Enter description">
            {{ $phone_number->description ?? old('description') }}
        </textarea>
        @error('description')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

</div>
