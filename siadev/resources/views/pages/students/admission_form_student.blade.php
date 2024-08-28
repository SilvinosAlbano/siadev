@extends('app')
@section('title', 'Students')
@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Estudantes</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Formulário de Submissão de Estudante</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Adicionar novo Estudante</h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false"><i
                            class="bi bi-option"></i>...</a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <form class="new-added-form">
                <div class="row">
                    <div class="col-xl-4 col-lg-12 col-12 form-group">
                        <label>Nome Completo *</label>
                        <input type="text" placeholder="" class="form-control" name="nome_completo_estudante" required>
                    </div>
                    <div class="col-xl-2 col-lg-6 col-12 form-group">
                        <label>Sexo *</label>
                        <select class="select2" name="gender">
                            <option value="" disabled>Selecionar *</option>
                            <option value="1">Masculino</option>
                            <option value="2">Femenino</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Lugar de nascimento *</label>
                        <input type="text" class="form-control" data-position='bottom right' name="place_of_birth">
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Data de Nascimento *</label>
                        <input type="text" placeholder="dd/mm/yyyy" class="form-control air-datepicker"
                            data-position='bottom right' name="date_of_birth">
                        <i class="far fa-calendar-alt"></i>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Número Registo Estudante (NRE)</label>
                        <input type="text" placeholder="" class="form-control" name="nre">
                    </div>

                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Faculdade</label>
                        <input type="text" placeholder="" name="faculty" class="form-control" value="CIÊNCIA DA SAÚDE"
                            readonly>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Departamento *</label>
                        <select class="select2" name="department">
                            <option value="" disabled>Please Select Group *</option>
                            <option value="1">Enfarmagem</option>
                            <option value="2">Medicina Geral</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Semestre *</label>
                        <select class="select2" name="semester">
                            <option value="" disabled>Please Select Religion *</option>
                            <option value="3">Semeste I</option>
                            <option value="3">Semeste II</option>
                            <option value="3">Semeste III</option>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <label>Ano Início</label>
                                    <input type="number" placeholder="" class="form-control" name="start_year">
                                </div>
                                <div class="col-md-6  form-group mg-t-30">
                                    <label class="text-dark-medium">Submeter imagem de Estudante (150px X 150px)</label>
                                    <input type="file" class="form-control-file" name="student_image">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-5">
                            {{-- <div class="row">
                                <div class="col-md-12 form-group"> --}}
                            <label>Observação BIO</label>
                            <textarea class="textarea form-control" name="observation" id="form-message" rows="5"></textarea>
                            {{-- </div>
                            </div> --}}
                        </div>
                    </div>


                    <div class="col-md-12 form-group mg-t-10">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>

                </div>
            </form>
        </div>
    </div>
    <!-- Admit Form Area End Here -->
@endsection
