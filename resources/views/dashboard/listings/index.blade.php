@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Listings Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Listings Table</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Listings</h3>

                                <div class="card-tools">
                                    <form action="{{ route('listings.index') }}" method="GET">

                                        <div class="input-group input-group-sm" style="width: 450px;">
                                            <select id="parent_category_id" name="parent_category_id" class="custom-select form-control-borde">
                                                <option value="" selected>Parent Category</option>
                                                @foreach($categories as $category)
                                                    @if($category->parent_id == null)
                                                        <option value="{{ $category->id }}" {{ isset($_GET['parent_category_id']) && $category->id == $_GET['parent_category_id'] ? 'selected' : '' }}>{{ $category->tip }}</option>
                                                    @endif
                                                @endforeach
{{--                                                <option value="created_at">Created At</option>--}}
                                            </select>
                                            <select id="child_category_id" name="child_category_id" class="custom-select form-control-borde">
                                                <option value="">Child Category</option>
                                            </select>
                                            <input type="text" name="search" class="form-control float-right"
                                                   placeholder="Search" value="{{ $_GET['search'] ?? '' }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i style="font-weight: 900;" class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Naziv</th>
                                        <th>Kategorija</th>
                                        <th>Uporabnik</th>
                                        <th>id Logged</th>
{{--                                        <th>Product Type</th>--}}
{{--                                        <th>Price</th>--}}
{{--                                        <th>Views Count</th>--}}
                                        <th>Datum poteka</th>
                                        <th>Čas spremembe</th>
                                        <th>Ustvarjen </th>
                                        <th>Uredi / izbriši</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($listings as $listing)
                                        <tr>
                                            <td>{{ $listing->id }}</td>
                                            <td>
                                                <a target="_blank" href="{{ route('listing.single.url', $listing->id) }}">
                                                    {{ $listing->naslov }}
                                                </a>
                                            </td>
                                            <td>{{ $listing->kategorijeTip1->tip }}</td>
                                            <td>
                                                @if($listing->user_id !== config('constants.nonLoggedUser') && isset($listing->customer->user))
                                                    <a target="_blank" href="{{ route('users.edit', $listing->customer->user->id) }}">
                                                        {{ $listing->customer->user->name }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $listing->user_id == config('constants.nonLoggedUser') ? 'non logged' : 'logged' }}</td>
{{--                                            <td>{{ $listing->productType($listing->tip_oglasa) }}</td>--}}
{{--                                            <td>{{ $listing->cena }}</td>--}}
{{--                                            <td>{{ $listing->views_count }}</td>--}}
                                            <td>{{ $listing->datum_poteka }}</td>
                                            <td>{{ $listing->datum_spremembe }}</td>
                                            <td>{{ $listing->datum_vnosa }}</td>
                                            <td>
                                                <a href="{{ route('listings.edit', $listing->id) }}" class="btn"
                                                   title="Edit details">
                                                    <i class="text-success nav-icon fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('listings.destroy', $listing->id) }}"
                                                      method="POST"
                                                      style="display: none"
                                                      onsubmit="return confirm('Ali ste prepričani?')">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" onclick="$(this).prev().submit()" title="Delete">
                                                    <i class="text-danger nav-icon fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $listings->links() !!}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection

<script>
    let categories = <?php echo json_encode($categories) ?>
</script>
