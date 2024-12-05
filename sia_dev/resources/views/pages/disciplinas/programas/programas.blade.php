<div class="container">
    <h4>Programas de Estudo</h4>

    <!-- Button to trigger modal for creating a new programa -->
    <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-target="#createModalprograma"
        id="openModalBtnprograma">Adicionar</button>

    <!-- Table to list programas -->
    <table class="table table-bordered mt-4" id="programasTable">
        <thead>
            <tr>
                <th>Nome Programa</th>
                <th>Departamento</th>
                <th>Duração (Anos)</th>
                <th>Tipo Programa</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <!-- Example row; populate dynamically from the database -->
            {{-- @foreach ($programas as $programa) --}}
            <!-- Populate dynamically -->
        </tbody>
    </table>

    <!-- Modal for creating new programa -->
    <div class="modal fade" id="createModalprograma" tabindex="-1" aria-labelledby="createModalprogramaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalprogramaLabel">Adicionar Novo Programa de Estudo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="id_departamento">Departamento *</label>
                                <select class="form-control" name="id_departamento" id="id_departamento" required>
                                    <option value="" disabled selected>Escolha o Departamento</option>
                                    {{-- Dynamically populate departments --}}
                                    {{-- @foreach ($departamentos as $departamento) --}}
                                    {{-- <option value="{{ $departamento->id_departamento }}">
                                        {{ $departamento->nome_departamento }}
                                    </option> --}}
                                    {{-- @endforeach --}}
                                </select>
                            </div>

                            <div class="col-lg-6 form-group">
                                <label for="nome_programa">Nome Programa *</label>
                                <input type="text" name="nome_programa" id="nome_programa" class="form-control"
                                    required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="duracao_anos">Duração (Anos) *</label>
                                <input type="number" name="duracao_anos" id="duracao_anos" class="form-control"
                                    min="1" required>
                            </div>

                            <div class="col-lg-6 form-group">
                                <label for="tipo_programa">Tipo de Programa *</label>
                                <select name="tipo_programa" id="tipo_programa" class="form-control" required>
                                    <option value="" disabled selected>Escolha o Tipo</option>
                                    <option value="Graduação">Graduação</option>
                                    <option value="Pós-Graduação">Pós-Graduação</option>
                                    <option value="Mestrado">Mestrado</option>
                                    <option value="Doutorado">Doutorado</option>
                                </select>
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
</div>

<!-- JavaScript to trigger modal -->
<script>
    document.getElementById('openModalBtnprograma').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('createModalprograma'));
        modal.show();
    });
</script>
