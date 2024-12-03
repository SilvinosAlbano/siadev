@extends('layouts.app')
@section('title', 'Docente Materia')

@section('content')
    <!-- Header Section -->
    @include('pages.teachers.header_teacher')

    <!-- Main Content -->
    <div class="tab-content mt-4">
        @include('pages.teachers.menu_tab')

        <!-- Card Container -->
        <div class="card height-auto">
            <div class="card-body">
                <div class="heading-layout1">
                    <div class="item-title">
                        <h3>Lista Estudante no Curso {{ $load_id->materia }} em Semestre {{ $load_id->numero_semestre }} ano academico {{ $load_id->ano_academico }} </h3>
                    </div>

                    <div>
                    <!-- Export to PDF Button -->
                   <a href="{{ route('export.pdf', $load_id->id_docente_materia) }}" class="btn btn-danger">
                    <i class="fas fa-file-pdf"></i> Exportar para PDF
                      </a>
                </div>
                </div>

                <!-- Feedback Messages -->
                @if (session('error'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <!-- Student Table -->
                <div class="table-responsive">
                    <table class="table display data-table table-striped table-bordered table-box-wrap text-nowrap">
                        <thead>
                            <tr>
                                <th>NRE</th>
                                <th>Nome</th>
                                <th>Departamento</th>
                                <th>Semestre</th>
                                <th>Disciplina</th>
                                <th>Valor</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($detailho_docente_semestre_estudante as $data)
                                <tr>
                                    <td>{{ $data->nre }}</td>
                                    <td>{{ $data->complete_name }}</td>
                                    <td>{{ $data->departamento_estudante }}</td>
                                    <td>{{ $data->numero_semestre }}</td>
                                    <td>{{ $data->codigo_materia }}-{{ $data->materia }}</td>
                                    <td>{{ $data->valor }}</td>
                                    <td>
                                        @if (is_null($data->valor))
                                            <!-- Inserir Valor Button -->
                                            <button 
                                                class="btn btn-sm btn-success" 
                                                data-toggle="modal" 
                                                data-target="#inserirValorModal" 
                                                data-id-student="{{ $data->id_student }}" 
                                                data-id-materia-semestre="{{ $data->id_materia_semestre }}"
                                                data-name="{{ $data->complete_name }}"
                                                data-nre="{{ $data->nre }}"
                                                data-valor=""
                                            >
                                                <i class="fas fa-plus"></i> Inserir Valor
                                            </button>
                                        @else
                                            <!-- Update Valor Button -->
                                            <button 
                                                class="btn btn-sm btn-primary" 
                                                data-toggle="modal" 
                                                data-target="#inserirValorModal" 
                                                data-id-student="{{ $data->id_student }}" 
                                                data-id-materia-semestre="{{ $data->id_materia_semestre }}"
                                                data-name="{{ $data->complete_name }}"
                                                data-nre="{{ $data->nre }}"
                                                data-valor="{{ $data->valor }}"
                                            >
                                                <i class="fas fa-edit"></i> Atualizar Valor
                                            </button>
                                        @endif
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center">
                    {{ $detailho_docente_semestre_estudante->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div class="modal fade" id="inserirValorModal" tabindex="-1" aria-labelledby="inserirValorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inserirValorModalLabel">Inserir Valor Estudante</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close">&times;</button>
                </div>
                <form id="inserirValorForm" method="POST" action="{{ route('inserir_valor_materia') }}">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id_student" id="modal-id-student">
                        <input type="hidden" name="id_materia_semestre" id="modal-id-materia-semestre">
                        <div class="mb-3">
                            <label for="modal-student-name" class="form-label">Nome do Estudante</label>
                            <input type="text" class="form-control" id="modal-student-name" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="modal-student-nre" class="form-label">NRE</label>
                            <input type="text" class="form-control" id="modal-student-nre" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="valor" class="form-label">Valor</label>
                            <input type="number" class="form-control" name="valor" id="valor" placeholder="Digite o valor" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar Valor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- update -->
    <div class="modal fade" id="inserirValorModal" tabindex="-1" aria-labelledby="inserirValorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inserirValorModalLabel">Inserir ou Atualizar Valor</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="inserirValorForm" method="POST" action="{{ route('inserir_valor_materia') }}">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id_student" id="modal-id-student">
                    <input type="hidden" name="id_materia_semestre" id="modal-id-materia-semestre">
                    <div class="mb-3">
                        <label for="modal-student-name" class="form-label">Nome do Estudante</label>
                        <input type="text" class="form-control" id="modal-student-name" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="modal-student-nre" class="form-label">NRE</label>
                        <input type="text" class="form-control" id="modal-student-nre" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="number" class="form-control" name="valor" id="valor" placeholder="Enter value" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar Valor</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Script for Modal -->
    <script>
    $(document).ready(function () {
        $('#inserirValorModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget); // Button that triggered the modal
            var idStudent = button.data('id-student');
            var idMateriaSemestre = button.data('id-materia-semestre');
            var name = button.data('name');
            var nre = button.data('nre');
            var valor = button.data('valor');

            // Populate the modal fields
            var modal = $(this);
            modal.find('#modal-id-student').val(idStudent);
            modal.find('#modal-id-materia-semestre').val(idMateriaSemestre);
            modal.find('#modal-student-name').val(name);
            modal.find('#modal-student-nre').val(nre);
            modal.find('#valor').val(valor || ''); // If valor is null, leave the field empty

            // Change form action based on whether it's insert or update
            if (valor) {
                $('#inserirValorForm').attr('action', '{{ route('update_valor_materia') }}');
            } else {
                $('#inserirValorForm').attr('action', '{{ route('inserir_valor_materia') }}');
            }

        });
    });
</script>

@endsection
