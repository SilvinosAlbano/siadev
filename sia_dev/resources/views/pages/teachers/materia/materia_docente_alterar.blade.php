@extends('layouts.app')
@section('title', 'Materia Update')
@section('content') 
    <!-- Identificao Content -->
    @include('pages.teachers.header_teacher')

    <div class="tab-content mt-4 mb-8">
        @include('pages.teachers.menu_tab')
        
        <div class="card height-auto mb-8">
            <div class="card-body border">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Materia Update</h3>
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
            
                <!-- Update form -->
                <form method="POST" action="{{ route('update_docentemateria.update', $edit->id_docente_materia) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="id_funcionario" value="{{ $edit->id_funcionario}}">
                    
                    <div class="row">
                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Materia *</label>
                            <select class="select2" name="id_materia">
                                @foreach($materia as $est)
                                    <option value="{{ $est->id_materia }}" {{ $edit->id_materia == $est->id_materia ? 'selected' : '' }}>
                                        {{ $est->materia }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Data Inicio *</label>
                            <input type="date" name="data_inicio" value="{{ $edit->data_inicio }}" required class="form-control border">
                        </div>

                        <div class="col-xl-4 col-lg-6 col-12 form-group">
                            <label>Data Fim *</label>
                            <input type="date" name="data_fim" value="{{ $edit->data_fim }}" required class="form-control border">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-12 form-group">
                            <label>Observacão</label>
                            <textarea class="textarea form-control border" name="observacao" id="form-message" cols="10" rows="10">{{ $edit->observacao }}</textarea>
                        </div>
                        
                    </div>

                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update</button>
                        <a href="{{ route('materia_docente', $edit->id_funcionario) }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
@endsection
