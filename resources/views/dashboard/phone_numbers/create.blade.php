@extends('.dashboard.layouts.app')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Phone Number</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Create Phone Number</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <section class="content-header">

            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Phone Number</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('phone-numbers.store') }}" method="POST">
                    @csrf
{{--                    @method('PATCH')--}}
                    @include('dashboard.phone_numbers.includes.form')
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>

        </section>
    </div>

@endsection
