@extends('.dashboard.layouts.app')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $regularUser }}</h3>

                                <p>Regular Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ $companyUser }}</h3>

                                <p>Company Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ $nonLoggedListing }}</h3>

                                <p>Non Logged User's Listings</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $loggedListing }}</h3>

                                <p>logged Users Listings</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
{{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-secondary">
                            <div class="inner">
                                <h3>{{ $deactivatedListings }}</h3>

                                <p>Deactivated Listings</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            {{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $expiredListings }}</h3>

                                <p>Expired Listings</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            {{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>

                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $totalRevenue }}</h3>

                                <p>Total Daily Revenue</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            {{--                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>--}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
