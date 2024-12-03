@extends('layouts.app')
@section('title', 'Docente Materia')
@section('content')
    @include('pages.students.header_students')

    <div class="tab-content mt-4">
        @include('pages.students.student_menu_tab')

        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Modulo Curriculo</h3>
                    </div>
                </div>

                @if (session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="ui-alart-box">
                        <div class="dismiss-alart">
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                Well done! {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="table-responsive">
                <div class="student-details">
                   
                         <h4>
                       <p><strong>Departamento:</strong> {{ $student->matriculas->first()->programaEstudo->departamento->nome_departamento ?? 'N/A' }}</p>
                       <p><strong>Semestre Atual:</strong> {{ $student->matriculas->first()->semestre->numero_semestre ?? 'N/A' }}</p>
                       </h4> 
                    
                </div>
                    @foreach ($groupedBySemester as $semester => $details)
                        <h4 class="text-primary">Semestre {{ $semester }}</h4>
                        
                        <table class="table display table-striped table-bordered text-nowrap">
                            <thead>
                                <tr>
                                    <th>N.º</th>
                                    <th>ID</th>                                   
                                    <th>Nome da Disciplina</th>
                                    <th>Semestre</th>
                                    <th>Crédito</th>
                                    <th>Total (PRE / TRA / PL/ EM / EF)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $totalCredits = 0; @endphp
                                @foreach ($details as $index => $data)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $data->codigo_materia }}</td>                                        
                                        <td>{{ $data->materia }}</td>
                                        <td> semestre
                                            @switch($data->numero_semestre)
                                                @case(1)
                                                    I
                                                    @break
                                                @case(2)
                                                    II
                                                    @break
                                                @case(3)
                                                    III
                                                    @break
                                                @case(4)
                                                    IV
                                                    @break
                                                @default
                                                    N/A
                                            @endswitch
                                        </td>
                                        <td>{{ $data->credito }}</td>
                                        <td>
                                         
                                        </td>
                                    </tr>
                                    @php $totalCredits += $data->credito; @endphp
                                @endforeach
                                <tr class="bg-light font-weight-bold">
                                    <td colspan="5" class="text-right">Crédito total do Semestre {{ $semester }}</td>
                                    <td colspan="2">{{ $totalCredits }}</td>
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
