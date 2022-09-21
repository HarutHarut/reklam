<div class="card-body row">
    <div class="form-group col-lg-4">
        <label for="exampleInputEmail1">Name</label>
        <input type="text" class="form-control" name="name" value="{{ $user->name ?? old('name') }}"
            placeholder="Enter name">
        @error('name')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-lg-4">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" name="email" value="{{ $user->email ?? old('email') }}"
            placeholder="Enter email">
        @error('email')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-lg-4">
        <label for="exampleInputPassword1">Role</label>
        <select name="role_id" class="custom-select form-control-borde">
            <option value="" selected>Role</option>
            @foreach ($roles as $role)
                <option value="{{ $role->id }}" @if (($user && $user->role_id && $user->role_id == $role->id) || old('role_id') == $role->id) selected @endif>
                    {{ $role->name }}</option>
            @endforeach
        </select>
        @error('role_id')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-lg-4">
        <label for="">Package</label>
        <select name="package_id" class="custom-select form-control-borde">
            <option value="" selected>Packages</option>
            @foreach ($packages as $package)
                <option value="{{ $package->id }}" @if (($user &&
                    $user->customer &&
                    $user->customer->activePackage &&
                    $user->customer->activePackage->paidItem->id == $package->id) ||
                    old('package_id') == $package->id) selected @endif>
                    {{ $package->title }}</option>
            @endforeach
        </select>
        @error('package_id')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-lg-4">
        <label>Package Duration</label>
        <input type="datetime-local" class="form-control " name="package_duration"
            value="{{ isset($user->customer) && isset($user->customer->activePackage) ? str_replace(' ', 'T', $user->customer->activePackage->package_duration) : '' }}">
        @error('package_duration')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-lg-1">
        <label>Country Code</label>
        <select class="custom-select form-control-borde" name="country_code">
            <option selected value="">Country Code</option>
            <option value="385" @if (($user && $user->customer && $user->customer->country_code == '385') || old('country_code') == '385') selected @endif>
                385
            </option>
            <option value="386" @if (($user && $user->customer && $user->customer->country_code == '386') || old('country_code') == '386') selected @endif>
                386
            </option>
        </select>
        @error('country_code')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-lg-3">
        <label>Phone Number</label>
        <input type="text" class="form-control" name="phone"
            value="{{ isset($user->customer) && $user->customer->telefon ? $user->customer->telefon : old('phone') }}">
        @error('phone')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-lg-4">
        <label for="exampleInputPassword1">Region</label>
        <select name="regija_id" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
            style="width: 100%;">
            <option value="" selected>Regions</option>
            @foreach ($regions as $region)
                <option value="{{ $region->id }}" @if (($user && isset($user->customer) && $user->customer->regija_id == $region->id) ||
                    old('regija_id') == $region->id) selected @endif>
                    {{ $region->regija }}</option>
            @endforeach
        </select>
        @error('regija_id')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-lg-4">
        <label for="exampleInputPassword1">Address</label>
        <input type="text" class="form-control" name="naslov"
            value="{{ isset($user->customer) && $user->customer->naslov ? $user->customer->naslov : old('naslov') }}">
        @error('naslov')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-lg-4">
        <label for="exampleInputPassword1">Status</label>
        <select name="status" class="custom-select form-control-borde">
            <option value="1" @if (($user && $user->customer && $user->customer->status == 1) ) selected @endif>
                Aktiven
            </option>
            <option value="0" @if (($user && $user->customer && $user->customer->status == 0) ) selected @endif>
                Neaktiven
            </option>
        </select>
        @error('status')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="user_id" value="{{ $user->id }}">
    </div>
    
    <input type="hidden" name="user_id" value="{{ $user->id }}">

    <!-- /.card-body -->
