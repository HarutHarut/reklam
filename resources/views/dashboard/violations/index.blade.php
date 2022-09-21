@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Violations Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Violations Table</li>
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
                                <h3 class="card-title">Violations</h3>

                                <div class="card-tools">
                                    <form action="{{ route('violations.index') }}" method="GET">

                                        <div class="input-group input-group-sm" style="width: 300px;">
                                            <input type="text" name="search" class="form-control float-right"
                                                   placeholder="Search">

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
                                        <th>Sender</th>
                                        <th>Listing</th>
                                        <th>Zloraba Razlogi</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($violations as $violation)
                                        <tr>
                                            <td>{{ $violation->id }}</td>
                                            <td>
                                                @if(isset($violation->sender_id))
                                                    <a target="_blank"
                                                       href="{{ route('users.edit', $violation->sender->id) }}">
                                                        {{ $violation->sender->name }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a target="_blank"
                                                   href="{{ route('listings.edit', $violation->maliOglasi->id) }}">
                                                    {{ isset($violation->id_oglasa) ? $violation->maliOglasi->naslov : '' }}
                                                </a>
                                            </td>
                                            <td>{{ $violation->zloraba_razlogi }}</td>
                                            <td>
{{--                                                <a href="{{ route('violations.edit', $violation->id) }}" class="btn" title="Edit details">--}}
{{--                                                    <i class="text-success nav-icon fas fa-edit"></i>--}}
{{--                                                </a>--}}
                                                <form action="{{ route('violations.destroy', $violation->id) }}"
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
                                {!! $violations->links() !!}
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
@endsection
