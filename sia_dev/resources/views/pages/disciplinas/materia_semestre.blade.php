@extends('layouts.app')
@section('title', 'Dados Docentes')
@section('content')
      

    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Todos Materias Semestre</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Materia de Semestre</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->
    <div class="row">
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Formulario Submissão Materia da Semestre</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All Subjects Area Start Here -->
    <div class="row">
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <!-- <h3>Formulario Submissão Materia cada Semestre</h3> -->
                        </div>

                    </div>

                    <!-- Error and Success Messages -->
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

                    <!-- Form for Adding/Editing a Subject -->
                    <form method="POST"
                        action="{{ isset($mat) ? route('materiasemestre.update', $mat->id_materia) : route('materiasemestre.store') }}">
                        @csrf
                        @if (isset($mat))
                            @method('PUT')
                        @endif

                     <div class="row">


                    @foreach($materia as $row)                                 
                        <div class="col-3-xxxl col-lg-6 col-12 form-group">
                            <div class="form-check">
                                <input type="checkbox" name="materia_ids[]" value="{{$row->id_materia}}" class="form-check-input">
                                <label class="form-check-label"> {{$row->materia}}</label>
                            </div>
                            <div class="col-5-xxxl col-lg-6 col-12 form-group">
                                <label>Credito *</label>
                                <input type="text" name="credito[{{$row->id_materia}}]" value="{{ old('credito') }}" class="form-control">
                            </div>
                        </div>
                    @endforeach


                     </div>
                       
                     <div class="row">
                         <div class="col-xl-6 col-lg-6 col-12 form-group">                            
                            <label>Departamento *</label>
                            <select class="select2" name="id_departamento">
                                <option selected disabled value="">Escolha *</option>
                                @foreach ($departamento as $data)
                                    <option value="{{ $data->id_departamento }}">{{ $data->nome_departamento }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-12 form-group">                            
                            <label>Semestre *</label>
                            <select class="select2" name="id_semestre">
                                <option selected disabled value="">Escolha *</option>
                                @foreach ($semestre as $data)
                                    <option value="{{ $data->id_semestre }}">{{ $data->numero_semestre }}</option>
                                @endforeach
                            </select>
                        </div>

                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                                    {{ isset($mat) ? 'Update' : 'Gravar' }}
                                </button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancelar</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Table Displaying All Subjects -->
       
    </div>
    <div class="row">
    <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Todos Materias da semestre</h3>
                        </div>
                        <div class="form-group">
                            <label for="semesterFilter">Filter by Semester</label>
                            <select id="semesterFilter" class="form-control">
                                <option value="">Escolha todas</option>
                                @foreach($semestre as $semester)
                                    <option value="{{ $semester->numero_semestre }}">{{ $semester->numero_semestre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <p class="text-primary">Total Credito (SKS): <span class="text-danger" id="totalCredito">0</span></p>

                       
                    </div>

                <div class="table-responsive">
                    <table class="table display text-nowrap" id="laravel_datatable">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">Codigo Materia</label>
                                    </div>
                                </th>
                                <th>Nome Materia</th>
                                <th>Semestre</th>
                                <th>Credito</th>
                                <th>Departamento</th>
                                <th>Acao</th>
                            </tr>
                        </thead>
                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
   $(document).ready(function () {
    let table = $('#laravel_datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('get.materia_semestre') }}",
            data: function (d) {
                d.numero_semestre = $('#semesterFilter').val(); // Send semester filter
            }
        },
        columns: [
            {data: 'codigo_materia', name: 'codigo_materia'},
            {data: 'materia', name: 'materia'},
            {data: 'numero_semestre', name: 'numero_semestre'},
            {data: 'credito', name: 'credito'},
            {data: 'nome_departamento', name: 'nome_departamento'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ],
        drawCallback: function(settings) {
            // Update the totalCredito display based on the server's response
            $('#totalCredito').text(settings.json.totalCredito || 0);
        }
    });

    // Reload the table when semester filter changes
    $('#semesterFilter').change(function () {
        table.ajax.reload();
    });
});


   </script>
@endsection
