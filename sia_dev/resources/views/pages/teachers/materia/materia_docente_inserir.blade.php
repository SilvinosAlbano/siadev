@extends('layouts.app')
@section('title', 'Inserir Docente Materia')
@section('content')

@include('pages.teachers.header_teacher')

<div class="tab-content mt-4 mb-8">
    @include('pages.teachers.menu_tab')
    <div class="card height-auto">
        <div class="card-body border">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Materia da Docentes Inserir</h3>
                </div>
            </div>

            <!-- Error and success messages -->
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

            <form class="new-added-form mb-4" method="POST" action="{{ route('store_docentemateria') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id_funcionario" value="{{ $id }}">

                <!-- Semestre Dropdown -->
                <div class="row">
                 <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Departamento *</label>
                    <select id="id_departamento" class="select2 form-control">
                        <option value="">Selecione Departamento</option>
                        @foreach ($departamento as $data)
                            <option value="{{ $data->id_departamento }}">{{ $data->nome_departamento }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Semestre Dropdown -->
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Semestre *</label>
                    <select id="id_semestre" class="select2 form-control">
                        <option value="">Selecione Semestre</option>
                    </select>
                </div>

                <!-- Materia Dropdown -->
                <div class="col-xl-3 col-lg-6 col-12 form-group">
                    <label>Materia Semestre *</label>
                    <select id="id_materia_semestre" class="select2 form-control" name="id_materia_semestre">
                        <option value="">Selecione Materia</option>
                    </select>
                </div>



                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Ano Academico *</label>
                            <input type="number" name="ano_academico" placeholder=""  class="form-control border">
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Data Inicio *</label>
                            <input type="date" name="data_inicio_aula" placeholder="" required class="form-control border">
                            
                        </div>

                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Data Fim *</label>
                            <input type="date" name="data_fim_aula" placeholder=""  class="form-control border">
                            
                        </div>

                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                        
                            <label>Estado de Aula *</label>
                            <select selected class="select2" name="estado_de_aula" readonly>                                           
                                
                                    <option selected value="Ativo" readonly>Ativo</option>
                                    <option selected value="Inativo" readonly>Inativo</option>
                                
                            </select>
                        </div>
                    </div>
                    <!-- Additional Fields (Ano Academico, Data Inicio, etc.) -->

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <a href="{{ route('materia_docente', $detail->id_funcionario) }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>
                    </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Dependent Dropdown -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- JavaScript for Dependent Dropdown -->
<script>
    $(document).ready(function() {
        // Fetch Semestres based on Departamento
        $('#id_departamento').on('change', function() {
            var idDepartamento = $(this).val();
            if (idDepartamento) {
                $.ajax({
                    url: '{{ route("get_semestre_by_departamento") }}',
                    type: 'GET',
                    data: { id_departamento: idDepartamento },
                    success: function(data) {
                        $('#id_semestre').empty();
                        $('#id_semestre').append('<option value="">Selecione Semestre</option>');
                        $.each(data, function(key, value) {
                            $('#id_semestre').append('<option value="'+ value.id_semestre +'">'+ value.numero_semestre +'</option>');
                        });
                        $('#id_materia_semestre').empty();
                        $('#id_materia_semestre').append('<option value="">Selecione Materia</option>');
                    }
                });
            } else {
                $('#id_semestre').empty();
                $('#id_semestre').append('<option value="">Selecione Semestre</option>');
                $('#id_materia_semestre').empty();
                $('#id_materia_semestre').append('<option value="">Selecione Materia</option>');
            }
        });

        // Fetch Materias based on Semestre
        $('#id_semestre').on('change', function() {
            var idSemestre = $(this).val();
            if (idSemestre) {
                $.ajax({
                    url: '{{ route("get_materiasemestre_by_semestre") }}',
                    type: 'GET',
                    data: { id_semestre: idSemestre },
                    success: function(data) {
                        $('#id_materia_semestre').empty();
                        $('#id_materia_semestre').append('<option value="">Selecione Materia</option>');
                        $.each(data, function(key, value) {
                            $('#id_materia_semestre').append('<option value="'+ value.id_materia_semestre +'">'+ value.materia +' ('+ value.numero_semestre +')</option>');
                        });
                    }
                });
            } else {
                $('#id_materia_semestre').empty();
                $('#id_materia_semestre').append('<option value="">Selecione Materia</option>');
            }
        });
    });
</script>


@endsection
