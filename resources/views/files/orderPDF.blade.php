<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Orders</h3>

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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->cu_davcna }}</td>
                                            <td>{{ $order->customer->user->name }}</td>
                                            <td>{{ $order->cu_naslov }}</td>
                                            <td>{{ $order->cu_znesek }}</td>
                                            <td>

                                                @if($order->cu_status_placila == 0)
                                                    pending
                                                @elseif($order->cu_status_placila == 1)
                                                    completed
                                                @else
                                                    canceled
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
    </section>
</div>

