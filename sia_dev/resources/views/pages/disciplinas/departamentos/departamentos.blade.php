<div class="container">
    <h4>Departamentos</h4>

    <!-- Button to trigger modal for creating new department -->
    <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-target="#createModaldepartamento"
        id="openModalBtndepartamento">Adicionar</button>

    <!-- Table to list departamentos -->
    <table class="table table-bordered mt-4" id="departamentosTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Faculty</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departamentos as $departamento)
                <tr>
                    <td>{{ $departamento->nome_departamento }}</td>
                    <td>{{ $departamento->faculdade->nome_faculdade }}</td>
                    <td>
                        <!-- Edit Button -->
                        <button class="btn btn-lg btn-info" data-toggle="modal" data-target="#editModal"
                            data-id="{{ $departamento->id_departamento }}"
                            data-nome="{{ $departamento->nome_departamento }}"
                            data-faculdade="{{ $departamento->id_faculdade }}">
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
            @endforeach

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="createModaldepartamento" tabindex="-1" aria-labelledby="createModaldepartamentoLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModaldepartamentoLabel">Adicionar Novo Departamento</h5>
                    <div class="close-btn">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">
                    <form class="new-added-form mb-4" method="POST" action="{{ route('store_departamento') }}"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="id_faculdade">Faculdade *</label>
                                <select class="select2 form-control" name="id_faculdade" id="id_faculdade" readonly>
                                    <option selected disabled value="">Escolha *</option>
                                    {{-- Uncomment and adjust the following code as per your data source --}}
                                    {{-- @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->id_faculdade }}">{{ $departamento->nome_faculdade }}</option>
                                    @endforeach --}}
                                </select>
                            </div>

                            <div class="col-lg-6 col-lg-6 col-12 form-group">
                                <label>Nome Departamento *</label>
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

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Departamento</h5>
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
                    <input type="hidden" name="id_departamento" id="edit_id_departamento">
                    <div class="row mb-3">
                        <div class="col-lg-6 form-group">
                            <label for="edit_id_faculdade">Faculdade *</label>
                            <select class="form-control select2" name="id_faculdade" id="edit_id_faculdade" required>
                                <option selected disabled value="">Escolha *</option>
                                {{-- Populate options as needed --}}
                                {{-- @foreach ($faculdades as $faculdade) --}}
                                {{-- <option value="{{ $faculdade->id }}">{{ $faculdade->nome }}</option> --}}
                                {{-- @endforeach --}}
                            </select>
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="edit_nome_departamento">Nome Departamento *</label>
                            <input type="text" name="nome_departamento" id="edit_nome_departamento"
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
                <p>Tem certeza de que deseja excluir este departamento?</p>
                <form id="deleteForm" method="POST" action="#">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id_departamento" id="delete_id_departamento">
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
</div>

<!-- JavaScript to trigger the modal -->
<script>
    document.getElementById('openModalBtndepartamento').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('createModaldepartamento'));
        modal.show();
    });
</script>
