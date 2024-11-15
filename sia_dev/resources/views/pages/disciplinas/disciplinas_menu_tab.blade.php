<div class="card-body border mb-4">
    <div class="heading-layout1 mg-b-25">
        <div class="item-title">
            <h3>Sílabo da Materia</h3>
        </div>
    </div>
    <div class="basic-tab">
        <ul class="nav nav-tabs" role="tablist" id="myTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('disciplina_disciplinas') ? 'active' : '' }}" data-toggle="tab"
                    href="#disciplinas" data-url="{{ route('disciplinas.disciplinas') }}">
                    Disciplinas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('disciplina_departamentos') ? 'active' : '' }}" data-toggle="tab"
                    href="#departamentos" data-url="{{ route('disciplinas.departamentos') }}">
                    Departamentos
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('disciplina_programas') ? 'active' : '' }}" data-toggle="tab"
                    href="#programas" data-url="{{ route('disciplinas.programas') }}">
                    Programas de Estudos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('disciplina_semestres') ? 'active' : '' }}" data-toggle="tab"
                    href="#semestres" data-url="{{ route('disciplinas.semestres') }}">
                    Semestres
                </a>
            </li>
        </ul>
    </div>

    <!-- Dynamic Content Section -->
    <div class="tab-content" id="tab-content">
        <div class="tab-pane fade {{ request()->is('disciplinas') ? 'show active' : '' }}" id="disciplinas">
            <!-- Content for Disciplinas will be loaded here -->
        </div>
        <div class="tab-pane fade {{ request()->is('disciplina_departamentos') ? 'show active' : '' }}"
            id="departamentos">
            <!-- Content for Departamentos will be loaded here -->
        </div>
        <div class="tab-pane fade {{ request()->is('disciplina_programas') ? 'show active' : '' }}" id="programas">
            <!-- Content for Programas will be loaded here -->
        </div>
        <div class="tab-pane fade {{ request()->is('disciplina_semestres') ? 'show active' : '' }}" id="semestres">
            <!-- Content for Semestres will be loaded here -->
        </div>
    </div>
</div>

{{-- <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="disciplinas" role="tabpanel" aria-labelledby="disciplinas-tab">
        <!-- Content for Disciplinas -->
        <p>This is the content for Disciplinas tab.</p>
    </div>
    <div class="tab-pane fade" id="departamentos" role="tabpanel" aria-labelledby="departamentos-tab">
        <!-- Content for Departamentos -->
        <p>This is the content for Departamentos tab.</p>
    </div>
</div> --}}

<script>
    $(document).ready(function() {
        $('.nav-link').click(function(event) {
            event.preventDefault(); // Prevent default link behavior

            var targetPaneId = $(this).attr('href').substring(1); // Get target pane ID
            var url = $(this).data(
                'url'); // Assuming each link has a data-url attribute with URL to load

            if (url) {
                // Load content into the corresponding pane
                $('#' + targetPaneId).load(url, function(response, status, xhr) {
                    if (status === "error") {
                        console.error("Failed to load content: " + xhr.status + " " + xhr
                            .statusText);
                    }
                });
            }

            // Manage active classes to toggle the visibility of panes
            $('.nav-link').removeClass('active');
            $(this).addClass('active');
            $('.tab-pane').removeClass('show active');
            $('#' + targetPaneId).addClass('show active');
        });
    });
</script>
