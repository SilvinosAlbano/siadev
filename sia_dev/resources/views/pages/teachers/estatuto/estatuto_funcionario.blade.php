
@extends('layouts.app')
@section('title', 'Estatuto')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.teachers.header_teacher')


          
                    <div class="tab-content mt-4">              
            
                    @include('pages.teachers.menu_tab')
                        
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Estatuto Funcionario</h3>
                            </div>
                          
                        </div>
                        <form class="mg-b-20">
                            <div class="row gutters-8">
                                <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group ms-auto text-end">
                                <a class="fw-btn-fill btn-primary fas fa-plus fs-2 btn-sm" href="{{ route('inserir_estatuto', $detail->id_funcionario) }}"> Inserir  </a>
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
                            <table class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                 
                                        <th>Estatuto Funcionario</th>
                                        <th>Data Inicio</th>
                                        <th>Data Fim</th>
                                        <th>Asaun</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($estatuto as $data)
                                        <tr>
                                            <td>{{ $data->estatuto_funcionario }}</td>
                                            <td>{{ $data->data_inicio }}</td>
                                            <td>{{ $data->data_fim }}</td>
                                           
                                            <td>
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                        <span class="flaticon-more-button-of-three-dots"></span>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-right">
                                                        <!-- Edit button -->
                                                        <a class="dropdown-item" href="{{ route('alterar_estatuto.index', $data->id_estatuto_funcionario) }}">
                                                            <i class="fas fa-edit text-dark-pastel-green"></i> Edit
                                                        </a>


                                                        <!-- Optionally, you can add a delete button -->
                                                        


                                                      <!-- Delete Form -->
                                                      <form method="POST" action="{{ route('estatuto.destroy', $data->id_estatuto_funcionario) }}" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit">
                                                        <i class="fas fa-trash text-orange-peel"></i> Delete
                                                        </button>
                                                    </form>



                                                    </div>
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

