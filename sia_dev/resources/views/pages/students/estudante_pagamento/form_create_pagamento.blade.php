
@extends('layouts.app')
@section('title', 'Inserir Pagamento')
@section('content') 
 

    
@include('pages.students.header_students')     


          
              <div class="tab-content mt-4 mb-8">              
            
              @include('pages.students.student_menu_tab')
                        
                    <div class="card height-auto">
                        <div class="card-body border">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Pagamento Estudante Inserir</h3>
                                </div>
                            
                            </div>
                        
                            <form class="new-added-form mb-4" method="POST" action="{{ route('store_departamento') }}"   enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_student" value="{{ $id }}">
                                <div class="row">
                                    <div class="col-xl-6 col-lg-6 col-12 form-group">
                                    
                                        <label>Departamento *</label>
                                        <select selected class="select2" name="id_controlo_departamento" readonly>                                           
                                            @foreach ($departamento as $data)
                                                <option selected value="{{ $data->id_controlo_departamento }}" readonly>{{ $data->nome_departamento }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-md-6 form-group">
                                        <label>Semestre *</label>
                                        <select selected class="form-control select2" name="id_semestre" required>
                                            @foreach ($semestre as $data)
                                                <option value="{{ $data->id_semestre }}">
                                                    {{$data->numero_semestre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                 
                                </div>


                                <div class="row">
                                    <div class="col-6-xxxl col-lg-6 col-12 form-group">
                                        <label>Data inicio*</label>
                                        <input type="date" name="data_inicio" class="form-control" required>
                                    </div>

                                    <div class="col-6-xxxl col-lg-6 col-12 form-group">
                                        <label>Data Fim</label>
                                        <input type="date" name="data_fim" class="form-control">
                                    </div>
                                    
                                 
                                </div>
                            

                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                    <a href="" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>

                                </div>
            
                            </form>
                        </div>
                     </div>

             </div>
              
            
     
            
   
@endsection

