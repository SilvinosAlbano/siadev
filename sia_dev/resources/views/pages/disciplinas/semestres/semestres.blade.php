<div class="container">
    <h4>Semestres</h4>

    <!-- Button to trigger modal for creating a new Semestre -->
    <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-target="#createModalSemestre"
        id="openModalBtnSemestre">Adicionar</button>

    <!-- Table to list semestres -->
    <table class="table table-bordered mt-4" id="semestreTable">
        <thead>
            <tr>
                <th>Número</th>
                <th>Ano Acadêmico</th>
                <th>Programa de Estudo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            {{-- Example rows: dynamically populate --}}
            {{-- @foreach ($semestres as $semestre) --}}
            <!-- Example -->
            {{-- @endforeach --}}
        </tbody>
    </table>

    <!-- Modal for creating new Semestre -->
    <div class="modal fade" id="createModalSemestre" tabindex="-1" aria-labelledby="createModalSemestreLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalSemestreLabel">Adicionar Novo Semestre</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="#">
                        {{-- <form method="POST" action="{{ route('semestres.store') }}"> --}}
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <label for="numero_semestre">Número Semestre *</label>
                                <input type="number" name="numero_semestre" id="numero_semestre" class="form-control"
                                    min="1" required>
                            </div>
                            <div class="col-lg-6 form-group">
                                <label for="ano_academico">Ano Acadêmico *</label>
                                <input type="text" name="ano_academico" id="ano_academico" class="form-control"
                                    required placeholder="Ex: 2023/2024">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12 form-group">
                                <label for="id_programa_estudo">Programa de Estudo *</label>
                                <select name="id_programa_estudo" id="id_programa_estudo" class="form-control" required>
                                    <option value="" disabled selected>Escolha o Programa</option>
                                    {{-- Populate dynamically --}}
                                    {{-- @foreach ($programas as $programa) --}}
                                    {{-- <option value="{{ $programa->id_programa_estudo }}">
                                        {{ $programa->nome_programa }}
                                    </option> --}}
                                    {{-- @endforeach --}}
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

<!-- JavaScript to trigger the modal -->
<script>
    document.getElementById('openModalBtnSemestre').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('createModalSemestre'));
        modal.show();
    });
</script>
