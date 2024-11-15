<div class="container">
    <h4>Semestre</h4>

    <!-- Button to trigger modal for creating new department -->
    <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-target="#createModalSemestre"
        id="openModalBtnSemestre">Adicionar</button>

    <!-- Table to list disciplinass -->
    <table class="table table-bordered mt-4" id="disciplinassTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Faculty</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($disciplinass as $disciplinas)
                <tr>
                    <td>{{ $disciplinas->nome_disciplinas }}</td>
                    <td>{{ $disciplinas->faculdade->nome_faculdade }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-lg btn-info" data-toggle="modal" data-target="#editModal"
                            data-id="{{ $disciplinas->id_disciplinas }}"
                            data-nome="{{ $disciplinas->nome_disciplinas }}"
                            data-faculdade="{{ $disciplinas->id_faculdade }}">
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-lg btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach --}}

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="createModalSemestre" tabindex="-1" aria-labelledby="createModalSemestreLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalSemestreLabel">Adicionar Novo Semestre</h5>
                    <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="new-added-form mb-4" method="POST" action="#" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="id_faculdade">Faculdade *</label>
                                <select class="select2 form-control" name="id_faculdade" id="id_faculdade" readonly>
                                    <option selected disabled value="">Escolha *</option>
                                    {{-- Uncomment and adjust the following code as per your data source --}}
                                    {{-- @foreach ($disciplinass as $disciplinas)
                                        <option value="{{ $disciplinas->id_faculdade }}">{{ $disciplinas->nome_faculdade }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="col-lg-6 col-lg-6 col-12 form-group">
                                <label>Nome disciplinas *</label>
                                <input type="text" placeholder="" class="form-control">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="data_inicio">Data Início *</label>
                                <input type="date" name="data_inicio" id="data_inicio" class="form-control" required>
                            </div>

                            <div class="col-lg-6 form-group">
                                <label for="data_fim">Data Fim</label>
                                <input type="date" name="data_fim" id="data_fim" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-lg btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>


</div>

{{-- <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar disciplinas</h5>
                <div class="close-btn">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
            </div>
            <div class="modal-body">
                <form id="editForm" method="POST" action="#">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id_disciplinas" id="edit_id_disciplinas">
                    <div class="row mb-3">
                        <div class="col-lg-6 form-group">
                            <label for="edit_id_faculdade">Faculdade *</label>
                            <select class="form-control select2" name="id_faculdade" id="edit_id_faculdade" required>
                                <option selected disabled value="">Escolha *</option>
                             
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="edit_nome_disciplinas">Nome disciplinas *</label>
                            <input type="text" name="nome_disciplinas" id="edit_nome_disciplinas"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 form-group">
                            <label for="edit_data_inicio">Data Início *</label>
                            <input type="date" name="data_inicio" id="edit_data_inicio" class="form-control"
                                required>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="edit_data_fim">Data Fim</label>
                            <input type="date" name="data_fim" id="edit_data_fim" class="form-control">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-lg btn-success">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmação de Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Tem certeza de que deseja excluir este disciplinas?</p>
                <form id="deleteForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id_disciplinas" id="delete_id_disciplinas">
                </form>
            </div>
            <div class="modal-footer">
                <div class="modal-footer">
                    <button type="button" class="btn btn-lg btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-lg btn-success">Apagar</button>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- JavaScript to trigger the modal -->
<script>
    document.getElementById('openModalBtnSemestre').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('createModalSemestre'));
        modal.show();
    });
</script>
