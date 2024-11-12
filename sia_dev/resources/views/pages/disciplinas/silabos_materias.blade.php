@extends('layouts.app')

@section('title', 'Currículo de Disciplinas')

@section('content')
    <div class="breadcrumbs-area">
        <h3>Currículo de Disciplinas</h3>
        <ul>
            <li><a href="/disciplinas">Disciplinas</a></li>
            <li>Detalho de Unidade Curricular Detalho</li>
        </ul>
    </div>
    <div class="card ui-tab-card mt-4">
        @include('pages.disciplinas.disciplinas_menu_tab')
    </div>

@endsection
