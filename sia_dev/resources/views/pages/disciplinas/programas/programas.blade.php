<div class="container">
    <h4>Programas de Estudo</h4>

    <!-- Button to trigger modal for creating new department -->
    <button class="btn btn-lg btn-primary" data-bs-toggle="modal" data-target="#createModalprograma"
        id="openModalBtnprograma">Adicionar</button>

    <!-- Table to list programas -->
    <table class="table table-bordered mt-4" id="programasTable">
        <thead>
            <tr>
                <th>Name</th>
                <th>Faculty</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="createModalprograma" tabindex="-1" aria-labelledby="createModalprogramaLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalprogramaLabel">Adicionar Novo programa</h5>
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
                                </select>
                            </div>

                            <div class="col-lg-6 col-lg-6 col-12 form-group">
                                <label>Nome programa *</label>
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



<!-- JavaScript to trigger the modal -->
<script>
    document.getElementById('openModalBtnprograma').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('createModalprograma'));
        modal.show();
    });
</script>
