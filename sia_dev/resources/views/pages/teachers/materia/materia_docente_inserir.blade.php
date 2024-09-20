
@extends('layouts.app')
@section('title', 'Inserir Docente Materia')
@section('content') 
 

    
     @include('pages.teachers.header_teacher')


          
              <div class="tab-content mt-4 mb-8">              
            
                    @include('pages.teachers.menu_tab')
                        
                    <div class="card height-auto">
                        <div class="card-body border">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Materia da Docentes Inserir</h3>
                                </div>
                            
                            </div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if (session('success'))
                                <div class="alert alert-success">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <form class="new-added-form mb-4" method="POST" action="{{ route('store_docentemateria') }}"   enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_funcionario" value="{{ $id }}">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                    
                                        <label>Materia *</label>
                                        <select selected class="select2" name="id_materia" readonly>                                           
                                            @foreach ($materia as $data)
                                                <option selected value="{{ $data->id_materia }}" readonly>{{ $data->materia }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Data Inicio *</label>
                                        <input type="date" name="data_inicio" placeholder="" required class="form-control border">
                                        <!-- <input type="hidden" name="id_docente"> -->
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Data Fim *</label>
                                        <input type="date" name="data_fim" placeholder=""  class="form-control border">
                                        <!-- <input type="hidden" name="id_docente"> -->
                                    </div>
                                                                     
                                </div>

                                <div class="row">
                                    <div class="col-lg-12 col-12 form-group">
                                        <label>Observacão</label>
                                        <textarea class="textarea form-control border" name="observacao" id="form-message" cols="10" rows="5"></textarea>
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

