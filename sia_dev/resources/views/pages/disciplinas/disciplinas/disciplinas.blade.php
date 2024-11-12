{{-- @extends('layouts.app') --}}

{{-- @section('title', 'Lista de Disciplinas') --}}

{{-- @section('content') --}}
{{-- <div class="breadcrumbs-area">
        <h3>Lista de Disciplinas</h3>
        <ul>
            <li><a href="/disciplinas">Disciplinas</a></li>
        </ul>
    </div> --}}

<div class="card ui-tab-card mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disciplinas as $disciplina)
                <tr>
                    <td>{{ $disciplina->id }}</td>
                    <td>{{ $disciplina->materia }}</td>
                    <td>{{ $disciplina->descricao }}</td>
                    <td><a href="{{ route('disciplinas_index.disciplinas.edit', $disciplina) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
{{-- @endsection --}}
