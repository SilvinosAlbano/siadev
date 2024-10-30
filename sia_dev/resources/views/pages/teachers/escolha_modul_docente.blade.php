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
            <li>Docemte</li>
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

    <div class="row gutters-20">
    <div class="col-12 mt-4 mb-4">
        <div class="card dashboard-card pd-b-20">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Total Estatuto per Funcionario</h3>
                    </div>
                </div>
                @foreach ($alerta_tipo_contrato as $data)
                      <div class="alert icon-alart bg-light-green2 text-white" role="alert">
                        <i class="far fa-hand-point-right bg-light-green3"></i>
                      
                        {{ $data->tipo_contrato }}  <p class="text-white"><strong>Total Funcionários:</strong> {{ $data->total_funcionarios }}</p>
                    </div>
                     @endforeach

                                  
            </div>
        </div>
    </div>
        </div>

@endsection
