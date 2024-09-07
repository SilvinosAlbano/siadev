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
                        <a class="btn btn-primary btn-lg" href="/adiciona_docente"><i class="fas fa-plus text-orange-peel"></i>
                            Aumenta Foun</a>
                    </span>
                </div>
            </div>

            {{-- <form class="mg-b-20" method="GET" action="#{{ route('search_docente') }}"> --}}
            <form class="mg-b-20" method="GET" action="#">
                <div class="row gutters-8">
                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" name="status" placeholder="Search by Status (P/IP/C)..."
                            class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                        <input type="text" name="name" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" name="phone" placeholder="Search by Phone ..." class="form-control">
                    </div>
                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                    </div>
                </div>
            </form>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="table-responsive">
                <table id="docentes" class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input checkAll">
                                </div>
                            </th>
                            <th>Nome</th>
                            <th>Sexo</th>
                            <th>Data Moris</th>
                            <th>Nivel Edukasaun</th>
                            <th>Area Especialidade</th>
                            <th>Tinan Hahu</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($docente as $data)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                    </div>
                                </td>
                                <td>{{ $data->nome_docente }}</td>
                                <td>{{ $data->sexo }}</td>
                                <td>{{ $data->data_moris }}</td>
                                <td>{{ $data->nivel_educacao }}</td>
                                <td>{{ $data->area_especialidade }}</td>
                                <td>{{ $data->ano_inicio }}</td>
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('detailho', $data->id_docente) }}"><i
                                                    class="fas fa-eye text-orange-red"></i> Detail</a>
                                            <a class="dropdown-item" href="{{ route('editar', $data->id_docente) }}"><i
                                                    class="fas fa-edit text-dark-pastel-green"></i> Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $docente->links() }}
            </div>
        </div>
    </div>
    <!-- Teacher Table Area End Here -->
@endsection
