
@extends('layouts.app')
@section('title', 'Habilitacao')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.teachers.header_teacher')


        <div class="tab-content mt-4">              
            
            @include('pages.teachers.menu_tab')
                
            <div class="card height-auto mb-4">
                    <div class="card-body mb-4">
                     <div class="row">
                         
                         <div class="col-md-6">
                            <div class="heading-layout1">
                              
                            <div class="item-title">
                                    <h3> Informações Pessoais</h3>
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
                                                        <td class="font-medium text-dark-medium">{{ \Carbon\Carbon::parse($detail->data_moris)->format('d-m Y') }}</td>
                                                    </tr>

                                                    
                                                    <tr>
                                                        <td>Tipo Funcionario:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->categoria}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Posição Funcionario:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->nome_pozisaun}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. Contacto:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->no_contacto}}</td>
                                                    </tr>

                                                    <tr>
                                                        <td>E-mail:</td>
                                                        <td class="font-medium text-dark-medium">{{$detail->email}}</td>
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
                                                @if ($detail->id_funcionario)
                                                        <li>
                                                            <a href="{{ route('inserir_naturalidade', $detail->id_funcionario) }}">
                                                                <i class="fas fa-plus text-primary" title="aumentar dados"></i>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    @if ($detail->id_naturalidade_funcionario)
                                                        <li>
                                                            <a href="{{ route('alterar_naturalidade', $detail->id_naturalidade_funcionario) }}">
                                                                <i class="fas fa-edit text-primary" title="editar dados"></i>
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

