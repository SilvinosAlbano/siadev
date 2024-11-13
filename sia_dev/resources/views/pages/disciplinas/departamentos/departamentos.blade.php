<div class="container">
    <h4>Departamentos</h4>

    <!-- Button to trigger modal for creating new department -->
    <button class="btn btn-primary" data-bs-toggle="modal" data-target="#createModal" id="openModalBtn">Add
        Departamento</button>

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
                        <button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal"
                            data-id="{{ $departamento->id_departamento }}"
                            data-nome="{{ $departamento->nome_departamento }}"
                            data-faculdade="{{ $departamento->id_faculdade }}">
                            Edit
                        </button>

                        <!-- Delete Button -->
                        <form action="#" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <!-- Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>This is the modal body content.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- JavaScript to trigger the modal -->
<script>
    document.getElementById('openModalBtn').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('createModal'));
        modal.show();
    });
</script>
