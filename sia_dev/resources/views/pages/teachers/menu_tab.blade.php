
<div class="card ui-tab-card mt-8">
    <div class="card-body border">
        <div class="heading-layout1 mg-b-25">
            <div class="item-title">
                <h3>Ficha Funcão Docente</h3>
            </div>
          
        </div>

    </div>
</div>
    <div class="basic-tab mb-6">
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-selected="true">Identificao</a>
            </li>
            <li class="nav-item">
            <a class="nav-link"  href="{{ route('habilitacao_docente', $detail->id_docente) }}"  aria-selected="false">Habiltacao do Professor</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-selected="false">Horario Ensinar</a>
            </li>

            <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tab3" role="tab" aria-selected="false">Pagamento</a>
            </li>
        </ul>
    
</div>