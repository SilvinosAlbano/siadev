@extends('layouts.app')

@section('title', 'Deatail')

@section('content')
    <!-- Breadcrumbs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Funcionarios</h3>
        <ul>
            <li><a href="/docentes">Tabela</a></li>
            <li>Estudante Detalho</li>
        </ul>
    </div>

    <!-- Header Section with Image and Info -->
    <div class="card height-auto">
        <div class="card-body border">
            <div class="heading-layout1">
                <div class="item-title">
                    {{-- Header Title --}}
                </div>
            </div>
          
        </div>
    </div>
    <div class="card ui-tab-card mt-4">
         @include('pages.students.student_menu_tab')

            @if (request('tab') == 'identificacao' || is_null(request('tab')))
                @include('pages.students.identificacao_student') 
                <!-- Identificao Content -->
        
            @endif
        
      </div>

    <!-- Tab Navigation (Static) -->
@endsection
