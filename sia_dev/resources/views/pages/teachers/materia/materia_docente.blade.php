
@extends('layouts.app')
@section('title', 'Docente Materia')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.teachers.header_teacher')          
                    <div class="tab-content mt-4">              
            
                    @include('pages.teachers.menu_tab')
                        
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Docente Materia</h3>
                            </div>
                          
                        </div>
                        <form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group ms-auto text-end">
                                <a class="fw-btn-fill btn-primary fs-2 btn-sm" href="{{ route('inserir_materia_docente', $detail->id_funcionario) }}">Inserir <i class="fas fa-plus-circle"></i>  </a>
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
                                Well done! {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                        <div class="table-responsive">
                        <table class="table display data-table table-striped table-bordered table-box-wrap text-nowrap">
                                <thead>
                                    <tr>     
                                    <th> Departamento</th>                            
                                        <th> Disciplina</th> 
                                        <th>Semestre</th>     
                                        <th>Data Inicio Aula</th>  
                                        <th>Data fim Aula</th>    
                                        <th>Ano Academico</th>   
                                        <th>Estado de Aula</th>                                     
                                        <th>Asaun</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($materiadocen as $data)
                                        <tr>
                                        <td>{{ $data->departamento_estudante }}</td>
                                            <td>{{ $data->materia }}</td>
                                            <td>{{ $data->numero_semestre }}</td>
                                            <td>{{ $data->data_inicio_aula }}</td>
                                            
                                            <td>{{ $data->data_fim_aula}}</td>
                                            <td>{{ $data->ano_academico }}</td>
                                            <td>{{ $data->estado_de_aula}}</td>
                                           
                                           
                                            <td>
                                            <a class="btn btn-sm btn-success" href="{{ route('detailho_docente_semestre_estudante', $data->id_docente_materia) }}">
                                                <i class="fas fa-eye"></i> Ver Estudante
                                            </a>
                                            <!-- Edit button -->
                                            <a class="btn btn-sm btn-success" href="{{ route('alterar_docentemateria', $data->id_docente_materia) }}">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>

                                            <!-- Delete button -->
                                            <a class="btn btn-sm btn-danger" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id_docente_materia }}').submit();">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>

                                            <form id="delete-form-{{ $data->id_docente_materia }}" action="{{ route('docentemateria.destroy', $data->id_docente_materia) }}" method="POST" style="display: none;" onsubmit="return confirm('Are you sure you want to delete this data?');">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                                
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>                            </table>
                        </div>

                    </div>
                </div>

                   </div>
              
  
@endsection

