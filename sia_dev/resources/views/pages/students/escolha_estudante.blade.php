@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Esolha Docentes em Departamento</h3>
        <ul>
            <li>
                <a href="/escolha_estudante">Escolha Estudante em Departamento</a>
            </li>
            <li>Estudante</li>
        </ul>
    </div>

    <!-- Breadcubs Area End Here -->
    <!-- Dashboard summery Start Here -->
    <div class="row gutters-20">


    @foreach ($estudante_departamento as $dep)
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="dashboard-summery-one mg-b-20">
                    <a href="{{ route('detailho_escolha_departamento', $dep->id_departamento) }}">
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
                                   <h6> total estudante: </h6>  <span class="counter" data-num="{{ $dep->total_estudante }}">  {{ $dep->total_estudante }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
        
        
    </div>

    <div class="row gutters-20">
        <div class="col-6 mt-4 mb-4">
            <div class="card dashboard-card pd-b-20">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Notificações  Estudantes</h3>
                        </div>
                    </div>                   
                                    
                </div>
            </div>
        </div>
    </div>

@endsection
