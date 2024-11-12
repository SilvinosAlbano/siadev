<div class="tab-content">
    <div class="tab-pane {{ request()->is('disciplinas_index') ? 'active' : '' }}" id="disciplinas_index">
        <!-- This will load the content of the disciplinas page -->
        @include('pages.disciplinas.disciplinas')
    </div>
</div>
