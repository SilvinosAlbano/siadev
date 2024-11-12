@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4>Editar Disciplina</h4>

            <!-- Display error or success messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Form for editing the existing Disciplina -->
            <form action="{{ route('disciplinas.update', $disciplina->id_materia) }}" method="POST">
                @csrf
                @method('PUT') <!-- Specify this is a PUT request for updating -->

                <div class="form-group">
                    <label for="nome_disciplina">Nome da Disciplina</label>
                    <input type="text" name="nome_disciplina" id="nome_disciplina" class="form-control" value="{{ $disciplina->materia }}" required>
                </div>

                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea name="descricao" id="descricao" class="form-control" rows="4">{{ $disciplina->descricao }}</textarea>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Atualizar Disciplina</button>
                    <a href="{{ route('disciplinas.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
