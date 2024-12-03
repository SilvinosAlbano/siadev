
@extends('layouts.app')
@section('title', 'Habilitacao')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.students.header_students')


        <div class="tab-content mt-4">              
             @include('pages.students.student_menu_tab')
                
            <div class="card height-auto mb-4">
                    <div class="card-body mb-4">
                     <div class="row">
                         
                         <div class="col-md-6">
                            <div class="heading-layout1">
                              
                            <div class="item-title">
                                    <h3> Informações Pessoais Estudante</h3>
                                </div>
                            </div>
                                <div class="single-info-details">
                                
                                    <div class="item-content">                              
                                    <div class="item-content">
                                        <div class="header-inline item-header">
                                            <div class="header-elements">
                                                <ul>
                                                    <li><a href="{{ route('students.edit', $student->id_student) }}"><i class="far fa-edit text-primary" title="editar"></i></a></li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="info-table table-responsive">
                                            <table class="table text-nowrap">
                                                <tbody>
                                                    <tr>
                                                        <td>Nome Completo:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->complete_name}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sexo:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->gender}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Data Nascimento:</td>
                                                        <td class="font-medium text-dark-medium">{{ \Carbon\Carbon::parse($detail->data_moris)->format('d-m Y') }}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Local Nascimento:</td>
                                                        <td class="font-medium text-dark-medium">{{ $detail->moris_fatin }}</td>
                                                    </tr>

                                                    
                                                  

                                                  
                                                    <tr>
                                                        <td>No. Contacto:</td>
                                                        <td class="font-medium text-dark-medium"></td>
                                                    </tr>

                                                    <tr>
                                                        <td>E-mail:</td>
                                                        <td class="font-medium text-dark-medium"></td>
                                                    </tr>
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                       

                        <div class="col-md-6">
                            <div class="heading-layout1">
                              
                            <div class="item-title">
                                    <h3> Naturaliddae</h3>
                                </div>
                            </div>
                                <div class="single-info-details">
                                
                                    <div class="item-content">                              
                                    <div class="item-content">
                                        <div class="header-inline item-header">
                                            <div class="header-elements">
                                                <ul>
                                                @if ($detail->id_naturalidade_estudante)
                                                        <!-- Show only the Edit button if id_naturalidade_estudante is not null -->
                                                        <li>
                                                            <a href="{{ route('alterar_naturalidade_estudante', $detail->id_naturalidade_estudante) }}">
                                                                <i class="fas fa-edit text-primary" title="editar dados"></i>
                                                            </a>
                                                        </li>
                                                    @else
                                                        <!-- Show only the Add button if id_naturalidade_estudante is null -->
                                                        <li>
                                                            <a href="{{ route('inserir_naturalidade_estudante', $detail->id_student) }}">
                                                                <i class="fas fa-plus text-primary" title="aumentar dados"></i>
                                                            </a>
                                                        </li>
                                                    @endif

                                                </ul>
                                            </div>
                                        </div>
                                        <div class="info-table table-responsive">
                                            <table class="table text-nowrap">
                                                <tbody>
                                                   
                                                    <tr>
                                                        <td>Municipio:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->municipio}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Posto Adm:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->posto_administrativo}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Suco:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->sucos}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Aldeias:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->aldeias}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Nacionalidade:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->nacionalidade}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Endereco Atual:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->endereco_atual}}</td>
                                                    </tr>
                                                   
                                                
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       </div>
            </div>

           </div>
  
@endsection

