@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Child Categories Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Child Categories Table</li>
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
                                <h3 class="card-title">Child Categories</h3>

                                <div class="card-tools">
                                    <form action="{{ route('childCategories.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 300px;">
                                            <select name="vrstni_red" class="custom-select form-control-borde">
                                                <option value="" selected>Order By</option>\
                                                <option value="vrstni_red" {{ isset($_GET['vrstni_red']) && $_GET['vrstni_red'] == 'vrstni_red' ? 'selected' : '' }}>Vrstni Red</option>

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
                                    <div class="box-tools" style="margin-top: 20px; ">
                                        <a href="{{route('childCategories.create')}}" class="btn btn-primary">Nova kategorija</a>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tip</th>
                                        <th>Status</th>
                                        <th>Parent Category</th>
                                        <th>Vrstni Red</th>

                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->tip }}</td>
                                            <td>{{ $category->status == 1 ? 'active' : 'inactive' }}</td>
                                            <td>{{ $category->parent->tip }}</td>
                                            <td>{{ $category->vrstni_red }}</td>

                                            <td>
                                                <a href="{{ route('childCategories.edit', $category->id) }}" class="btn" title="Edit details">
                                                    <i class="text-success nav-icon fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('childCategories.destroy', $category->id) }}" method="POST"
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
                                {!! $categories->links() !!}
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
