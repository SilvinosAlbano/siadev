<div class="container-fluid">
    <br>
    <h4>Disciplinas</h4>

    <!-- Button to trigger modal for creating new disciplina -->
    <button class="btn btn-lg btn-primary" data-bs-toggle="modal" id="openModalBtnDisciplina"
        data-bs-target="#createModalDisciplina">
        Adicionar
    </button>


    <!-- Table to list disciplinas -->
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-4" id="disciplinasTable">
        <thead>
            <tr>
                <th>Nome Materia</th>
                <th>Codigo Materia</th>
                <th>Credito</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($materias as $materia)
                <tr>
                    <td>{{ $materia->materia }}</td>
                    <td>{{ $materia->codigo_materia }}</td>
                    <td>{{ $materia->credito }}</td>
                    <td>
                        <!-- Edit button to trigger modal -->
                        <button type="button" class="btn btn-warning" data-id="{{ $materia->id_materia }}"
                            data-name="{{ $materia->materia }}" data-codigo="{{ $materia->codigo_materia }}"
                            data-credito="{{ $materia->credito }}" onclick="openEditModal(this)">
                            Edit
                        </button>

                        <!-- Delete button to trigger delete modal -->
                        <button type="button" class="btn btn-danger" data-id="{{ $materia->id_materia }}"
                            onclick="openDeleteModal(this)">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Create Modal -->
    <div class="modal fade" id="createModalDisciplina" tabindex="-1" aria-labelledby="createModalDisciplinaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalDisciplinaLabel">Adicionar Novo disciplina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('disciplinas.disciplinas.store') }}">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="materia">Nome disciplina *</label>
                                <input type="text" name="materia" id="materia" class="form-control" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="codigo_materia">Código Materia *</label>
                                <input type="text" name="codigo_materia" id="codigo_materia" class="form-control"
                                    required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="credito">Créditos *</label>
                                <input type="number" name="credito" id="credito" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-lg btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Modal -->
    <div class="modal fade" id="editModalDisciplina" tabindex="-1" aria-labelledby="editModalDisciplinaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalDisciplinaLabel">Editar disciplina</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST"
                        action="{{ route('disciplinas.disciplinas.update', 'ID_HERE') }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id_materia" id="edit_id_materia">
                        <div class="row mb-3">
                            <div class="col-lg-6 form-group">
                                <label for="edit_nome_disciplinas">Nome disciplina *</label>
                                <input type="text" name="materia" id="edit_nome_disciplinas" class="form-control"
                                    required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="edit_codigo_materia">Código Materia *</label>
                                <input type="text" name="codigo_materia" id="edit_codigo_materia"
                                    class="form-control" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="edit_credito">Créditos *</label>
                                <input type="number" name="credito" id="edit_credito" class="form-control"
                                    required>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-lg btn-success" form="editForm">Guardar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModalDisciplina" tabindex="-1" aria-labelledby="deleteModalDisciplinaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalDisciplinaLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this disciplina?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-lg btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-lg btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    // Function to open the edit modal and populate it with existing data
    function openEditModal(button) {
        var materiaId = button.getAttribute('data-id');
        var materiaName = button.getAttribute('data-name');
        var codigoMateria = button.getAttribute('data-codigo');
        var credito = button.getAttribute('data-credito');

        // Set values in the modal
        document.getElementById('edit_id_materia').value = materiaId;
        document.getElementById('edit_nome_disciplinas').value = materiaName;
        document.getElementById('edit_codigo_materia').value = codigoMateria;
        document.getElementById('edit_credito').value = credito;

        // Change form action URL to include the selected materia ID
        document.getElementById('editForm').action = '{{ route('disciplinas.disciplinas.update', '') }}/' + materiaId;

        // Open the modal
        var modal = new bootstrap.Modal(document.getElementById('editModalDisciplina'));
        modal.show();
    }

    // Function to open the delete confirmation modal
    function openDeleteModal(button) {
        var materiaId = button.getAttribute('data-id');
        // Set the action URL for deletion
        document.getElementById('deleteForm').action = '{{ route('disciplinas.disciplinas.destroy', '') }}/' +
            materiaId;

        // Open the modal
        var modal = new bootstrap.Modal(document.getElementById('deleteModalDisciplina'));
        modal.show();
    }

    document.getElementById('openModalBtnDisciplina').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('createModalDisciplina'));
        modal.show();
    });
</script>
