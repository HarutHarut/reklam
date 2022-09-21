@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Filters Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Filters Table</li>
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
                                <h3 class="card-title">Filters</h3>

                                <div class="card-tools">
                                    <form action="{{ route('filters.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 300px;">
                                            {{--                                            <select name="order_by" class="custom-select form-control-borde">--}}
                                            {{--                                                <option value="" selected>Order By</option>--}}
                                            {{--                                                <option value="listing_count">Listing count</option>--}}
                                            {{--                                                <option value="created_at">Created At</option>--}}
                                            {{--                                            </select>--}}
                                            <input type="text" name="search" class="form-control float-right"
                                                   placeholder="Search" value="{{ $_GET['search'] ?? '' }}">

                                            <div class="input-group-append">
                                                <button type="submit" class="btn btn-default">
                                                    <i style="font-weight: 900;" class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="box-tools" style="margin-top: 20px; ">
                                        <a href="{{route('filters.create')}}" class="btn btn-primary">Create filter</a>
                                    </div>

                                </div>

                            </div>
                            <!-- /.card-header -->


                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Filter type</th>
                                        <th>Is mandatory</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($filters as $filter)
                                        <tr>
                                            <td>{{ $filter->id }}</td>
                                            <td>{{ $filter->naziv }}</td>
                                            <td>{{ $filter->kategorije->tip }}</td>
                                            <td>{{ config('constants.filter_type.' . $filter->tip) }}</td>
                                            <td>{{ $filter->is_mandatory ?? '' }}</td>

                                            <td>
                                                <a href="{{ route('filters.edit', $filter->id) }}" class="btn"
                                                   title="Edit details">
                                                    <i class="text-success nav-icon fas fa-edit"></i>
                                                </a>


                                                <form action="{{ route('filters.destroy', $filter->id) }}" method="POST"
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
                                {!! $filters->links() !!}
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
