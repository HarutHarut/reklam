@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Filters</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit Filters</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Filters</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('filters.update', $filter->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    @include('dashboard.filters.includes.form', compact('filter', 'categories'))
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="#" type="button" class="btn btn-danger" onclick="$('#delete-filters').submit()"
                           title="Delete">Delete</a>
                    </div>
                </form>
                <form id="delete-filters" action="{{ route('filters.destroy', $filter->id) }}" method="POST"
                      style="display: none"
                      onsubmit="return confirm('Ali ste prepričani?')">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

        </section>
    </div>

@endsection
