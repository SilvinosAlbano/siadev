@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    
</style>
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area text-center">
    <div class="university-logo">
        <img src="{{ asset('images/logo_con.png') }}" alt="University Logo" class="logo" style="width: 50px;">
    </div>
    <h3 class="mt-1">BEM-VINDO AO DASHBOARD DO SISTEMA DE INFORMAÇÃO ACADÊMICA DO INSTITUTO DE CIÊNCIA DA SAÚDE <br>ICS </h3>
    <ul class="breadcrumb-list">
       
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
                            <div class="item-number"><span>total:</span><span class="counter" data-num="{{$totalEstudante}}">{{$totalEstudante}}</span>
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
                            <div class="item-number"><span>total:</span><span class="counter" data-num="{{$totalFuncionario}}">{{$totalFuncionario}}</span>
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
                    <a href="#">
                        <div class="col-6">
                           
                            <div class="item-content">
                                <div class="item-title">Departamento</div>
                                <div class="item-number"><span>total:</span><span class="counter" data-num="5">5</span>
                                </div>
                            </div>
                        </div>
                    </a>
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
                            <div class="item-title">Faculdade</div>
                            <div class="item-number"><span>total:</span><span class="counter" data-num="1">1</span>
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
        <div class="col-12 col-xl-12 col-6-xxxl">
            <div class="card dashboard-card-one pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Grafico  total de ganhos cada ano- (earning data)</h3>
                        </div>
                    </div>
                    <div class="earning-chart-wrap">
                        <canvas id="earning-line-chart1" width="660" height="320"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-xl-12 col-6-xxxl">
            <div class="card dashboard-card-three pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Grafico Estudante Cateria com Sexo</h3>
                        </div>
                    </div>
                    <div class="doughnut-chart-wrap">
                        <canvas id="student-doughnut-chart1" width="100" height="300"></canvas>
                    </div>
                    <div class="student-report">
                        <div class="student-count pseudo-bg-blue">
                            <h3 class="item-title">Masculino</h3>
                            <div class="item-number">{{ number_format($genderData['Female'] ?? 0) }}</div>
                        </div>
                        <div class="student-count pseudo-bg-yellow">
                            <h3 class="item-title text-20">Femenino</h3>
                            <div class="item-number">{{ number_format($genderData['Male'] ?? 0) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- alertas -->
        
        <div class="row gutters-20">
            <div class="col-xl-12 col-xl-12 col-6-xxxl">
                <div class="card dashboard-card-three pd-b-20">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Grafico Funcionarios ICS  Estatuto -(P/IP/C)
                                </h3>
                            </div>
                        </div>
                        <div class="doughnut-chart-wrap">
                            <canvas id="teacher-doughnut-chart1" width="100" height="300"></canvas>
                        </div>
                    
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-xl-12 col-6-xxxl">
                <div class="card dashboard-card-three pd-b-20">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Grafico Estudante Cada Departamento
                                </h3>
                            </div>
                        </div>
                        <div class="doughnut-chart-wrap">
                        <canvas id="department-bar-chart" width="400" height="400"></canvas>                       
                     </div>
                    
                    </div>
                </div>
            </div>


          
        </div>

        
    <script src="../../js/chart.js"></script>
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
    
<script>
    var genderData = @json($genderData);
    if ($("#student-doughnut-chart1").length) {
        var maleCount = genderData.Male || 0;
        var femaleCount = genderData.Female || 0;

        var doughnutChartData = {
            labels: ["Estudante Feminino", "Estudante Masculino"],
            datasets: [{
                backgroundColor: ["#304ffe", "#ffa601"],
                data: [femaleCount, maleCount],
                label: "Total Students"
            }]
        };

        var doughnutChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutoutPercentage: 65,
            rotation: -9.4,
            animation: {
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: true
            },
        };

        var studentCanvas = $("#student-doughnut-chart1").get(0).getContext("2d");
        var studentChart = new Chart(studentCanvas, {
            type: 'doughnut',
            data: doughnutChartData,
            options: doughnutChartOptions
        });
    }
</script>




<script>
    var countdocentelevel = @json($countdocentelevel);

    if ($("#teacher-doughnut-chart1").length) {
        // Assign counts for each `tipo_contrato`, or default to 0 if not present
        var permanenteCount = countdocentelevel.Permanente || 0;
        var intensivoCount = countdocentelevel.Intensivo || 0;
        var partetempoCount = countdocentelevel['Parte Tempo'] || 0;

        // Doughnut chart data configuration
        var doughnutChartData = {
            labels: ["Docente Permanente", "Docente Intensivo", "Docente Parte Tempo"],
            datasets: [{
                backgroundColor: ["#ff0000", "#ffa601", "#00bcd4"], // Add a color for each label
                data: [permanenteCount, intensivoCount, partetempoCount],
                label: "Total Funcionarios"
            }]
        };

        // Doughnut chart options configuration
        var doughnutChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            cutoutPercentage: 65,
            rotation: -9.4,
            animation: {
                duration: 2000
            },
            legend: {
                display: false
            },
            tooltips: {
                enabled: true
            },
        };

        // Get context and render chart
        var teacherCanvas = $("#teacher-doughnut-chart1").get(0).getContext("2d");
        var teacherChart = new Chart(teacherCanvas, {
            type: 'doughnut',
            data: doughnutChartData,
            options: doughnutChartOptions
        });
    }
</script>



<script>
    var countDepartamento = @json($countDepartamento);

    // Extract labels and data for the bar chart
    var departmentLabels = Object.keys(countDepartamento); // Department names
    var departmentData = Object.values(countDepartamento); // Student counts

    if ($("#department-bar-chart").length) {
        var barChartData = {
            labels: departmentLabels,
            datasets: [{
                label: "Total Estudante por Departament",
                backgroundColor: "#304ffe",  // Bar color
                borderColor: "#304ffe",      // Border color
                borderWidth: 1,
                data: departmentData         // Student counts
            }]
        };

        var barChartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Student Count'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Department'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    enabled: true
                }
            }
        };

        // Initialize Chart.js bar chart
        var departmentCanvas = $("#department-bar-chart").get(0).getContext("2d");
        new Chart(departmentCanvas, {
            type: 'bar', // Use bar chart type
            data: barChartData,
            options: barChartOptions
        });
    }
</script>




@endsection
