
@extends('layouts.app')
@section('title', 'Pagamento Estudante')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.students.header_students')          
                    <div class="tab-content mt-4">              
            
                    @include('pages.students.student_menu_tab')
                        
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                           
                        </div>
                        <form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group ms-auto text-end">
                                <a class="fw-btn-fill btn-primary fas fa-plus fs-2 btn-sm" href="{{ route('Inserir_estudante_licenca', $student->id_student) }}"> Inserir Licensa </a>
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
                        <table class="table display data-table table-striped table-bordered table-box-wrap text-nowrap">
                              <thead>
                                    <tr>        
                                       <th>Tipo Licensa </th>                         
                                        <th>Data Inicio Licensa </th>   
                                        <th>Data Fim Licensa </th>  
                                       
                                        <th>Acao</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($licensa as $data)
                                        <tr>            
                                           <td>{{ $data->nome_tipo_licensa }} </td>                            
                                           <td>{{ \Carbon\Carbon::parse($data->data_inicio_licensa)->format('d-m-Y') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($data->data_fim_licensa)->format('d-m-Y') }}</td>
                                                                                    
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="flaticon-more-button-of-three-dots"></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Edit button -->
                                                        <a class="dropdown-item" href="{{ route('alterar_licensa_estudante', $data->id_licensa_estudante) }}">
                                                            <i class="fas fa-edit text-dark-pastel-green"></i> Edit
                                                        </a>      

                                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $data->id_licensa_estudante }}').submit();">
                                                        <i class="fas fa-trash text-orange-peel"></i> Delete
                                                    </a>

                                                    </div>

                                                    <form id="delete-form-{{ $data->id_licensa_estudante }}" action="{{ route('departamento.destroy', $data->id_licensa_estudante) }}" method="POST" style="display: none;" onsubmit="return confirm('Are you sure you want to delete this data?');">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                              
                            </table>
                        </div>
                        </div>

                    </div>
                </div>

                   </div>
              
  
@endsection

