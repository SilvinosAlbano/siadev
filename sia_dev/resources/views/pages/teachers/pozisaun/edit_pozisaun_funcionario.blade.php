@extends('layouts.app')
@section('title', 'Posição Update')
@section('content') 
    <!-- Identificao Content -->
    @include('pages.teachers.header_teacher')

    <div class="tab-content mt-4 mb-8">
        @include('pages.teachers.menu_tab')
        
        <div class="card height-auto">
            <div class="card-body border">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Atualizar Posição Funcionario</h3>
                    </div>
                </div>
            
                <!-- Update form -->
                <form method="POST" action="{{ route('update_posicao.update', $edit->id_pozisaun_funcionario) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="id_funcionario" value="{{ $edit->id_funcionario }}">
                    
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Nome Posição *</label>
                            <input type="text" name="habilitacao" value="{{ $edit->nome_pozisaun }}"  required class="form-control border">
                        </div>
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Data Inicio Posição *</label>
                            <input type="date" name="data_inicio" value="{{ $edit->data_inicio }}" placeholder="ex: Parteira" required class="form-control border">
                        </div>
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label> Data fim Posição *</label>
                            <input type="date" name="data_fim" value="{{ $edit->data_fim }}" required class="form-control border">
                        </div>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Atualizar</button>
                        <a href="{{ route('posicao_funcionario', $edit->id_funcionario) }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
