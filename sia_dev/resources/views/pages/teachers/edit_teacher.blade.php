@extends('layouts.app')
@section('title', 'Atualizar Docente')
@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Docentes</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Formulário de Atualização de Docentes</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Update Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Atualizar Docente</h3>
                </div>
            </div>
            <form class="new-added-form" method="POST" action="{{ route('docentes.update', $editar->id_docente) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT') <!-- Converts the request to PUT for updating -->

                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-12 form-group">
                        <label>Nome Docente *</label>
                        <input type="text" name="nome_docente" value="{{ $editar->nome_docente }}" required class="form-control border">
                    </div>
                    <div class="col-xl-5 col-lg-6 col-12 form-group">
                        <label>Sexo *</label>
                        <select class="select2" name="sexo">
                            <option value="Masculino" {{ $editar->sexo == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                            <option value="Femenino" {{ $editar->sexo == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                        </select>
                    </div>
                </div>

                {{-- fatin moris --}}
                <div class="row">
                    <div class="col-xl-2 col-lg-6 col-12 form-group">
                        <label>Municipio *</label>
                        <select class="select2" name="id_municipio" required>
                            <option value="Aileu" {{ $editar->id_municipio == 'Aileu' ? 'selected' : '' }}>Aileu</option>
                            <option value="Dili" {{ $editar->id_municipio == 'Dili' ? 'selected' : '' }}>Dili</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12 form-group">
                        <label>Posto *</label>
                        <select class="select2" name="id_posto_administrativo">
                            <option value="001" {{ $editar->id_posto_administrativo == '001' ? 'selected' : '' }}>Remexio</option>
                            <option value="002" {{ $editar->id_posto_administrativo == '002' ? 'selected' : '' }}>Nain Feto</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12 form-group">
                        <label>Suco *</label>
                        <select class="select2" name="suco">
                            <option value="0001" {{ $editar->suco == '0001' ? 'selected' : '' }}>Acumau</option>
                            <option value="001" {{ $editar->suco == '001' ? 'selected' : '' }}>Bairo Pite</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Data Moris *</label>
                        <input type="text" name="data_moris" value="{{ $editar->data_moris }}" placeholder="dd/mm/yyyy" class="border form-control air-datepicker">
                        <i class="far fa-calendar-alt"></i>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Nacionalidade *</label>
                        <input type="text" name="nacionalidade" value="{{ $editar->nacionalidade }}" class="form-control border">
                    </div>
                </div>

                {{-- row habilitasaun --}}
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Nível Educação</label>
                        <input type="text" name="nivel_educacao" value="{{ $editar->nivel_educacao }}" class="form-control border">
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Área Especialidade</label>
                        <input type="text" name="area_especialidade" value="{{ $editar->area_especialidade }}" class="form-control border">
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Universidade Origem</label>
                        <input type="text" name="universidade_origem" value="{{ $editar->universidade_origem }}" class="form-control border">
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Categoria Estatuto (P/IP/C) *</label>
                        <select class="select2" name="id_estatuto">
                            @foreach($estatuto as $est)
                                <option value="{{ $est->id_estatutu }}" {{ $editar->id_estatuto == $est->id_estatutu ? 'selected' : '' }}>
                                    {{ $est->estatuto }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Departamento *</label>
                        <select class="select2" name="id_departamento">
                            @foreach($departamento as $dep)
                                <option value="{{ $dep->id_departamento }}" {{ $editar->id_departamento == $dep->id_departamento ? 'selected' : '' }}>
                                    {{ $dep->departamento }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Ano Início</label>
                        <input type="date" name="ano_inicio" value="{{ $editar->ano_inicio }}" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-12 form-group">
                        <label>Observação</label>
                        <textarea class="textarea form-control border" name="observacao" cols="10" rows="5">{{ $editar->observacao }}</textarea>
                    </div>
                    <div class="col-lg-4 col-12 form-group mg-t-30">
                        <label class="text-dark-medium">Upload Docente Photo (150px X 150px)</label>
                        <input type="file" name="photo_docente" class="form-control-file">
                    </div>
                </div>

                <div class="col-12 form-group mg-t-8">
                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Update Teacher Area End Here -->

@endsection
