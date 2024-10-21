
@extends('layouts.app')
@section('title', 'Estatuto Inserir')
@section('content') 
    <!-- Identificao Content -->





    
     @include('pages.teachers.header_teacher')


          
              <div class="tab-content mt-4 mb-8">              
            
                    @include('pages.teachers.menu_tab')
                        
                    <div class="card height-auto">
                        <div class="card-body border">
                            <div class="heading-layout1">
                                <div class="item-title">
                                    <h3>Estatuto Funcionario Inserir</h3>
                                </div>
                            
                            </div>
                        
                            <form class="new-added-form mb-4" method="POST" action="{{ route('store_estatuto') }}"   enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                                        <input type="hidden" name="id_funcionario" value="{{ $id }}">
                                        <label>Estatuto (P/IP/C) *</label>
                                        <select class="select2" name="id_estatuto">
                                            <option selected disabled value="">Escolha *</option>
                                            @foreach ($estatuto as $est)
                                                <option value="{{ $est->id_estatuto }}">{{ $est->estatuto }}</option>
                                            @endforeach
                                        </select>
                                   </div>
                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Data Inicio *</label>
                                        <input type="date" name="data_inicio" placeholder="" required class="form-control border">
                                        <!-- <input type="hidden" name="id_docente"> -->
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Data Fim </label>
                                        <input type="date" name="data_fim"  class="form-control border">
                                        
                                    </div>
                                </div>
                            

                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark fas fa-save fa-1x"> Gurdar</button>
                                    
                                    <a href="{{ route('estatuto', $detail->id_funcionario) }}" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</a>


                                </div>
            
                            </form>
                        </div>
                     </div>

             </div>
              
  
@endsection

