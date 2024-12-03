





 @extends('layouts.app') 

 @section('title', 'Lista de Disciplinas') 

@section('content') 
   
          
                    <div class="tab-content mt-4">              
            
                    @include('pages.disciplinas.disciplinas_menu_tab')
                        
                    <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Disciplinas</h3>
                            </div>
                          
                        </div>
                     
                        <div class="table-responsive">
                          <table class="table data-table display table-striped table-bordered table-box-wrap text-nowrap">
                                <thead>
                                    <tr>
                                 
                                        <th>Nome Habilitação</th>
                                        <th>Area Especialidade</th>
                                        <th>Universidade Origem</th>
                                        <th>Asaun</th>
                                       
                                    </tr>
                                </thead>
                               
                            </table>
                        </div>

                    </div>
                </div>
         </div>
              
  
@endsection

