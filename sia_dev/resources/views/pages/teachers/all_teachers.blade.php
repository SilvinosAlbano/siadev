@extends('layouts.app')
@section('title', 'Dados Docentes')
@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Docente</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Dados Docentes</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
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
            <form class="mg-b-20">
                <div class="row gutters-8">
                    <div class="col-3-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Status (P/IP/C)..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-4 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Name ..." class="form-control">
                    </div>
                    <div class="col-4-xxxl col-xl-3 col-lg-3 col-12 form-group">
                        <input type="text" placeholder="Search by Phone ..." class="form-control">
                    </div>
                    <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                        <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
                    </div>
                </div>
            </form>
            <div class="table-responsive">
                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
                <table id="docentes" class="table display data-table text-nowrap">
                    <thead>
                        <tr>
                            <th>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input checkAll">
                                    <!-- <label class="form-check-label">ID</label> -->
                                </div>
                            </th>
                            <!-- <th>Photo</th> -->
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
                                    <!-- <label class="form-check-label">#0021</label> -->
                                </div>
                            </td>
                            <!-- <td class="text-center"><img class=" rounded-circle" width="30" src="{{asset('img/figure/student_2.jpg')}}" alt="student"></td> -->
                            <td>{{$data->nome_docente}}</td>
                            <td>{{$data->sexo}}</td>
                            <td>{{$data->data_moris}}</td>
                            <td>{{$data->nivel_educacao}}</td>
                            <td>{{$data->area_especialidade}}</td>
                            <td>{{$data->ano_inicio}}</td>
                           
                            
                            <td>
                                <div class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                        <span class="flaticon-more-button-of-three-dots"></span>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('detailho', $data->id_docente) }}"><i
                                                class="fas fa-eye text-orange-red"></i> Detail</a>
                                        <a class="dropdown-item" href="{{ route('editar', $data->id_docente) }}"><i
                                                class="fas fa-edit text-dark-pastel-green"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fas fa-trash text-orange-peel"></i> Delete</a>
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
