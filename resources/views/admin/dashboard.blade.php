@extends('admin.layout.layout')

@section('title', 'Dashboard')
@section('content')
    <section class="section">

        <div  class="row">
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Orders') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$allOrder->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Pending Orders') }}</h4>
                        </div>
                        <div class="card-body">
                           {{$pendingOrder->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Deliver Orders') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$completeOrder->count()}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success text-white">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Cancel Orders') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$cancelOrder->count()}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Earning') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$allOrder->sum('grand_total')}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Pending Earning') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$pendingOrder->sum('grand_total')}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('This Month Earning') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$thisMonthEarning}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary text-white">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('This Year Earning') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$thisYearEarning}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Products') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$totalProducts}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Category') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$totalCategory}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Brand') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$totalBrand}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger text-white">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>{{ __('Total Review') }}</h4>
                        </div>
                        <div class="card-body">
                            {{$totalRating}}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>New User Report</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>New Seller Report</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="sellerChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Order Report</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="orderChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Recent Order</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-nowrap card-table text-center">
                                <thead>
                                <tr>
                                    <th class="text-left">{{ __('Order Id') }}</th>
                                    <th>{{ __('Payment Gateway') }}</th>
                                    <th>{{ __('Date') }}</th>
                                    <th>{{ __('Customer') }}</th>
                                    <th class="text-right"> {{ __('Total') }}</th>
                                    <th>{{ __('Order Status') }}</th>
                                </tr>
                                </thead>
                                <tbody class="list font-size-base rowlink" data-link="row">
                                @foreach($orders as $key => $order)
                                    <tr>
                                        <td class="text-left">{{ $order->id }}</td>
                                        <td>{{ $order->payment_method }}</td>
                                        <td>{{ formatted_date($order->created_at) }}</td>
                                        <td>
                                            <a href="#">{{ $order->users->name }}</a>
                                        </td>
                                        <td >{{ $order->grand_total  }}</td>

                                        <td>
                                            @if($order->order_status ==0)
                                                <span class="badge badge-warning">{{ __('Pending') }}</span>
                                            @elseif($order->order_status == 3)
                                                <span class="badge badge-success">{{ __('Complete') }}</span>
                                            @elseif($order->order_status == 4)
                                                <span class="badge badge-danger">{{ __('Cancel') }}</span>
                                            @elseif($order->order_status == 1)
                                                <span class="badge badge-info">{{ __('Processing') }}</span>
                                            @elseif($order->order_status == 2)
                                                <span class="badge badge-info">{{ __('Shipping') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        var ctx = document.getElementById("userChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels:{!! json_encode($monthName) !!},
                datasets: [{
                    label: 'User',
                    data: {{json_encode($userCount) }},
                    borderWidth: 2,
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });




        var ctx = document.getElementById("orderChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($monthName) !!},
                datasets: [{
                    label: 'Order',
                    data: {{json_encode($orderCount)}},
                    borderWidth: 2,
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });


        var ctx = document.getElementById("sellerChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($monthName) !!},
                datasets: [{
                    label: 'Seller',
                    data: {{json_encode($sellerCount)}},
                    borderWidth: 2,
                    backgroundColor: '#6777ef',
                    borderColor: '#6777ef',
                    borderWidth: 2.5,
                    pointBackgroundColor: '#ffffff',
                    pointRadius: 4
                }]
            },
            options: {
                legend: {
                    display: false
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 150
                        }
                    }],
                    xAxes: [{
                        ticks: {
                            display: false
                        },
                        gridLines: {
                            display: false
                        }
                    }]
                },
            }
        });
    </script>
@endpush
