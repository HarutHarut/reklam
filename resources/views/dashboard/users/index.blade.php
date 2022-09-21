@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Users Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Users Table</li>
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
                                <h3 class="card-title">Users</h3>

                                <div class="card-tools">
                                    <form action="{{ route('users.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 300px;">
                                            <select name="order_by" class="custom-select form-control-borde">
                                                <option value="" selected>Order By</option>
                                                <option value="listing_count" {{ isset($_GET['order_by']) && $_GET['order_by'] == 'listing_count' ? 'selected' : '' }}>Listing count</option>
                                                <option value="created_at" {{ isset($_GET['order_by']) && $_GET['order_by'] == 'created_at' ? 'selected' : '' }}>Created At</option>
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
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Število oglasov</th>
                                        <th>Paket</th>
                                        <th>Ustvarjen</th>
                                        <th>Uredi / izbriši</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
{{--                                        @dump($user->maliOglases)--}}
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->role->name }}</td>
                                            @if($user->customer->status == 1)
                                                <td>
                                                    <i class="text-success">Aktiven</i>
                                                </td>
                                            @else
                                                <td>
                                                    <i class="text-danger">Neaktiven</i>
                                                </td>
                                            @endif
                                            <td>{{ isset($user->customer) ? count($user->customer->maliOglases) : 0 }}</td>
                                            <td>{{ isset($user->customer) && isset($user->customer->activePackage) ? $user->customer->activePackage->paidItem->title : '' }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                <a href="{{ route('users.edit', $user->id) }}" class="btn" title="Edit details">
                                                    <i class="text-success nav-icon fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                      style="display: none"
                                                      onsubmit="return confirm('Ali ste prepričani?')">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                <a href="#" onclick="$(this).prev().submit()" title="{{__('Delete')}}">
                                                    <i class="text-danger nav-icon fas fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $users->links() !!}
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
