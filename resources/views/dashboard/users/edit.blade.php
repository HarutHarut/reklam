@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit User</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Edit User</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    @include('dashboard.users.includes.form', compact('user'))
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="#" type="button" class="btn btn-danger" onclick="$('#delete-user').submit()"
                           title="Delete">Delete</a>
                    </div>
                </form>
                <form id="delete-user" action="{{ route('users.destroy', $user->id) }}" method="POST"
                      style="display: none"
                      onsubmit="return confirm('Ali ste prepričani?')">
                    @csrf
                    @method('DELETE')
                </form>
            </div>

        </section>
    </div>

@endsection
