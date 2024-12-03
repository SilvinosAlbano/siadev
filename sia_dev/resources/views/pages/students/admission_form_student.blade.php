@extends('layouts.app')
@section('title', 'Students')
@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Estudantes</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Formulário de Submissão de Estudante</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Admit Form Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>{{ isset($student) ? 'Editar Estudante' : 'Adicionar novo Estudante' }}</h3>
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
            <form class="new-added-form mb-4" method="POST" action="{{ isset($student) ? route('students.update', $student->id) : route('students.store') }}"   enctype="multipart/form-data">
                    @csrf
                 
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-7 border">
                                   <div class="row">
                                         <div class="col-xl-6  form-group">
                                            <label>Nome Completo *</label>
                                            <input type="text" class="form-control" name="complete_name"
                                                value="{{ old('complete_name', $student->complete_name ?? '') }}" required>
                                        </div>

                                        <div class="col-md-6 form-group">
                                            <label>Número Registo Estudante (NRE)</label>
                                            <input type="text" class="form-control" name="nre"
                                                value="{{ old('nre', $student->nre ?? '') }}" required>
                                        </div>

                                       
                                        
                                        
                                    </div>
                                    <div class="row">

                                         <div class="col-xl-6  form-group">
                                            <label>Sexo *</label>
                                            <select class="form-control select2" name="gender" required>
                                                <option value="" disabled>Selecionar *</option>
                                                <option value="Male" {{ old('gender', $student->gender ?? '') == 'Male' ? 'selected' : '' }}>
                                                    Masculino</option>
                                                <option value="Female"
                                                    {{ old('gender', $student->gender ?? '') == 'Female' ? 'selected' : '' }}>Feminino</option>
                                            </select>
                                        </div>


                                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Lugar de nascimento *</label>
                                            <input type="text" class="form-control" name="place_of_birth"
                                                value="{{ old('place_of_birth', $student->place_of_birth ?? '') }}" required>
                        
                                        </div>
                                       

                                   </div>

                                 
                    
                           

                         <div class="row">                                                        
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Data de Nascimento *</label>
                                <input type="date" placeholder="dd/mm/yyyy" class="form-control"
                                    data-position='bottom right' name="date_of_birth"
                                    value="{{ old('date_of_birth', isset($student->date_of_birth) ? $student->date_of_birth->format('d/m/Y') : '') }}"
                                    required>
                                </div>
                           
                           
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Ano Início</label>
                              <input type="number" class="form-control" name="start_year"
                                value="{{ old('start_year', $student->start_year ?? '') }}" required>
                            </div>
                        </div>

                       

                        <div class="row">                            
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>Nu. Contacto </label>
                                    <input type="number" name="no_contacto" placeholder="" class="form-control border">
                                </div>

                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>Email </label>
                                    <input type="email" name="email" placeholder="" class="form-control border">
                                </div>
                                

                            </div>

                            <!-- <div class="row">
                                <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    <label>Tipo Estudante *</label>
                                    <select class="select2" id="categoria" name="categoria" required>
                                        <option selected disabled value="">Escolha *</option>
                                        <option value="Sim">Transferencia</option>
                                        <option value="Nao">Não Transferencia</option>
                                    </select>
                                </div>
                            </div> -->

                        <div class="row">
                            <div class="col-lg-12 col-12 form-group">
                                <label>Observacão</label>
                                <textarea class="textarea form-control" name="observation" id="form-message" rows="5">{{ old('observation', $student->observation ?? '') }}</textarea>
                                </div>
                          
                        </div>

                        <div class="row">
                             <div class="col-lg-4 col-12 form-group mg-t-30">
                                    <label class="text-dark-medium">Submeter imagem de Estudante (150px X 150px)</label>
                                <input type="file" class="form-control-file" name="student_image">
                                @if (isset($student) && $student->student_image)
                                    <img src="{{ asset('storage/' . $student->student_image) }}" alt="Student Image"
                                        width="100">
                                @endif
                            </div>
                        </div>

                        <div class="col-12 form-group mg-t-8">
                            <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                            <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                        </div>
                       </div>

                    <!-- sub -->
                                
                    <div class="col-md-5">
                        <fieldset class="border p-2">
                            <legend class="w-auto"><h3>Faculdade</h3></legend>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                <label>Faculdade</label>
                                <input type="text" name="faculty" class="form-control" value="CIÊNCIA DA SAÚDE" readonly>
                    
                                </div>

                                <div class="col-xl-6 col-lg-6 col-12 form-group">                                       
                                    <label>Programa Estudo *</label>
                                    <select class="form-control select2" name="id_programa_estudo" required>
                                        @foreach ($programaEstudo as $data)
                                            <option value="{{ $data->id_programa_estudo }}">
                                                {{ $data->nome_programa }}</option>
                                        @endforeach
                                    </select>
                                   
                                </div>
                            </div>
                        </fieldset>


                        <fieldset class="border p-2">
                            
                            <legend class="w-auto"><h3>Semestre</h3></legend>
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-12 col-md-12 form-group">
                                    <label>Semestre *</label>
                                        <select class="form-control select2" name="id_semestre" required>
                                            @foreach ($semestre as $data)
                                                <option value="{{ $data->id_semestre }}">
                                                    {{$data->numero_semestre}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Ano Semestre </label>
                                        <input type="number" name="ano_semestre" placeholder="" class="form-control border">
                                    </div>
                                    
                                </div>

                               
                        </fieldset>

                        <fieldset class="border p-2">
                            <legend class="w-auto"><h3>Naturalidade</h3></legend>
                            <div class="row">
                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>Municipio </label>
                                    <select class="select2" name="id_municipio">
                                        <option value="">Escolha *</option>
                                        @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id_municipio }}">{{ $municipio->municipio }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    <label>Posto </label>
                                    <select class="select2" name="id_posto_administrativo">
                                        <option selected disabled value="">Escolha *</option>
                                    </select>
                                </div>

                               
                            </div>

                            <div class="row">
                                     <div class="col-xl-6 col-lg-6 col-12 form-group">
                                            <label>Suco </label>
                                            <select class="select2" name="id_suco">
                                                <option selected disabled value="">Escolha *</option>
                                            </select>                
                                                            
                                        </div> 

                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Aldeia </label>
                                        <select class="select2" name="id_aldeias">
                                            <option selected disabled value="">Escolha *</option>
                                        </select>
                                    </div>
                            </div>


                            <div class="row">
                            <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Endereco Atual </label>
                                        <input type="text" name="endereco_atual" placeholder="" class="form-control border">
                                    </div>
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                        <label>Nacionalidade </label>
                                        <input type="text" name="nacionalidade" placeholder="" class="form-control border">
                                    </div>
                                </div>
                        </fieldset>

                     
                    </div>
                 </div>
               </div>        
         </form>
        </div>
    </div>
    <!-- Admit Form Area End Here -->
@endsection
<script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>

<script>
    $(document).ready(function() {
        // When Municipio changes
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

        // When Posto changes
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

        // When Suco changes
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