
@extends('layouts.app')
@section('title', 'Habilitacao')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.teachers.header_teacher')


        <div class="tab-content mt-4">              
            
            @include('pages.teachers.menu_tab')
                
            <div class="card height-auto mb-4">
                    <div class="card-body mb-4">
                        <div class="heading-layout1">
                          
                        <div class="item-title">
                                <h3> Pnformações Pessoais</h3>
                            </div>
                        </div>

                        <div class="single-info-details">
                            
                            <div class="item-content">                              
                               <div class="item-content">
                                <div class="header-inline item-header">
                                    <div class="header-elements">
                                        <ul>
                                            <li><a href="{{ route('editar', $detail->id_funcionario) }}"><i class="far fa-edit text-primary" title="editar"></i></a></li>
                                            
                                        </ul>
                                    </div>
                                </div>
                                <div class="info-table table-responsive">
                                    <table class="table text-nowrap">
                                        <tbody>
                                            <tr>
                                                <td>Nome Funcionario:</td>
                                                <td class="font-medium text-dark-medium">{{$detail->nome_funcionario}}</td>
                                            </tr>
                                            <tr>
                                                <td>Sexo:</td>
                                                <td class="font-medium text-dark-medium">{{$detail->sexo}}</td>
                                            </tr>
                                            <tr>
                                                <td>Data Nascimento:</td>
                                                <td class="font-medium text-dark-medium">{{$detail->data_moris}}</td>
                                            </tr>
                                            <tr>
                                                <td>Municipio:</td>
                                                <td class="font-medium text-dark-medium">{{$detail->municipio}}</td>
                                            </tr>
                                            <tr>
                                                <td>Municipio:</td>
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
                                                <td>Nascionalidade:</td>
                                                <td class="font-medium text-dark-medium">{{$detail->nacionalidade}}</td>
                                            </tr>
                                            <tr>
                                                <td>Tipo Funcionario:</td>
                                                <td class="font-medium text-dark-medium">{{$detail->categoria}}</td>
                                            </tr>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

           </div>
  
@endsection

