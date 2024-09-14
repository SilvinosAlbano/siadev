@extends('layouts.app')
@section('title', 'Habilitacao Update')
@section('content') 
    <!-- Identificao Content -->
    @include('pages.teachers.header_teacher')

    <div class="tab-content mt-4 mb-8">
        @include('pages.teachers.menu_tab')
        
        <div class="card height-auto">
            <div class="card-body border">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Habilitação Update</h3>
                    </div>
                </div>
            
                <!-- Update form -->
                <form method="POST" action="{{ route('estatuto.update', $detail->id_estatuto_funcionario) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="id_funcionario" value="{{ $detail->id_funcionario}}">
                    
                    <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Categoria Estatuto (P/IP/C) *</label>
                        <select class="select2" name="id_estatuto">
                            @foreach($estatuto as $est)
                                <option value="{{ $est->id_estatuto }}" {{ $detail->id_estatuto == $est->id_estatuto ? 'selected' : '' }}>
                                    {{ $est->estatuto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Area Especialidade *</label>
                            <input type="date" name="data_inicio" value="{{ $detail->data_inicio }}" placeholder="ex: Parteira" required class="form-control border">
                        </div>
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Universidade origem *</label>
                            <input type="date" name="data_fim" value="{{ $detail->data_fim }}"  class="form-control border">
                        </div>
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
