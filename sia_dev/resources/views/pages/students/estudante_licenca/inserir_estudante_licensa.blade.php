
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
                                    <h3>Licenca Estudante Inserir</h3>
                                </div>
                            
                            </div>
                        
                            <form class="new-added-form mb-4" method="POST" action="{{ route('licensa_estudante.store') }}"   enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_student" value="{{ $id }}">
                              
                                
                                
                                
                                <div class="row">
                                    <div class="col-4-xxxl col-lg-4 col-12 form-group">
                                        <label>Tipo Licensa *</label>
                                             <select class="select2" name="id_tipo_licensa">
                                                <option selected disabled value="">Escolha *</option>
                                                @foreach ($tipo_licensa as $row)
                                                    <option value="{{ $row->id_tipo_licensa }}">{{ $row->nome_tipo_licensa }}</option>
                                                @endforeach
                                            </select>
                                    </div>
                                    <div class="col-4-xxxl col-lg-4 col-12 form-group">
                                        <label>Data Inicio Licensa*</label>
                                        <input type="date" name="data_inicio_licensa" class="form-control border" required>
                                    </div>

                                  
                                    <div class="col-4-xxxl col-lg-4 col-12 form-group">
                                        <label>Data Fim Licensa*</label>
                                        <input type="date" name="data_fim_licensa" class="form-control border" required>
                                    </div>
                                    
                                 
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group border">
                                        <label>Observação</label>
                                        <textarea class="textarea form-control" name="observacao" id="form-message" rows="5"></textarea>
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

