
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
                        
                            <form class="new-added-form mb-4" method="POST" action="{{ route('pagamento.store') }}"   enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id_student" value="{{ $id }}">
                              
                                <div class="row">
                                  <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Departamento *</label>
                                        <select class="select2" name="id_controlo_departamento" onchange="updateTotalIndice(this.value)">
                                            <option value=""></option>
                                            @foreach ($departamento as $data)
                                                <option value="{{ $data->id_controlo_departamento }}">{{ $data->nome_departamento }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-xl-4 col-lg-6 col-12 form-group">
                                        <label>Total Índice cada Departamento:</label>
                                        <input type="text" class="form-control" id="totalIndice" name="total_indice" readonly value="">
                                    </div>

                                    <div class="col-md-4 form-group">
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
                                    <div class="col-4-xxxl col-lg-3 col-12 form-group">
                                        <label>Data Selu*</label>
                                        <input type="date" name="data_selu" class="form-control" required>
                                    </div>

                                    <div class="col-md-4 form-group">
                                        <label>Tipo Selu *</label>
                                        <select selected class="form-control select2" name="tipo_selu" required>
                                           
                                                <option value="Selu 1"> Selu 1 </option>
                                                <option value="Selu 2"> Selu 2 </option>
                                                <option value="Selu 3"> Selu 3 </option>
                                                <option value="Selu 4"> Selu 4 </option>
                                                <option value="Selu 5"> Selu 5</option>
                                                
                                            
                                        </select>
                                    </div>

                                    <div class="col-4-xxxl col-lg-3 col-12 form-group">
                                        <label>Selu Total*</label>
                                        <input type="text" name="selu_total" placeholder="$" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');"
                                            class="form-control" required>
                                    </div>
                                    
                                 
                                </div>
                                <div class="row">
                                    <div class="col-md-12 form-group">
                                        <label>Observação</label>
                                        <textarea class="textarea form-control" name="observacao" id="form-message" rows="5">{{ old('observation', $student->observation ?? '') }}</textarea>
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
              

     
             <script>
                // Pastikan data departamento tersedia dalam JavaScript
                var departamento = <?php echo json_encode($departamento); ?>;

                function updateTotalIndice(selectedDepartment) {
                    var totalIndice = 0; // Inisialisasi nilai awal

                    // Cari total_indice berdasarkan id_controlo_departamento
                    departamento.forEach(function(item) {
                        if (item.id_controlo_departamento == selectedDepartment) {
                            totalIndice = item.total_indice;
                            return; // Keluar dari loop setelah ditemukan
                        }
                    });

                    // Update nilai input totalIndice
                    document.getElementById("totalIndice").value = totalIndice;
                }
                </script>
   
@endsection

