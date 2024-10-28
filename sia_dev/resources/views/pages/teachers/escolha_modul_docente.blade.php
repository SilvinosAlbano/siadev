@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Esolha Docentes em Departamento</h3>
        <ul>
            <li>
                <a href="/escolha_dados_docentes">Escolha Departamento</a>
            </li>
            <li>Admin</li>
        </ul>
    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Dashboard summery Start Here -->
    <div class="row gutters-20">


    @foreach ($departamento as $dep)
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <a href="{{ route('detailho_escolha', $dep->id_departamento) }}">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <div class="item-icon bg-light-green">
                                <i class="flaticon-multiple-users-silhouette text-blue"></i>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="item-content text-wrap">
                                    <div class="item-title text-bold">Departamento {{ $dep->nome_departamento }}</div>
                                    <div class="item-number">
                                   <h6> total docente: </h6>  <span class="counter" data-num="{{ $dep->total_funcionarios }}">  {{ $dep->total_funcionarios }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
        
        
    </div>

@endsection
