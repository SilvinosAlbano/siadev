
@extends('layouts.app')
@section('title', 'Semestre Estudante')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.students.header_students')          
         <div class="tab-content mt-4">              
            
               @include('pages.students.student_menu_tab')
                        
                 <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                           <h3>Ficha Semestre Estudante</h3>
                        </div>
                        <form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group ms-auto text-end">
                                <a class="fw-btn-fill btn-primary fas fa-plus fs-2 btn-sm" href="{{ route('inserir_semestre', $student->id_student) }}"> Inserir  </a>
                                </div>
                            </div>

                        </form>
                        @if (session('error'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        @if (session('success'))
                        <div class="ui-alart-box">
                            <div class="dismiss-alart">
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table display data-table table-striped table-bordered table-box-wrap text-wrap">
                                 <thead>
                                    <tr>        
                                        <th>Ano Academico</th>                         
                                        <th>Semestre</th>   
                                        <th>Data Atualiza Semestre</th>                                         
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($semestreEstudantes as $data)
                                        <tr>            
                                        <td>  {{ $data->numero_semestre == '1' ? $data->start_year : $data->ano_semestre }}   </td>
                                        <td>
                                            Semestre @switch($data->numero_semestre)
                                                    @case(1)
                                                        I
                                                        @break
                                                    @case(2)
                                                        II
                                                        @break
                                                    @case(3)
                                                        III
                                                        @break
                                                    @case(4)
                                                        IV
                                                        @break
                                                    @case(5)
                                                        V
                                                        @break
                                                    @case(6)
                                                        VI
                                                        @break
                                                    @case(7)
                                                        VII
                                                        @break
                                                    @case(8)
                                                        VIII
                                                        @break
                                                    @default
                                                        {{ $data->numero_semestre }}
                                                @endswitch
                                            </td>
                            
                                            <td>{{ \Carbon\Carbon::parse($data->data_atualiza_semestre)->format('d-m-Y') }}</td>
                                            <td>
                                            <!-- <a class="btn btn-sm btn-success" href="{{ route('alterar_licensa_estudante', $data->id_semestre_estudante) }}">
                                                    <i class="fas fa-eye"></i> Detail
                                                </a> -->
                                                <!-- Edit button -->
                                                <a class="btn btn-sm btn-success" href="{{ route('alterar_semestre_estudante', $data->id_semestre_estudante) }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <!-- Delete button -->
                                                <a class="btn btn-sm btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id_semestre_estudante }}').submit();">
                                                    <i class="fas fa-trash"></i> Delete
                                                </a>

                                                <form id="delete-form-{{ $data->id_semestre_estudante }}" action="{{ route('destroy_semestre', $data->id_semestre_estudante) }}" method="POST" style="display: none;" onsubmit="return confirm('Are you sure you want to delete this data?');">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>








                <!-- Start Funsaun Finalista -->






                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                           <h3>Ficha Registo  Finalista Estudante</h3>
                        </div>
                        <form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group ms-auto text-end">
                                <a class="fw-btn-fill btn-primary fas fa-plus fs-2 btn-sm" href="{{ route('inserir_finalista', $student->id_student) }}"> Inserir  </a>
                                </div>
                            </div>

                        </form>
                       


                        @if(session('success1'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                             dados sucesso registrar  {{ session('success') }}
                               ✅
                            </div>
                        @endif
                        @if(session('success2'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                           Dados Finalista excluído com sucesso!  {{ session('success') }}
                               ✅
                            </div>
                        @endif
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error1') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table display data-table table-striped table-bordered table-box-wrap text-wrap">
                                <thead>
                                    <tr>        
                                        <th>Ano Academico</th>                                     
                                        <th>Estado</th>                                         
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                    @foreach ($finalista as $data)                                        
                                        <td> {{$data->ano_academico}} </td>
                                         <td> {{$data->estatus}}</td>
                            
                                      
                                              
                                         <td>
                                           
                                         
                                           <!-- Delete button -->
                                           <a class="btn btn-sm btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id_finalista }}').submit();">
                                               <i class="fas fa-trash"></i> Delete
                                           </a>

                                           <form id="delete-form-{{ $data->id_finalista }}" action="{{ route('destroy_finalista', $data->id_finalista) }}" method="POST" style="display: none;" onsubmit="return confirm('Are you sure you want to delete this data?');">
                                               @csrf
                                               @method('DELETE')
                                           </form>
                                       </td>
                                        
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>






          </div>
              
  
@endsection

