@extends('layouts.app')
@section('title', 'Dados Docentes')
@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Docente</h3>
        <ul>
            <li><a href="/home">Home</a></li>
            <li>Dados Docentes</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->

    <!-- Teacher Table Area Start Here -->
    <div class="card height-auto">
    <div class="card-body">
        <div class="heading-layout1">
            <div class="item-title">
                <span>
                    <a class="btn btn-primary btn-lg" href="/adiciona_docente"><i class="fas fa-plus text-orange-peel"></i> Aumenta Foun</a>
                </span>
            </div>
        </div>
        @if (session('error'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        <form class="mg-b-20" method="GET" action="{{ route('docentes.index') }}">
            <div class="row gutters-8">
                <!-- Search by nome_docente -->
                <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                    <input type="text" name="nome_docente" value="{{ request('nome_docente') }}" placeholder="Search by nome_docente..." class="form-control">
                </div>

                <!-- Search by sexo -->
                <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                    <select name="sexo" class="form-control">
                        <option value="" selected disabled>Select sexo</option>
                        <option value="Masculino" {{ request('sexo') == 'Masculino' ? 'selected' : '' }}>Masculino</option>
                        <option value="Feminino" {{ request('sexo') == 'Feminino' ? 'selected' : '' }}>Feminino</option>
                    </select>
                </div>

                <!-- Search by id_estatuto -->
                <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                    <select name="id_estatuto" class="form-control">
                        <option value="" selected disabled>Select Estatuto</option>
                        @foreach($estatutoOptions as $estatuto)
                            <option value="{{ $estatuto->id_estatutu }}" {{ request('id_estatuto') == $estatuto->id_estatutu ? 'selected' : '' }}>
                                {{ $estatuto->estatuto }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                    <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                </div>
            </div>
        </form>

       
       


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

        <div class="table-responsive">
            <table id="docentes" class="table display data-table text-nowrap">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nome</th>
                        <th>Sexo</th>
                        <th>Data Moris</th>
                        <th>Nivel Educacao</th>
                        <th>Ano Inicio</th>
                        <th>Categoria</th>
                        <th>Estado</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($docente as $data)
                        <tr>
                        <!-- <td>{{ $loop->iteration }}</td> -->
                        <td>{{ ($docente->currentPage() - 1) * $docente->perPage() + $loop->iteration }}</td>

                            <td>{{ $data->nome_docente }}</td>
                            <td>{{ $data->sexo }}</td>
                            <td>{{ $data->data_moris }}</td>
                            <td>{{ $data->nivel_educacao }}</td>
                            <td>{{ $data->ano_inicio }}</td>
                            <td>{{ $data->categoria }}</td>

                            <td> 
                            @if (is_null($data->controlo_estado))
                                <span class="text-success">Ativo</span>
                            @elseif ($data->controlo_estado == 'deleted')
                                <span class="text-danger">Nao Ativo</span>
                            @endif
                            </td>
                            <td>
                            <div class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <span class="flaticon-more-button-of-three-dots"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{ route('detailho', $data->id_docente) }}">
                                        <i class="fas fa-eye text-orange-red"></i> Detail
                                    </a>
                                    <a class="dropdown-item" href="{{ route('editar', $data->id_docente) }}">
                                        <i class="fas fa-edit text-dark-pastel-green"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id_docente }}').submit();">
                                        <i class="fas fa-trash text-orange-peel"></i> Delete
                                    </a>
                                </div>

                                <form id="delete-form-{{ $data->id_docente }}" action="{{ route('docentes.destroy', $data->id_docente) }}" method="POST" style="display: none;" onsubmit="return confirm('Are you sure you want to delete this docente?');">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-12">
                    
                    Masculino: {{ $totalMasculino }} -
                    Feminino: {{ $totalFeminino }}
                </div>
            </div>
            {{ $docente->links() }}
        </div>

    </div>
</div>

    <!-- Teacher Table Area End Here -->
@endsection
