@extends('layouts.app')
@section('title', 'Dados Docentes')
@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Funcionarios</h3>
        <ul>
            <li><a href="/home">Home</a></li>
            <li>Monitoramento Dados Funcionarios</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
        <div class="card-header shadow bg-white">
            <div class="card-title">
                
                
            </div>
        </div>
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
               
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

       

        @if (session('success'))
        <div class="ui-alart-box">
            <div class="dismiss-alart">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    Well done! {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="table-responsive">
            <table id="laravel_datatable" class="table display text-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>
                            <select id="filterSexo">
                                <option value="">Sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                        </th>
                        <th><input type="text" id="filterDataMoris" placeholder="Filter by Date"></th>
                        <th><input type="text" id="filterCategoria" placeholder="Filter by Category"></th>
                        <th><input type="text" id="filterDepartamento" placeholder="Filter by Departamento"></th>
                        <th>Estado</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>



    </div>
</div>




<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#laravel_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.funcionario.report') }}",
                data: function(d) {
                    d.sexo = $('#filterSexo').val();
                    d.data_moris = $('#filterDataMoris').val();
                    d.categoria = $('#filterCategoria').val();
                    d.nome_departamento = $('#filterDepartamento').val();
                }
            },
            columns: [
                {data: 'nome_funcionario', name: 'nome_funcionario'},
                {data: 'sexo', name: 'sexo'},
                {data: 'data_moris', name: 'data_moris'},
                {data: 'categoria', name: 'categoria'},
                {data: 'nome_departamento', name: 'nome_departamento'},
                {
                    data: 'controlo_estado',
                    name: 'controlo_estado',
                    render: function(data) {
                        return data === null ? 'Ativo' : 'Nao Ativo';
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'csvHtml5',
                    text: 'Export CSV',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'excelHtml5',
                    text: 'Export Excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    text: 'Export PDF',
                    action: function (e, dt, node, config) {
                        // Get the current filters
                        var sexo = $('#filterSexo').val();
                        var data_moris = $('#filterDataMoris').val();
                        var categoria = $('#filterCategoria').val();

                        // Redirect to the PDF export route with filters
                        var url = "{{ route('funcionarios.export.pdf') }}";
                        window.location.href = url + '?sexo=' + sexo + '&data_moris=' + data_moris + '&categoria=' + categoria;
                    }
                }
            ]
        });

        // Apply column filters on change
        $('#filterSexo, #filterDataMoris, #filterCategoria').on('change keyup', function() {
            table.draw();
        });
    });
</script>

</script>
<script type="text/javascript">
    // SweetAlert delete confirmation
    function confirmDelete(deleteUrl) {
        Swal.fire({
            title: 'Tem certeza de apagar este dado?',
            text: "Você não poderá reverter isso!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sim, apagar!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form dynamically and submit the DELETE request
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = deleteUrl;
                form.innerHTML = `
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="_method" value="DELETE">
                `;
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>

@endsection
