@extends('layouts.app')
@section('title', 'Depatamento Update')
@section('content') 
    <!-- Identificao Content -->
    @include('pages.teachers.header_teacher')

    <div class="tab-content mt-4 mb-8">
        @include('pages.teachers.menu_tab')
        
        <div class="card height-auto">
            <div class="card-body border">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Materia Update</h3>
                    </div>
                </div>
            
                <!-- Update form -->
                <form method="POST" action="{{ route('departamento.update', $detail->id_departamento_funcionario) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="id_funcionario" value="{{ $detail->id_funcionario}}">
                    
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                            <label>Faculdade *</label>
                            <select class="select2" name="id_faculdade">
                                @foreach($fac as $est)
                                    <option value="{{ $est->id_faculdade }}" {{ $detail->id_faculdade == $est->id_faculdade ? 'selected' : '' }}>
                                        {{ $est->nome_faculdade }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        

                        <div class="col-xl-6 col-lg-6 col-12 form-group">
                            <label>Departamento *</label>
                            <select class="select2" name="id_departamento">
                                @foreach($dep as $est)
                                    <option value="{{ $est->id_departamento }}" {{ $detail->id_departamento == $est->id_departamento ? 'selected' : '' }}>
                                        {{ $est->nome_departamento }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        
                    </div>
                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Data inicio*</label>
                            <input type="date" name="data_inicio" value="{{$detail->data_inicio}}" class="form-control" required>
                        </div>

                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Data Fim</label>
                            <input type="date" value="{{$detail->data_fim}}" name="data_fim" class="form-control">
                        </div>
                        
                        
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                        <a href="{{ route('departamento', $detail->id_funcionario) }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
