@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Bookings Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('payments.index') }}">Orders</a></li>
                            <li class="breadcrumb-item active">Bookings Table</li>
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
                                <h3 class="card-title">{{ $order->cu_naziv }} bookings</h3>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Count</th>
{{--                                        <th>Actions</th>--}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($bookings as $booking)
                                        <tr>
                                            <td>{{ $booking->id }}</td>
                                            <td>{{ $booking->o_naziv }}</td>
                                            <td>{{ $booking->o_cena }}</td>
                                            <td>{{ $booking->o_kolicina }}</td>

{{--                                            <td>--}}
{{--                                                <form action="{{ route('filters.destroy', $filter->id) }}" method="POST"--}}
{{--                                                      style="display: none"--}}
{{--                                                      onsubmit="return confirm('Ali ste prepričani?')">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                </form>--}}
{{--                                                <a href="#" onclick="$(this).prev().submit()" title="{{__('Delete')}}">--}}
{{--                                                    <i class="text-danger nav-icon fas fa-trash"></i>--}}
{{--                                                </a>--}}
{{--                                            </td>--}}
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $bookings->links() !!}
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
