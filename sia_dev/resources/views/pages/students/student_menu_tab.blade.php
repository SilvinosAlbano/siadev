{{-- <div class="card-body border mb-4"> --}}
{{-- <div class="heading-layout1 mg-b-25">
        <div class="item-title">
            <h3>Ficha Detalhe de Estudante</h3>
        </div>
    </div> --}}
<div class="basic-tab">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" href="#">Identifição</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Matérias</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">Horário</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">Notas</a>
        </li>
        {{-- @if (request()->routeIs('alterar_estatuto.index'))
                    <li class="nav-item">
                        <a class="nav-link active {{ request()->routeIs('alterar_estatuto.index') ? 'active' : '' }}" href="#">Alterar Estatuto</a>
                    </li>
                    @endif --}}

    </ul>
</div>
</div>
