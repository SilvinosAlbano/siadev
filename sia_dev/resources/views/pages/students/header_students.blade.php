{{-- <div class="card mb-2"> --}}
<div class="card-body">
    <div class="heading-layout1">
        <div class="item-title">
            {{-- <h3>Sobre</h3> --}}
        </div>

    </div>
    <div class="single-info-details mb-1">
        <div class="item-img">
            @if ($student->student_image)
                <img src="{{ asset('storage/asset/posts/' . $student->student_image) }}" alt="Student Image"
                    class="border rounded-circle" width="150">
            @else
                <img src="{{ asset('img/pessoa_neutra.png') }}" alt="Student Image" class="border rounded-circle"
                    width="150">
            @endif
        </div>
        <div class="item-content">
            <div class="header-inline item-header">
                <h4 class="text-dark-medium font-medium">{{ $student->complete_name }}</h4>
            </div>
            <div class="info-table table-responsive">
                <ul>
                    <li>
                        <span>Funcionario:</span>
                        <span class="font-medium text-dark-medium">{{ $student->complete_name }}</span>
                    </li>
                    <li>
                        <span>Sexo:</span>
                        <span class="font-medium text-dark-medium">{{ $student->gender }}</span>
                    </li>
                    <li>
                        <span>Número do Registo de Estudante:</span>
                        <span class="font-medium text-dark-medium">{{ $student->nre }}</span>
                    </li>
                    <li>
                        <span>Departamento e Semestre:</span>
                        <span class="font-medium text-dark-medium">
                            {{-- {{ optional($modelDepartamentos)->nome_departamento }}, {{ optional($semestres)->periodo }} --}}
                        </span>

                    </li>
                </ul>
            </div>
        </div>
    </div>
    <hr>
    {{-- </div> --}}
    {{-- </div> --}}
