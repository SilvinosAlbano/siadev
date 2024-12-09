@extends('layouts.app')

@section('content')
<div class="breadcrumbs-area">
        <ul>
            <li><a href="/escolha_dados_docentes">Escolha Departamento</a></li>
            <li>Monitoramento Dados Finalista Estudnate</li>
        </ul>
        <h2>Finalista Estudantes</h2>
    </div>
<div class="container">
   
    <div class="row mb-3">
        <div class="col-md-4">
            <select id="nome_departamento" class="form-control">
                <option value="">Todos os Departamentos</option>
                @foreach($departamento as $dept)
                    <option value="{{ $dept->nome_departamento }}">{{ $dept->nome_departamento }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <input type="text" id="ano_academico" class="form-control" placeholder="Filtrar por Ano Acadêmico">
        </div>
        <div class="col-md-4">
            <button class="btn btn-primary" id="filter">Filtrar</button>
            <button class="btn btn-secondary" id="reset">Limpar Filtros</button>
        </div>
    </div>


    <table class="table table-bordered" id="finalistaTable">
        <thead>
            <tr>
                <th>#</th>
                <th>NRE</th>
                <th>Nome Completo</th>
                <th>Gênero</th>
                <th>Departamento</th>
                <th>Programa</th>
                <th>Status</th>
                <th>Ano Acadêmico</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#finalistaTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('monitoramento.finalista') }}",
                data: function (d) {
                    d.nome_departamento = $('#nome_departamento').val(); // Get selected department
                    d.ano_academico = $('#ano_academico').val();
                }
            },

            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'nre', name: 'nre' },
                { data: 'complete_name', name: 'complete_name' },
                { data: 'gender', name: 'gender' },
                { data: 'nome_departamento', name: 'nome_departamento' },
                { data: 'tipo_programa', name: 'tipo_programa' },
                { data: 'estatus', name: 'estatus' },
                { data: 'ano_academico', name: 'ano_academico' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ]
        });

        // Filter data
        $('#filter').click(function() {
            table.draw();
        });

        // Reset filters
        $('#reset').click(function() {
            $('#nome_departamento').val(''); // Reset dropdown to default option
            $('#ano_academico').val(''); // Clear year filter
            table.draw(); // Refresh the table
        });

    });
</script>
@endsection
