
@extends('layouts.app')
@section('title', 'Docente Materia')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.students.header_students')          
                    <div class="tab-content mt-4">              
            
                    @include('pages.students.student_menu_tab')
                        
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
                                <a class="fw-btn-fill btn-primary fas fa-plus fs-2 btn-sm" href=""> Inserir  </a>
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
                                        <th>Nome programa</th>    
                                        <th>Semestre</th>  
                                        <th>Ano</th>                                     
                                        <th>Asaun</th>
                                       
                                    </tr>
                                </thead>
                               
                              
                            </table>
                        </div>

                    </div>
                </div>

                   </div>
              
  
@endsection

