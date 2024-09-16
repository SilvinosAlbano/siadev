@extends('layouts.app')
@section('title', 'Editar Docente')
@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Docentes</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Formulário de Atualização Funcionario ICS</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->
    
    <!-- Update Teacher Area Start Here -->
    <div class="card height-auto mb-8">
        <div class="card-body mb-4 border">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Editar Funcionario</h3>
                </div>
            </div>

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

            <form class="new-added-form mb-4" method="POST" action="{{ route('funcionario.update', $editar->id_funcionario) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Use PUT for update -->
                
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                        <label>Nome Funcionario *</label>
                        <input type="text" name="nome_funcionario" value="{{ old('nome_funcionario', $editar->nome_funcionario) }}" required class="form-control border">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Sexo *</label>
                        <select class="select2" name="sexo">
                            <option value="">Escolha *</option>
                            <option value="Masculino" {{ $editar->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Feminino" {{ $editar->sexo == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                        </select>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Data Nascimento *</label>
                        <input type="date" name="data_moris" value="{{ old('data_moris', $editar->data_moris) }}" class="border form-control">
                    </div>
                </div>

                {{-- Fatim Moris --}}
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Municipio *</label>
                        <select class="select2" name="id_municipio" required>
                            <option value="">Escolha *</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}" {{ $editar->id_municipio == $municipio->id_municipio ? 'selected' : '' }}>{{ $municipio->municipio }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Posto *</label>
                        <select class="select2" name="id_posto_administrativo">
                            <option selected disabled value="">Escolha *</option>
                            @foreach($postos as $posto)
                                <option value="{{ $posto->id_posto_administrativo }}" {{ $editar->id_posto_administrativo == $posto->id_posto_administrativo ? 'selected' : '' }}>{{ $posto->posto_administrativo }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Suco *</label>
                        <select class="select2" name="id_suco">
                            <option selected disabled value="">Escolha *</option>
                            @foreach($sucos as $suco)
                                <option value="{{ $suco->id_sucos }}" {{ $editar->id_sucos == $suco->id_sucos ? 'selected' : '' }}>{{ $suco->sucos }}</option>
                            @endforeach
                        </select>
                    </div>              
                </div>

                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Aldeia *</label>
                        <select class="select2" name="id_aldeias">
                            <option selected disabled value="">Escolha *</option>
                            @foreach($aldeias as $aldeia)
                                <option value="{{ $aldeia->id_aldeia }}" {{ $editar->id_aldeias == $aldeia->id_aldeias ? 'selected' : '' }}>{{ $aldeia->aldeias }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Nacionalidade *</label>
                        <input type="text" name="nacionalidade" value="{{ old('nacionalidade', $editar->nacionalidade) }}" class="form-control border">
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Categoria *</label>
                        <select class="select2" id="categoria" name="categoria" required>
                            <option selected disabled value="">Escolha *</option>
                            <option value="Docente" {{ $editar->categoria == 'Docente' ? 'selected' : '' }}>Docente</option>
                            <option value="Admin" {{ $editar->categoria == 'Admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-2" id="tipoDataRow" style="display: {{ $editar->categoria == 'Admin' ? 'block' : 'none' }};">
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Tipo Categoria Admin *</label>
                        <select class="select2" name="id_tipo_categoria">
                            <option selected disabled value="">Escolha *</option>
                            @foreach ($tipo_admin as $tipo)
                                <option value="{{ $tipo->id_tipo_categoria }}" {{ $editar->id_tipo_categoria == $tipo->id_tipo_categoria ? 'selected' : '' }}>{{ $tipo->tipo_categoria }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Estatuto (P/IP/C) *</label>
                        <select class="select2" name="id_estatuto">
                            <option selected disabled value="">Escolha *</option>
                            @foreach ($estatuto as $est)
                                <option value="{{ $est->id_estatuto }}" {{ $editar->id_estatuto == $est->id_estatuto ? 'selected' : '' }}>{{ $est->estatuto }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Ano Inicio</label>
                        <input type="date" name="ano_inicio" value="{{ old('ano_inicio', $editar->ano_inicio) }}" class="form-control">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Numero de Contacto</label>
                        <input type="text" name="no_contacto" value="{{ old('no_contacto', $editar->no_contacto) }}" class="form-control border">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>E-mail</label>
                        <input type="email" name="email" value="{{ old('email', $editar->email) }}" class="form-control border">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-12 form-group">
                        <label>Observacão</label>
                        <textarea class="textarea form-control border" name="observacao" cols="10" rows="5">{{ old('observacao', $editar->observacao) }}</textarea>
                    </div>
                    <div class="col-lg-4 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Docente Photo (150px X 150px)</label>
                        <input type="file" name="photo_docente" class="form-control-file">
                    </div>
                </div>

                <div class="col-12 form-group mg-t-8">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Atualizar</button>
                    <a href="{{ route('docentes.index') }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
    <!-- Update Teacher Area End Here -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categoria = document.getElementById('categoria');
            var tipoDataRow = document.getElementById('tipoDataRow');
            $('.select2').select2();

            $(categoria).on('change', function() {
                var selectedValue = $(this).val();
                if (selectedValue === 'Admin') {
                    tipoDataRow.style.display = 'block';
                } else {
                    tipoDataRow.style.display = 'none';
                }
            });
        });
    </script>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('select[name="id_municipio"]').on('change', function() {
                var idMunicipio = $(this).val();
                if (idMunicipio) {
                    $.ajax({
                        url: '/get-postos/' + idMunicipio,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="id_posto_administrativo"]').empty();
                            $('select[name="id_posto_administrativo"]').append('<option selected disabled>Escolha *</option>');
                            $.each(data, function(key, value) {
                                $('select[name="id_posto_administrativo"]').append('<option value="' + value.id_posto_administrativo + '">' + value.posto_administrativo + '</option>');
                            });
                        }
                    });
                }
            });

            $('select[name="id_posto_administrativo"]').on('change', function() {
                var idPosto = $(this).val();
                if (idPosto) {
                    $.ajax({
                        url: '/get-sucos/' + idPosto,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="id_suco"]').empty();
                            $('select[name="id_suco"]').append('<option selected disabled>Escolha *</option>');
                            $.each(data, function(key, value) {
                                $('select[name="id_suco"]').append('<option value="' + value.id_sucos + '">' + value.sucos + '</option>');
                            });
                        }
                    });
                }
            });

            $('select[name="id_suco"]').on('change', function() {
                var idSuco = $(this).val();
                if (idSuco) {
                    $.ajax({
                        url: '/get-aldeias/' + idSuco,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
                            $('select[name="id_aldeias"]').empty();
                            $('select[name="id_aldeias"]').append('<option selected disabled>Escolha *</option>');
                            $.each(data, function(key, value) {
                                $('select[name="id_aldeias"]').append('<option value="' + value.id_aldeias + '">' + value.aldeias + '</option>');
                            });
                        }
                    });
                }
            });
        });
    </script>
@endsection
