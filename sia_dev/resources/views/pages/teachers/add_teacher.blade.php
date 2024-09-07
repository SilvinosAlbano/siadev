@extends('layouts.app')
@section('title', 'Adicionar Docentes')
@section('content')

    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Docentes</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Formulário de Submissão Docentes</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Adicionar Novo Docentes</h3>
                </div>

            </div>
            <form class="new-added-form" method="POST" action="{{ route('docentes.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-xl-7 col-lg-6 col-12 form-group">
                        <label>Nome Docente *</label>
                        <input type="text" name="nome_docente" placeholder="" required class="form-control border">
                    </div>
                    <div class="col-xl-5 col-lg-6 col-12 form-group">
                        <label>Sexo *</label>
                        <select class="select2" name="sexo">
                            <option value="">Escolha *</option>
                            <option value="Masculino">Masculino</option>
                            <option value="Femenino">Femenino</option>
                        </select>
                    </div>
                </div>

                {{-- fatin moris --}}
                <div class="row">

                    <div class="col-xl-2 col-lg-6 col-12 form-group">
                        <label> Municipio *</label>
                        <select class="select2" name="id_municipio" required>
                            <option value="">Escolha *</option>
                            <option value="Aileu">Aileu</option>
                            <option value="Dili">Dili</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12 form-group">
                        <label>Posto *</label>
                        <select class="select2" name="id_posto_administrativo">
                            <option selected disabled value="">Escolha *</option>
                            <option value="001">Remexio</option>
                            <option value="001">Nain Feto</option>
                        </select>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12 form-group">
                        <label>Suco *</label>
                        <select class="select2" name="suco">
                            <option selected disabled value="">Escolha *</option>
                            <option value="0001">Acumau</option>
                            <option value="001">Bairo Pite</option>

                        </select>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Data Moris *</label>
                        <input type="text" name="data_moris" placeholder="dd/mm/yyyy"
                            class="border form-control air-datepicker">
                        <i class="far fa-calendar-alt"></i>
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Nacionalidade *</label>
                        <input type="text" name="nacionalidade" placeholder="" class="form-control border">
                    </div>
                </div>

                {{-- row habilitasaun --}}

                <div class="row">

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Nivel Educacao</label>
                        <input type="text" name="nivel_educacao" placeholder="" class="form-control border">
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Area Especialidade</label>
                        <input type="text" name="area_especialidade" placeholder="" class="form-control border">
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Universidade Origem</label>
                        <input type="text" name="universidade_origem" placeholder="" class="form-control border">
                    </div>
                </div>

                <div class="row">


                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Categoria Estatuto (P/IP/C) *</label>
                        <select class="select2" name="id_estatuto">
                            <option selected disabled value="">Escolha *</option>
                            @foreach ($estatuto as $est)
                                <option value="{{ $est->id_tipo }}">{{ $est->estatuto }}</option>
                            @endforeach


                        </select>
                    </div>



                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Departamento *</label>
                        <select class="select2" name="id_departamento">
                            <option selected disabled value="">Escolha *</option>
                            @foreach ($departamento as $dep)
                                <option value="{{ $dep->id_departamento }}">{{ $dep->departamento }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Ano Inicio</label>
                        <input type="date" name="ano_inicio" placeholder="" class="form-control">

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-12 form-group">
                        <label>Observacão</label>
                        <textarea class="textarea form-control border" name="observacao" id="form-message" cols="10" rows="5"></textarea>
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
        </div>
        </form>
    </div>
    </div>
    <!-- Add New Teacher Area End Here -->

@endsection
