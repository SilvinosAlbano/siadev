@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Admin Dashboard</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Admin</li>
        </ul>
    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Dashboard summery Start Here -->
    <div class="row gutters-20">
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-green ">
                            <i class="flaticon-classmates text-green"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Estudante</div>
                            <div class="item-number"><span class="counter" data-num="{{$totalEstudante}}">{{$totalEstudante}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-blue">
                            <i class="flaticon-multiple-users-silhouette text-blue"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Funcionario em Ativo</div>
                            <div class="item-number"><span class="counter" data-num="{{$totalFuncionario}}">{{$totalFuncionario}}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-yellow">
                            <i class="flaticon-couple text-orange"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Parents</div>
                            <div class="item-number"><span class="counter" data-num="5690">5,690</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 col-12">
            <div class="dashboard-summery-one mg-b-20">
                <div class="row align-items-center">
                    <div class="col-6">
                        <div class="item-icon bg-light-red">
                            <i class="flaticon-money text-red"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="item-content">
                            <div class="item-title">Earnings</div>
                            <div class="item-number"><span>$</span><span class="counter" data-num="193000">1,93,000</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard summery End Here -->
    <!-- Dashboard Content Start Here -->
    <div class="row gutters-20">
        <div class="col-12 col-xl-8 col-6-xxxl">
            <div class="card dashboard-card-one pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Earnings</h3>
                        </div>
                    </div>
                    <div class="earning-chart-wrap">
                        <canvas id="earning-line-chart1" width="660" height="320"></canvas>
                    </div>
                </div>
            </div>
    </div>



<!-- Make sure to load main.js where the chart initialization code exists -->


        <div class="col-12 col-xl-4 col-3-xxxl">
            <div class="card dashboard-card-two pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Expenses</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="expense-report">
                        <div class="monthly-expense pseudo-bg-Aquamarine">
                            <div class="expense-date">Jan 2019</div>
                            <div class="expense-amount"><span>$</span> 15,000</div>
                        </div>
                        <div class="monthly-expense pseudo-bg-blue">
                            <div class="expense-date">Feb 2019</div>
                            <div class="expense-amount"><span>$</span> 10,000</div>
                        </div>
                        <div class="monthly-expense pseudo-bg-yellow">
                            <div class="expense-date">Mar 2019</div>
                            <div class="expense-amount"><span>$</span> 8,000</div>
                        </div>
                    </div>
                    <div class="expense-chart-wrap">
                        <canvas id="expense-bar-chart" width="100" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 col-3-xxxl">
            <div class="card dashboard-card-three pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Students</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="doughnut-chart-wrap">
                        <canvas id="student-doughnut-chart" width="100" height="300"></canvas>
                    </div>
                    <div class="student-report">
                        <div class="student-count pseudo-bg-blue">
                            <h4 class="item-title">Female Students</h4>
                            <div class="item-number">45,000</div>
                        </div>
                        <div class="student-count pseudo-bg-yellow">
                            <h4 class="item-title">Male Students</h4>
                            <div class="item-number">1,05,000</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-6 col-4-xxxl">
            <div class="card dashboard-card-four pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Event Calender</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="calender-wrap">
                        <div id="fc-calender" class="fc-calender"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6 col-4-xxxl">
            <div class="card dashboard-card-five pd-b-20">
                <div class="card-body pd-b-14">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Website Traffic</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <h6 class="traffic-title">Unique Visitors</h6>
                    <div class="traffic-number">2,590</div>
                    <div class="traffic-bar">
                        <div class="direct" data-toggle="tooltip" data-placement="top" title="Direct">
                        </div>
                        <div class="search" data-toggle="tooltip" data-placement="top" title="Search">
                        </div>
                        <div class="referrals" data-toggle="tooltip" data-placement="top" title="Referrals">
                        </div>
                        <div class="social" data-toggle="tooltip" data-placement="top" title="Social">
                        </div>
                    </div>
                    <div class="traffic-table table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td class="t-title pseudo-bg-Aquamarine">Direct</td>
                                    <td>12,890</td>
                                    <td>50%</td>
                                </tr>
                                <tr>
                                    <td class="t-title pseudo-bg-blue">Search</td>
                                    <td>7,245</td>
                                    <td>27%</td>
                                </tr>
                                <tr>
                                    <td class="t-title pseudo-bg-yellow">Referrals</td>
                                    <td>4,256</td>
                                    <td>8%</td>
                                </tr>
                                <tr>
                                    <td class="t-title pseudo-bg-red">Social</td>
                                    <td>500</td>
                                    <td>7%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-6 col-4-xxxl">
            <div class="card dashboard-card-six pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1 mg-b-17">
                        <div class="item-title">
                            <h3>Notice Board</h3>
                        </div>
                        <div class="dropdown">
                            <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                aria-expanded="false">...</a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-times text-orange-red"></i>Close</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                <a class="dropdown-item" href="#"><i
                                        class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                            </div>
                        </div>
                    </div>
                    <div class="notice-box-wrap">
                        <div class="notice-list">
                            <div class="post-date bg-skyblue">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag mene esom text
                                    of the
                                    printing.</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-yellow">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag printing.</a>
                            </h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-pink">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag meneesom.</a>
                            </h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-skyblue">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag mene esom text
                                    of the
                                    printing.</a></h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-yellow">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag printing.</a>
                            </h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                        <div class="notice-list">
                            <div class="post-date bg-pink">16 June, 2019</div>
                            <h6 class="notice-title"><a href="#">Great School manag meneesom.</a>
                            </h6>
                            <div class="entry-meta"> Jennyfar Lopez / <span>5 min ago</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    // Pass the data from PHP to JavaScript
    var earningData = @json($data);

    // Prepare the data for the chart
    const labels = earningData.map(item => item.year);
    const dataPoints = earningData.map(item => item.total_earning);

    // Set up the chart data and options
    var lineChartData = {
        labels: labels,
        datasets: [{
            label: "Total Earnings",
            data: dataPoints,
            backgroundColor: 'rgba(255, 0, 0, 0.5)',
            borderColor: '#ff0000',
            borderWidth: 2,
            pointRadius: 5,
            fill: true,
        }]
    };

    var lineChartOptions = {
        responsive: true,
        maintainAspectRatio: false,
        scales: {
            x: {
                title: {
                    display: true,
                    text: 'Year'
                },
                grid: {
                    display: true,
                    color: '#cccccc',
                    borderDash: [5, 5],
                }
            },
            y: {
                title: {
                    display: true,
                    text: 'Total Earnings'
                },
                beginAtZero: true,
                grid: {
                    display: true,
                    color: '#cccccc',
                    borderDash: [5, 5],
                }
            }
        },
        plugins: {
            tooltip: {
                callbacks: {
                    label: function(tooltipItem) {
                        return 'Earnings: ' + tooltipItem.raw + ' $';
                    }
                }
            },
            legend: {
                display: true,
                position: 'top',
            }
        }
    };

    // Create the chart
    var ctx = document.getElementById('earning-line-chart1').getContext('2d');
    var earningChart = new Chart(ctx, {
        type: 'line',
        data: lineChartData,
        options: lineChartOptions
    });
</script>
    

@endsection
