@extends('.dashboard.layouts.app')

@section('content')

    <div class="content-wrapper">
        @include('flash::message')
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Payments Table</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Payments Table</li>
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
                                <h3 class="card-title">Payments</h3>

                                <div class="card-tools">
                                    <form action="{{ route('payments.index') }}" method="GET">
                                        <div class="input-group input-group-sm" style="width: 300px;">
                                            <select name="status" class="custom-select form-control-borde">
                                                <option value="" selected>Status</option>
                                                <option value="1">Pending</option>
                                                <option value="2">Completed</option>
                                                <option value="3">Canceled</option>
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
                                        <a href="{{ URL::to('/dashboard/payment/pdf?search=' . (isset($_GET['search']) ? $_GET['search'] : "") . '&status=' . (isset($_GET['status']) ? $_GET['status'] : "")) }}"
                                           target="_blank"
                                           class="btn btn-primary"
                                        >PDF</a>
                                    </div>
                                </div>

                            </div>
                            <!-- /.card-header -->


                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Davcna</th>
                                        <th>User</th>
                                        <th>Address</th>
                                        <th>Znesek</th>
                                        <th>Status Placila</th>
                                        {{--                                        <th>Filter type</th>--}}
                                        {{--                                        <th>Is mandatory</th>--}}
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->cu_davcna }}</td>
                                            <td>
                                                @if(isset($order->customer))
                                                    <a target="_blank"
                                                       href="{{ route('users.edit', $order->customer->user->id) }}">
                                                        {{ $order->customer->user->name }}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>{{ $order->cu_naslov }}</td>
                                            <td>{{ $order->cu_znesek }}</td>
                                            <td>
                                                @if($order->cu_status_placila == 0)
                                                <form
                                                    action="{{ route('payment.change', [ 'order_id' => $order->id ]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <select onchange="$(this).parent().submit()" name="payment_change"
                                                            class="custom-select form-control-borde">
                                                        <option
                                                            {{ $order->cu_status_placila == 0 ? 'selected' : '' }} value="0">
                                                            pending
                                                        </option>
                                                        <option
                                                            {{ $order->cu_status_placila == 1 ? 'selected' : '' }} value="1">
                                                            completed
                                                        </option>
                                                        <option
                                                            {{ $order->cu_status_placila == 2 ? 'selected' : '' }} value="2">
                                                            canceled
                                                        </option>
                                                    </select>
                                                </form>
                                                @else
                                                    <span>{{ $order->cu_status_placila == 1 ? 'completed' : 'canceled' }}</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('payments.show', $order->id) }}" class="btn"
                                                   title="Show details">
                                                    <i class="text-success nav-icon fas fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $orders->links() !!}
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
