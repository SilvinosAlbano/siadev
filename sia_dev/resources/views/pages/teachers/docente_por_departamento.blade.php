@extends('layouts.app')
@section('title', 'Dados Docentes')
@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <ul>
            <li><a href="/escolha_dados_docentes">Escolha Departamento</a></li>
            <li>Dados Docentes</li>
        </ul>
        <h3>Lista Funcionarios em Departamento {{ $docente->nome_departamento }}</h3>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Teacher Table Area Start Here -->
  <div class="card height-auto">
      
 
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
            <a class="btn-fill-lg bg-blue-dark btn-hover-yellow" href="/adiciona_funcionario"> Inserir <i class="fas fa-plus"></i> </a>
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
                    Parabens! {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="table-responsive">
            <table id="laravel_datatable" class="table display text-nowrap table-striped">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sexo</th>
                        <th>Data Moris</th>
                        <th>Departamento</th>
                        <!-- <th>Tipo Contrato</th> -->
                        <th>Estado</th>
                        <th>Acao</th>
                    </tr>
                    <tr>
                        <th><input type="text" id="filter-nome_funcionario" placeholder="Filter Nome" class="form-control form-control-sm"></th>
                        <th>
                            <select id="filter-sexo" class="form-control form-control-sm">
                                <option value="">Select Sexo</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                        </th>
                        <th><input type="text" id="filter-data_moris" placeholder="Filter Data Moris" class="form-control form-control-sm"></th>
                        <th><input type="text" id="filter-nome_departamento" placeholder="Filter Departamento" class="form-control form-control-sm"></th>
                        <th><input type="text" id="filter-estado" placeholder="Filter Estado" class="form-control form-control-sm"></th>
                        <th></th>
                    </tr>
                </thead>
            </table>
        </div>


    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        // Extract id_departamento from the URL
        var url = window.location.href;
        var id_departamento = url.substring(url.lastIndexOf('/') + 1);

        var table = $('#laravel_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('get.docentesdepartamento') }}",
                data: {
                    id_departamento: id_departamento // Send id_departamento as a parameter
                }
            },
            columns: [
                {data: 'nome_funcionario', name: 'nome_funcionario'},
                {data: 'sexo', name: 'sexo'},
                {data: 'data_moris', name: 'data_moris'},
                {data: 'nome_departamento', name: 'nome_departamento'},
                // {data: 'tipo_contrato', name: 'tipo_contrato'},
                {
                    data: 'controlo_estado', 
                    name: 'controlo_estado',
                    render: function(data, type, row) {
                        return data == null ? 'Ativo' : 'Nao Ativo';
                    }
                },
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        // Apply column-wise filters
        $('#filter-nome_funcionario').on('keyup', function () {
            table.column(0).search(this.value).draw();
        });

        $('#filter-sexo').on('change', function () {
            table.column(1).search(this.value).draw();
        });

        $('#filter-data_moris').on('keyup', function () {
            table.column(2).search(this.value).draw();
        });

        $('#filter-categoria').on('keyup', function () {
            table.column(3).search(this.value).draw();
        });

        $('#filter-estado').on('keyup', function () {
            table.column(4).search(this.value).draw();
        });
    });
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
