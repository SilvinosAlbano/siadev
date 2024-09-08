@extends('layouts.app')
@section('title', 'Docente Report')
@section('content')

<div class="card height-auto mt-4">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <h3>Docente Report</h3>
            </div>
        </div>

        <!-- Report Form -->
        <form method="GET" action="{{ route('docentes.report') }}">
            <div class="row gutters-8">
                <div class="col-xl-3 col-lg-3 col-12 form-group">
                    <input type="text" name="nome_docente" value="{{ request('nome_docente') }}" placeholder="Search by Nome Docente" class="form-control">
                </div>
                <div class="col-xl-2 col-lg-3 col-12 form-group">
                    <select class="select2" name="sexo">
                        <option value="">Select Sexo</option>
                        <option value="Masculino" {{ request('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Femenino" {{ request('sexo') == 'Femenino' ? 'selected' : '' }}>Femenino</option>
                    </select>
                </div>
                <div class="col-xl-2 col-lg-3 col-12 form-group">
                    <select class="select2" name="id_estatuto">
                        <option value="">Select Estatuto</option>
                        @foreach($estatutos as $estatuto)
                            <option value="{{ $estatuto->id_estatuto }}" {{ request('id_estatuto') == $estatuto->id_estatuto ? 'selected' : '' }}>
                                {{ $estatuto->estatuto }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-xl-2 col-lg-3 col-12 form-group">
                    <input type="text" name="nivel_educacao" value="{{ request('nivel_educacao') }}" placeholder="Search by Nivel Educacao" class="form-control">
                </div>
                <div class="col-xl-2 col-lg-3 col-12 form-group">
                    <select class="select2" name="controlo_estado">
                        <option value="">Select Controlo Estado</option>
                        <option value="active" {{ request('controlo_estado') == 'active' ? 'selected' : '' }}>Ativo</option>
                        <option value="deleted" {{ request('controlo_estado') == 'deleted' ? 'selected' : '' }}>Nao Ativo</option>
                    </select>
                </div>
                <div class="col-xl-1 col-lg-3 col-12 form-group">
                    <button type="submit" class="fw-btn-fill btn-gradient-yellow">Search</button>
                </div>
            </div>
        </form>

        <!-- Export Button -->
        <a href="{{ route('docentes.export') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-file-export"></i> Export to CSV
        </a>

        @if (session('success'))
            <div class="ui-alart-box">
                <div class="dismiss-alart">                 
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        Well done! {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>                    
                </div>
            </div>
        @endif

        <!-- Display Filtered Data -->
        <div class="table-responsive">
            <table class="table display data-table text-nowrap">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Sexo</th>
                        <th>Data Moris</th>
                        <th>Nivel Educacao</th>
                        <th>Area Especialidade</th>
                        <th>Ano Inicio</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docentes as $docente)
                        <tr>
                            <td>{{ $docente->nome_docente }}</td>
                            <td>{{ $docente->sexo }}</td>
                            <td>{{ $docente->data_moris }}</td>
                            <td>{{ $docente->nivel_educacao }}</td>
                            <td>{{ $docente->area_especialidade }}</td>
                            <td>{{ $docente->ano_inicio }}</td>
                            <td>{{ $docente->controlo_estado ? 'Deleted' : 'Active' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $docentes->links() }}
        </div>
    </div>
</div>

@endsection
