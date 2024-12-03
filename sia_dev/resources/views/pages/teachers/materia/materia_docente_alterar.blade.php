@extends('layouts.app')
@section('title', 'Atualizar Docente Matéria')
@section('content')

@include('pages.teachers.header_teacher')

<div class="tab-content mt-4 mb-8">
    @include('pages.teachers.menu_tab')
    <div class="card height-auto">
        <div class="card-body border">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Atualizar Matéria da Docente</h3>
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

            <form class="new-added-form mb-4" method="POST" action="{{ route('update_docentemateria', $detail->id_funcionario) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id_funcionario" value="{{ $detail->id_funcionario }}">

                <!-- Semestre Dropdown -->
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Semestre *</label>
                        <select id="id_semestre" class="select2 form-control">
                            <option value="">Selecione Semestre</option>
                            @foreach ($semestre as $data)
                                <option value="{{ $edit->id_semestre }}" {{ $data->id_semestre == $edit->id_semestre ? 'selected' : '' }}>
                                    {{ $data->numero_semestre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Matéria Semestre *</label>
                        <select id="id_materia_semestre" class="select2 form-control" name="id_materia_semestre">
                            <option value="">Selecione Matéria</option>
                            @foreach ($semestre as $materia)
                                <option value="{{ $materia->id_materia_semestre }}" {{ $materia->id_materia_semestre == $detail->id_materia_semestre ? 'selected' : '' }}>
                                    {{ $materia->materia }} ({{ $materia->numero_semestre }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Ano Acadêmico *</label>
                        <input type="number" name="ano_academico" class="form-control border" value="" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Data Início *</label>
                        <input type="date" name="data_inicio_aula" class="form-control border" value="{{ $detail->data_inicio_aula }}" required>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Data Fim *</label>
                        <input type="date" name="data_fim_aula" class="form-control border" value="{{ $detail->data_fim_aula }}">
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Estado de Aula *</label>
                        <select class="select2" name="estado_de_aula">
                            <option value="Ativo" {{ $detail->estado_de_aula == 'Ativo' ? 'selected' : '' }}>Ativo</option>
                            <option value="Inativo" {{ $detail->estado_de_aula == 'Inativo' ? 'selected' : '' }}>Inativo</option>
                        </select>
                    </div>
                </div>

                <div class="col-12 form-group mg-t-8">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Atualizar</button>
                    <a href="{{ route('materia_docente', $detail->id_funcionario) }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- JavaScript for Dependent Dropdown -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#id_semestre').on('change', function() {
            var idSemestre = $(this).val();
            if (idSemestre) {
                $.ajax({
                    url: '{{ route("get_materiasemestre_by_semestre") }}',
                    type: 'GET',
                    data: { id_semestre: idSemestre },
                    success: function(data) {
                        $('#id_materia_semestre').empty();
                        $('#id_materia_semestre').append('<option value="">Selecione Matéria</option>');
                        $.each(data, function(key, value) {
                            $('#id_materia_semestre').append('<option value="'+ value.id_materia_semestre +'" '+ (value.id_materia_semestre == '{{ $detail->id_materia_semestre }}' ? 'selected' : '') +'>'+ value.materia +' ('+ value.numero_semestre +')</option>');
                        });
                    }
                });
            } else {
                $('#id_materia_semestre').empty();
                $('#id_materia_semestre').append('<option value="">Selecione Matéria</option>');
            }
        });
    });
</script>

@endsection
