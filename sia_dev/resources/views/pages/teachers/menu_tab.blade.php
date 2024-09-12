<div class="card-body border">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Ficha Funcão Docente</h3>
                </div>
            </div>
            <div class="basic-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('detailho') ? 'active' : '' }}" href="{{ route('detailho', $detail->id_docente) }}">Identificao</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('habilitacao_docente') ? 'active' : '' }}" href="{{ route('habilitacao_docente', $detail->id_docente) }}">Habilitacao do Professor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('horario') ? 'active' : '' }}" href="{{ route('horario', $detail->id_docente) }}">Horario Ensinar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pagamento') ? 'active' : '' }}" href="{{ route('pagamento', $detail->id_docente) }}">Pagamento</a>
                    </li>
                </ul>
            </div>

            <!-- Dynamic Content Section -->
           

            </div>

           
        </div>


        