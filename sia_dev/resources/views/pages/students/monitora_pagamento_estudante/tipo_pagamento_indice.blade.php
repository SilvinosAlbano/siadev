@extends('layouts.app')
@section('title', 'Dados Docentes')
@section('content')
      

<!-- Breadcrumbs Area Start Here -->
<div class="breadcrumbs-area">
    <h3>Parametros</h3>
    <ul>
        <li>
            <a href="/home">Home</a>
        </li>
        <li>Parametros Indice </li>
    </ul>
</div>
<!-- Breadcrumbs Area End Here -->

<!-- All Subjects Area Start Here -->
<div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Formulario Configura Valor Indice de Departamento</h3>
                    </div>
                </div>

                <!-- Error and Success Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Form for Adding/Editing a Subject -->
                <form method="POST" action="">
                    @csrf
                    @if(isset($mat))
                        @method('PUT')
                    @endif

                    <div class="row">
                         <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Departamento *</label>
                                <select class="select2" name="id_controlo_departamento" onchange="updateTotalIndice(this.value)">
                                    <option value=""></option>
                                    @foreach ($departamento as $data)
                                        <option value="{{ $data->id_departamento }}">{{ $data->nome_departamento }}</option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Ano Academico*</label>
                            <input type="text" name="materia" value="{{ isset($mat) ? $mat->materia : old('materia') }}" class="form-control" required>
                        </div>

                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Total Indice *</label>
                            <input type="text" name="ano_academico" value="{{ isset($mat) ? $mat->ano_academico : old('ano_academico') }}" class="form-control" required>
                        </div>
                       

                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Observacao *</label>
                            <input type="text" name="observacao" value="{{ isset($mat) ? $mat->observacao : old('observacao') }}" class="form-control" required>
                        </div>

                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                                {{ isset($mat) ? 'Update' : 'Save' }}
                            </button>
                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancela</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <!-- Table Displaying All Subjects -->
    <div class="col-8-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Parametro Configura Valor Indice de Departamento</h3>
                    </div>
                </div>

                <div class="table-responsive">
                <table class="table display text-nowrap" id="laravel_datatable">
                    <thead>
                        <tr>
                            <th>Nome Departamento</th>
                            <th>Ano Acadêmico</th>
                            <th>Total Índice</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#laravel_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('get.indicepagamento') }}", // Adjust to your route
            columns: [
                { data: 'nome_departamento', name: 'nome_departamento' },
                { data: 'ano_academico', name: 'ano_academico' },
                { 
                    data: 'total_indice', 
                    name: 'total_indice', 
                    render: function (data, type, row) {
                        return '$' + parseFloat(data).toFixed(2); // Format with 2 decimal places
                    } 
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>


@endsection
