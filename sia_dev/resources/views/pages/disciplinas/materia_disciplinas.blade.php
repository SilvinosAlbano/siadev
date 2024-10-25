@extends('layouts.app')
@section('title', 'Dados Docentes')
@section('content')
      

    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Todos Disciplinas</h3>
        <ul>
            <li>
                <a href="index.html">Home</a>
            </li>
            <li>Disciplinas</li>
        </ul>
    </div>
    <!-- Breadcrumbs Area End Here -->
    <div class="row">
        <div class="col-12-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Formulario Submissão Materia Disciplinas</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- All Subjects Area Start Here -->
    <div class="row">
        <div class="col-4-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Formulario Submissão Materia Disciplinas</h3>
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
                        action="{{ isset($mat) ? route('materia.update', $mat->id_materia) : route('materia.store') }}">
                        @csrf
                        @if (isset($mat))
                            @method('PUT')
                        @endif

                        <div class="row">
                            <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                <label>Nome Materia*</label>
                                <input type="text" name="materia"
                                    value="{{ isset($mat) ? $mat->materia : old('materia') }}" class="form-control"
                                    required>
                            </div>

                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Codigo Materia *</label>
                            <input type="text" name="codigo_materia" value="{{ isset($mat) ? $mat->codigo_materia : old('codigo_materia') }}" class="form-control" required>
                        </div>
                       

                        <!-- <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Credito *</label>
                            <input type="text" name="credito" value="{{ isset($mat) ? $mat->credito : old('credito') }}" class="form-control" required>
                        </div> -->

                            <div class="col-12 form-group mg-t-8">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">
                                    {{ isset($mat) ? 'Update' : 'Save' }}
                                </button>
                                <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!-- Table Displaying All Subjects -->
        <div class="col-8-xxxl col-12">
            <div class="card height-auto">
                <div class="card-body">
                    <div class="heading-layout1">
                        <div class="item-title">
                            <h3>Todos Materias</h3>
                        </div>
                        <a class="btn-fill-md text-light bg-dodger-blue" href="/adiciona_funcionario"> Inserir Novo <i
                                class="fas fa-plus text-orange-peel"></i></a>
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
                                <!-- <th>Credito</th> -->
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
       $('#laravel_datatable').DataTable({
           processing: true,
           serverSide: true,
           ajax: "{{ route('get.materia') }}",
           columns: [
            //    {data: 'id_materia', name: 'id_materia'},
               {data: 'codigo_materia', name: 'codigo_materia'},
               {data: 'materia', name: 'materia'},
            //    {data: 'credito', name: 'credito'},
               {data: 'action', name: 'action', orderable: false, searchable: false},
           ]
       });
     });
   </script>
@endsection
