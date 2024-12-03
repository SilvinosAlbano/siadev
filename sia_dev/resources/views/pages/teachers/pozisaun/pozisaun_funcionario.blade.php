
@extends('layouts.app')
@section('title', 'Posicao do Funcionario')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.teachers.header_teacher')


          
                    <div class="tab-content mt-4">              
            
                    @include('pages.teachers.menu_tab')
                        
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Posição do Funcionario</h3>
                            </div>
                          
                        </div>
                        <form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group ms-auto text-end">
                                <a class="fw-btn-fill btn-primary fs-2 btn-sm" href="{{ route('inserir_materia_pozisaun', $detail->id_funcionario) }}">Inserir <i class="fas fa-plus-circle"></i></a>
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
                                Parabens! {{ session('success') }} ✔
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif
                        <div class="table-responsive">
                          <table class="table data-table display table-striped table-bordered table-box-wrap text-nowrap">
                                <thead>
                                    <tr>
                                 
                                        <th>Nome Posição</th>
                                        <th>Data Inicio Posição</th>
                                        <th>Data Fim Posição</th>
                                       
                                        <th>Asaun</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pozisaunFuncionario as $row)
                                        <tr>
                                            <td>{{ $row->nome_pozisaun }}</td>
                                            <td>{{ $row->data_inicio }}</td>
                                            <td>{{ $row->data_fim }}</td>
                                          
                                           
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="flaticon-more-button-of-three-dots"></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Edit button -->
                                                        <a class="dropdown-item" href="{{ route('alterar_posicao', $row->id_pozisaun_funcionario) }}">
                                                            <i class="fas fa-edit text-dark-pastel-green"></i> Edit
                                                        </a>


                                                        <!-- Optionally, you can add a delete button -->
                                                        


                                                      

                                                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $row->id_pozisaun_funcionario }}').submit();">
                                                        <i class="fas fa-trash text-orange-peel"></i> Delete
                                                    </a>

                                                    </div>

                                                    <form id="delete-form-{{ $row->id_pozisaun_funcionario }}" action="{{ route('posicao.destroy', $row->id_pozisaun_funcionario) }}" method="POST" style="display: none;" onsubmit="return confirm('Voce tem certeza de desabilitar😢?');">
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
              
  
@endsection

