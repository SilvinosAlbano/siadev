
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
                                    <h3>Atualizar Estudante Para Finalista</h3>
                                </div>
                            
                            </div>
                        
                            <form class="new-added-form mb-4" method="POST" action="{{ route('finalista.store') }}"   enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_student" value="{{ $id }}">                             
                                
                                <div class="row">                                   
                                    <div class="col-4-xxxl col-lg-6 col-12 form-group">
                                        <label>Ano Academico*</label>
                                        <input type="number" name="ano_academico" class="form-control border" required>
                                    </div>
                                  
                                    <div class="col-4-xxxl col-lg-6 col-12 form-group">
                                        <label>Estatus*</label>
                                        <input type="text" placeholder="Finalista" name="estatus" value="Finalista" class="form-control border" readonly required>
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

