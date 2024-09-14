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
            <li>Formulário de Submissão Funcionario ICS</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Add New Teacher Area Start Here -->
    <div class="card height-auto mb-8">
        <div class="card-body mb-4 border">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Adicionar Novo Funcionario</h3>
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

                <form class="new-added-form mb-4" method="POST" action="{{ route('docentes.store') }}"   enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                            <label>Nome Funcionario *</label>
                            <input type="text" name="nome_funcionario" placeholder="" required class="form-control border">
                            <!-- <input type="hidden" name="id_docente"> -->
                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Sexo *</label>
                            <select class="select2" name="sexo">
                                <option value="">Escolha *</option>
                                <option value="Masculino">Masculino</option>
                                <option value="Feminino">Feminino</option>
                            </select>
                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Data Nascimento *</label>
                            <input type="date" name="data_moris" placeholder="dd/mm/yyyy"
                                class="border form-control">
                            <!-- <i class="far fa-calendar-alt"></i> -->
                        </div>
                    </div>

                    {{-- fatin moris --}}
                    <div class="row">

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Municipio *</label>
                        <select class="select2" name="id_municipio" required>
                            <option value="">Escolha *</option>
                            @foreach($municipios as $municipio)
                                <option value="{{ $municipio->id_municipio }}">{{ $municipio->municipio }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Posto *</label>
                        <select class="select2" name="id_posto_administrativo">
                            <option selected disabled value="">Escolha *</option>
                        </select>
                    </div>

                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                        <label>Suco *</label>
                        <select class="select2" name="id_suco">
                            <option selected disabled value="">Escolha *</option>
                        </select>                
                                        
                    </div>              
                
                 </div>                

                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Aldeia *</label>
                            <select class="select2" name="id_aldeias">
                                <option selected disabled value="">Escolha *</option>
                            </select>
                        </div>
                      <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Nacionalidade *</label>
                            <input type="text" name="nacionalidade" placeholder="" class="form-control border">
                        </div>

                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Categoria *</label>
                            <select class="select2" id="categoria" name="categoria" required>
                                <option selected disabled value="">Escolha *</option>
                                <option value="Docente">Docente</option>
                                <option value="Admin">Admin</option>
                            </select>
                        </div>
                        
                    </div>
                    
                    <div class="row mb-2" id="tipoDataRow" style="display: none;">
                            <div class="col-xl-4 col-lg-6 col-12 form-group">
                                <label>Tipo Categoria Admin *</label>
                                <select class="select2" name="id_tipo_categoria">
                                    <option selected disabled value="">Escolha *</option>
                                    @foreach ($tipo_admin as $est)
                                        <option value="{{ $est->id_tipo_categoria }}">{{ $est->tipo_categoria }}</option>
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
                                    <option value="{{ $est->id_estatuto }}">{{ $est->estatuto }}</option>
                                @endforeach
                            </select>
                        </div>

                      
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Ano Inicio</label>
                            <input type="date" name="ano_inicio" placeholder="" class="form-control">

                        </div>

                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>Numero de Contacto</label>
                            <input type="text" name="no_contacto" placeholder="" class="form-control border">

                        </div>
                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                            <label>E-mail</label>
                            <input type="email" name="email" placeholder="" class="form-control border">

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
        
                </form>
        </div>
    </div>
    <!-- Add New Teacher Area End Here -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var categoria = document.getElementById('categoria');
            var tipoDataRow = document.getElementById('tipoDataRow');

            // Ensure the select2 is initialized before we add the event listener
            $('.select2').select2();

            // Initially hide the Tipo Data field
            tipoDataRow.style.display = 'none';

            // Event listener for change on Categoria field
            $(categoria).on('change', function() {
                var selectedValue = $(this).val(); // Get the selected value
                if (selectedValue === 'Admin') {
                    tipoDataRow.style.display = 'block'; // Show the field when Admin is selected
                } else {
                    tipoDataRow.style.display = 'none'; // Hide the field for other options
                }
            });
        });
    </script>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
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


@endsection
