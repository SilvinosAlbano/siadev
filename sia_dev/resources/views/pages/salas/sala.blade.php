@extends('layouts.app')
@section('title', 'Dados Docentes')
@section('content')


<!-- Breadcrumbs Area Start Here -->
<div class="breadcrumbs-area">
    <h3>Todos Sala de Aulas</h3>
    <ul>
        <li>
            <a href="index.html">Home</a>
        </li>
        <li>Salas</li>
    </ul>
</div>
<!-- Breadcrumbs Area End Here -->

<!-- All Subjects Area Start Here -->
<div class="row">
    <div class="col-4-xxxl col-12">
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Formulario Submissão Sala de Aulas</h3>
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
                <form method="POST" action="{{ isset($mat) ? route('salas.update', $mat->id_sala) : route('salas.store') }}">
                    @csrf
                    @if(isset($mat))
                        @method('PUT')
                    @endif

                    <div class="row">
                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Nome de Salas*</label>
                            <input type="text" name="nome_sala" value="{{ isset($mat) ? $mat->nome_sala : old('nome_sala') }}" class="form-control border" required>
                        </div>

                       


                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                            <label>Observacão</label>
                            <textarea class="textarea form-control border" name="observacao" id="form-message" cols="10" rows="5">{{ isset($mat) ? $mat->observacao : old('observacao') }}</textarea>
                        </div>

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
                        <h3>Todos Salas</h3>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table display data-table text-nowrap">
                        <thead>
                            <tr>
                                <th>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input checkAll">
                                        <label class="form-check-label">No</label>
                                    </div>
                                </th>
                                <th>Nome de Salas</th>
                               
                                <th>Acao</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sala as $mat)
                            <tr>
                                <td>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input">
                                        <label class="form-check-label">{{  $loop->iteration }}</label>
                                    </div>
                                </td>
                                <td>{{ $mat->nome_sala }}</td>
                               
                                <td>
                                    <div class="dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                            <span class="flaticon-more-button-of-three-dots"></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <!-- Delete Button -->
                                            <form action="{{ route('salas.destroy', $mat->id_sala) }}" method="POST" onsubmit="return confirm('Tem certeza de apagar este dados?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="dropdown-item"><i class="fas fa-times text-orange-red"></i>Delete</button>
                                            </form>

                                            <!-- Edit Button -->
                                            <a class="dropdown-item" href="{{ route('salas.edit', $mat->id_sala) }}"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
