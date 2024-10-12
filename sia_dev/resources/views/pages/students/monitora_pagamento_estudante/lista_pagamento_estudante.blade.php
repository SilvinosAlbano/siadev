@extends('layouts.app')

@section('title', 'Students')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Students</h3>
        <ul>
            <li><a href="/home">Home</a></li>
            <li>Tabela Monitora Pagamento Estudante ICS</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Student Table Area Start Here -->
    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>All Fees Collection</h3>
                            </div>
                          
                        </div>
                      
                        <form id="filter-form" class="mg-b-20">
                            <div class="row gutters-8">
                                <!-- <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                    <input type="text" id="search-id" placeholder="Search by ID ..." class="form-control">
                                </div>
                                <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                                    <input type="text" id="search-name" placeholder="Search by Name ..." class="form-control">
                                </div> -->
                                <div class="col-2-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                    <select id="filter-department" class="form-control">
                                        <option value="">Select Department</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->nome_departamento }}">{{ $department->nome_departamento }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-2-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                    <select id="filter-year" class="form-control">
                                        <option value="">Select Year</option>
                                        @for ($year = date('Y'); $year >= 2000; $year--)
                                            <option value="{{ $year }}">{{ $year }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-2-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                    <select id="filter-month" class="form-control">
                                        <option value="">Select Month</option>
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <!-- Add other months here -->
                                    </select>
                                </div>
                                <div class="col-2-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                    <select id="filter-payment-status" class="form-control">
                                        <option value="">Select Payment Status</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Unpaid">Unpaid</option>
                                    </select>
                                </div>
                                <div class="col-1-xxxl col-xl-1 col-lg-3 col-12 form-group">
                                    <button type="button" id="search-btn" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                                </div>
                            </div>

                            <div class="col-2-xxxl col-xl-2 col-lg-3 col-12 form-group">
                                <button type="button" id="export-excel-btn" class="fw-btn-fill btn-gradient-yellow mb-4">Export to Excel</button>
                                <button type="button" id="export-csv-btn" class="fw-btn-fill btn-gradient-yellow">Export to CSV</button>
                            </div>

                        </form>


                        <div class="table-responsive">
                            <table id="laravel_datatable" class="table display text-nowrap">
                                <thead>
                                    <tr>
                                        <th>NRE</th>
                                        <th>Nome</th>
                                        <th>Sexo</th>
                                        <th>Departamento</th>
                                        <th>Semestre</th>
                                        <th>Data Selu</th>
                                        <th>Tipo Pagamento </th>
                                        <th>Total Selu</th>
                                        <th>Tinan</th>                                       
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                  
                                
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
    <!-- Student Table Area End Here -->

    <!-- <script type="text/javascript">
     $(document).ready(function () {
        var table = $('#laravel_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('get.payment_student') }}",
        columns: [
            {data: 'nre', name: 'nre'},
            {data: 'complete_name', name: 'complete_name'}, 
            {data: 'gender', name: 'gender'},
            {data: 'nome_departamento', name: 'nome_departamento'},
            {data: 'numero_semestre', name: 'numero_semestre'},
            {data: 'data_selu', name: 'data_selu'},  
            {data: 'tipo_selu', name: 'tipo_selu'},
            {
                data: 'total_paid', 
                name: 'total_paid',
                render: function (data, type, row) {
                    // Check if the data is a valid number
                    var totalPaid = parseFloat(data);
                    if (isNaN(totalPaid)) {
                        return '$0.00';  // Return a default value if data is not valid
                    }
                    return '$' + totalPaid.toFixed(2);  // Format the number with $ and two decimal places
                }
            }, 
              {data: 'ano_academico', name: 'ano_academico'}, 
            {
                data: 'payment_status', 
                name: 'payment_status',
                render: function (data, type, row) {
                    // Return badge based on payment status
                    if (data === 'Paid') {
                        return '<span class="badge badge-pill badge-success d-block mg-t-8">Paid</span>';
                    } else {
                        return '<span class="badge badge-pill badge-danger d-block mg-t-8">Unpaid</span>';
                    }
                }
            },           
          
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

 
});
</script> -->



<script type="text/javascript">
$(document).ready(function () {
    var table = $('#laravel_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('get.payment_student') }}",
            data: function (d) {
                d.searchID = $('#search-id').val();
                d.searchName = $('#search-name').val();
                d.filterDepartment = $('#filter-department').val();
                d.filterYear = $('#filter-year').val();  // Send selected year
                d.filterMonth = $('#filter-month').val();  // Send selected month
                d.filterPaymentStatus = $('#filter-payment-status').val();
            }
        },
        columns: [
            {data: 'nre', name: 'nre'},
            {data: 'complete_name', name: 'complete_name'}, 
            {data: 'gender', name: 'gender'},
            {data: 'nome_departamento', name: 'nome_departamento'},
            {data: 'numero_semestre', name: 'numero_semestre'},
            {data: 'data_selu', name: 'data_selu'},  
            {data: 'tipo_selu', name: 'tipo_selu'},
            {
                data: 'total_paid', 
                name: 'total_paid',
                render: function (data, type, row) {
                    var totalPaid = parseFloat(data);
                    if (isNaN(totalPaid)) {
                        return '$0.00';
                    }
                    return '$' + totalPaid.toFixed(2);
                }
            }, 
            {data: 'ano_academico', name: 'ano_academico'}, 
            {
                data: 'payment_status', 
                name: 'payment_status',
                render: function (data, type, row) {
                    return data === 'Paid'
                        ? '<span class="badge badge-pill badge-success d-block mg-t-8">Paid</span>'
                        : '<span class="badge badge-pill badge-danger d-block mg-t-8">Unpaid</span>';
                }
            },           
          
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

    $('#search-btn').on('click', function() {
        table.draw();
    });
});
</script>


<script>
    $('#export-excel-btn').on('click', function() {
    var department = $('#filter-department').val();
    var year = $('#filter-year').val();
    var month = $('#filter-month').val();
    var payment_status = $('#filter-payment-status').val();

    window.location.href = '{{ route('export.payments') }}' 
        + '?filterDepartment=' + department
        + '&filterYear=' + year
        + '&filterMonth=' + month
        + '&filterPaymentStatus=' + payment_status;
});

</script>
@endsection
