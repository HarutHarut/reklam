<div class="card-body row">
    @if(isset($listing))
        <div class="form-group col-lg-12">
            <a href="{{ route('listing.single.url', $listing->id) }}" >Odpri oglas</a>
        </div>
    @endif
    <div class="form-group col-lg-4">
        <label for="exampleInputEmail1">Naslov</label>
        <input type="text"
               class="form-control"
               name="naslov"
               value="{{ $listing->naslov ?? old('name') }}"
               placeholder="Enter name">
        @error('name')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-lg-4">
        <label for="exampleInputEmail1">Cena</label>
        <input type="number"
               class="form-control"
               name="cena"
               value="{{ $listing->cena ?? old('price') }}"
               placeholder="Enter price">
        @error('price')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group col-lg-4">
        <label for="exampleInputPassword1">Regija</label>
        <select name="regija" class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger"
                style="width: 100%;">
            <option value="" selected>Regije</option>
            @foreach($regions as $region)
                <option value="{{ $region->id }}"
                        @if($listing->regija_id == $region->id || old('regija_id') == $region->id)
                        selected
                    @endif
                >{{ $region->regija }}</option>
            @endforeach
        </select>
        @error('regija_id')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group col-lg-4">
        <label>Datum Poteka</label>
        <input type="datetime-local" class="form-control " name="datum_poteka"
               value="{{  isset($listing->datum_poteka) ? str_replace(' ','T',$listing->datum_poteka) : '' }}"
        >
        @error('datum_poteka')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="form-group col-lg-4">
        <label for="exampleInputEmail1">Opis</label>
        <textarea name="opis" class="form-control" rows="5" placeholder="Enter description">
            {{ $listing->opis ?? old('description') }}
        </textarea>
        @error('description')
            <div class="error text-danger">{{ $message }}</div>
        @enderror
    </div>
</div>
<!-- /.card-body -->


