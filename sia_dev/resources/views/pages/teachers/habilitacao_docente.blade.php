
@extends('layouts.app')

@section('content') 
    <!-- Identificao Content -->
     @include('pages.teachers.header_teacher')


     <div class="card">
             <div class="card-header">
                <div class="card-title">
                    Habilitacao
                </div>
                <div class="card-body">
                    <div class="tab-content mt-4">              
            
                         @include('pages.teachers.menu_tab')
        
                        <div class="table-responsive">
                            <table class="table display data-table text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nome </th>
                                        <th>Area </th>
                                        <th>Nivel </th>
                                        <th>Data Inicio </th>
                                        <th>Data Fim </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>IOB</td>
                                        <td>Animal</td>
                                        <td>D3</td>
                                        <td>20/01/2010</td>
                                        <td>20/06/2013</td>
                                    </tr>
                                    <tr>
                                        <td>Semarang</td>
                                        <td>Docter Gigi</td>
                                        <td>S1</td>
                                        <td>21/01/2015</td>
                                        <td>20/06/2019</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                   </div>
              </div>
             </div>
            </div>
  
@endsection

