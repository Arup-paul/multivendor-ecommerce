@extends('admin.layout.layout')

@section('title', 'Dashboard')
@section('content')
    <section class="section">


        <div class="row">
            <div class="col-12 col-md-6 col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4>New User</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="userChart"></canvas>
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
        </div>
    </section>

@endsection

@push('script')
    <script>
        var ctx = document.getElementById("userChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels:{!! json_encode($userMonthName) !!},
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
                labels: {!! json_encode($orderMonth) !!},
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
    </script>
@endpush
