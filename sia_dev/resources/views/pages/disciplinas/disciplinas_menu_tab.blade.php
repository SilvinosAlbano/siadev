<div class="card-body border mb-4">
    <div class="heading-layout1 mg-b-25">
        <div class="item-title">
            <h3>Sílabo da Materia</h3>
        </div>
    </div>
    <div class="basic-tab">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('disciplinas_index') ? 'active' : '' }}" data-toggle="tab"
                    href="#disciplinas_index" data-url="{{ route('disciplinas_index.index') }}">
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

<script>
    $(document).ready(function() {
        $('.nav-link').click(function(event) {
            event.preventDefault();
            var url = $(this).data('url');
            var target = $(this).attr('href').substring(1);

            if (url) {
                $('#' + target).load(url, function(response, status, xhr) {
                    if (status === "error") {
                        console.log("Error loading content: " + xhr.status + " " + xhr
                            .statusText);
                    } else {
                        $('#' + target).addClass('show active');
                    }
                });
            } else {
                console.log("No URL found for this tab.");
            }
        });


        // Trigger click on the first tab by default
        // $('.nav-link').first().trigger('click');
    });
</script>
