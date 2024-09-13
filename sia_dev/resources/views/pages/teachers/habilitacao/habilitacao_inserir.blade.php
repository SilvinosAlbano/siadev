
@extends('layouts.app')
@section('title', 'Habilitacao Inserir')
@section('content') 
    <!-- Identificao Content -->
     @include('pages.teachers.header_teacher')


          
              <div class="tab-content mt-4 mb-8">              
            
                    @include('pages.teachers.menu_tab')
                        
                    <div class="card height-auto">
                        <div class="card-body border">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Habilitação Inserir</h3>
                                </div>
                            
                            </div>
                        
                            <form class="new-added-form mb-4" method="POST" action="{{ route('store_habilitacao') }}"   enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                <input type="hidden" name="id_funcionario" value="{{ $id }}">
                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Nome Habilitação *</label>
                                        <input type="text" name="habilitacao" placeholder="ex: licenciatura" required class="form-control border">
                                        <!-- <input type="hidden" name="id_docente"> -->
                                    </div>
                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Area Especialidade *</label>
                                        <input type="text" name="area_especialidade" placeholder="ex: Parteira" required class="form-control border">
                                        <!-- <input type="hidden" name="id_docente"> -->
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Universidade origem  *</label>
                                        <input type="text" name="universidade_origem" required class="form-control border">
                                        
                                    </div>
                                </div>
                            

                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                    <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                                </div>
            
                            </form>
                        </div>
                     </div>

             </div>
              
  
@endsection

