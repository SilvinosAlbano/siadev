
@extends('layouts.app')
@section('title', 'Habilitacao Inserir')
@section('content') 
    <!-- Identificao Content -->
    @include('pages.students.header_students')


          
              <div class="tab-content mt-4 mb-8">              
            
              @include('pages.students.student_menu_tab')                        
                    <div class="card height-auto">
                        <div class="card-body border">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Naturalidade Alterar</h3>
                                </div>
                            
                            </div>
                        
                            <form class="new-added-form mb-4" method="POST" action="{{ route('store_naturalidade') }}"   enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                   <input type="hidden" name="id_funcionario" value="{{ $id }}">
                                     <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <label>Municipio *</label>
                                            <select class="select2" name="id_municipio" required>
                                                <option value="">Escolha *</option>
                                                @foreach($municipios as $municipio)
                                                    <option value="{{ $municipio->id_municipio }}">{{ $municipio->municipio }}</option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Posto Adm. *</label>
                                            <select class="select2" name="id_posto_administrativo">
                                                <option selected disabled value="">Escolha *</option>
                                            </select>
                                        </div>

                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Suco *</label>
                                            <select class="select2" name="id_suco">
                                                <option selected disabled value="">Escolha *</option>
                                            </select>                
                                                            
                                        </div>  
                                        
                                        <div class="col-xl-3 col-lg-6 col-12 form-group">
                                            <label>Aldeia *</label>
                                            <select class="select2" name="id_aldeias">
                                                <option selected disabled value="">Escolha *</option>
                                            </select>
                                        </div>
                                </div>
                            
                                <div class="row">
                                
                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Nacionalidade *</label>
                                        <input type="text" name="nacionalidade" placeholder="" value="{{$detail->nacionalidade}}" required class="form-control border">
                                        <!-- <input type="hidden" name="id_docente"> -->
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Endereco Atual *</label>
                                        <input type="text" name="endereco_atual" value="{{$detail->endereco_atual}}" placeholder="" required class="form-control border">
                                        <!-- <input type="hidden" name="id_docente"> -->
                                    </div>

                                    <div class="col-lg-4 col-12 form-group">
                                        <label>Observacão</label>
                                        <textarea class="textarea form-control border" name="observacao" id="form-message" cols="10" rows="5">{{$detail->observacao}}</textarea>
                                    </div>
                                </div>

                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                    <a href="{{ route('habilitacao_funcionario', $detail->id_funcionario) }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>
                                </div>
            
                            </form>
                        </div>
                     </div>

             </div>
              
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

