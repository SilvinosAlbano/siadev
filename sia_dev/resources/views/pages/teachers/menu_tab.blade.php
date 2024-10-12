<div class="card-body border mb-4">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Ficha Detalhe  ao Funcionario</h3>
                </div>
            </div>
            <div class="basic-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('detailho') ? 'active' : '' }}" href="{{ route('detailho', $detail->id_funcionario) }}">Identifição</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('habilitacao_funcionario') ? 'active' : '' }}" href="{{ route('habilitacao_funcionario', $detail->id_funcionario) }}">Habilitação</a>
                    </li>
                    @if (request()->routeIs('inserir_habilitacao'))
                    <li class="nav-item">
                        <a class="nav-link active {{ request()->routeIs('inserir_habilitacao') ? 'active' : '' }}" href="{{ route('inserir_habilitacao', $detail->id_funcionario) }}">Inserir Habilitação</a>
                    </li>
                    @endif
                    @if (request()->routeIs('alterar_habilitacao.index'))
                    <li class="nav-item">
                        <a class="nav-link active {{ request()->routeIs('alterar_habilitacao.index') ? 'active' : '' }}" href="{{ route('alterar_habilitacao.index', $detail->id_funcionario) }}">Alterar Habilitação</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('departamento') ? 'active' : '' }}" href="{{ route('departamento', $detail->id_funcionario) }}">Departamento</a>
                    </li>
                    @if (request()->routeIs('inserir_departamento'))
                    <li class="nav-item">
                        <a class="nav-link active {{ request()->routeIs('inserir_departamento') ? 'active' : '' }}" href="{{ route('inserir_departamento', $detail->id_funcionario) }}">Inserir Departamento</a>
                    </li>
                    @endif
                    @if (request()->routeIs('alterar_departamento.index'))
                    <li class="nav-item">
                        <a class="nav-link active {{ request()->routeIs('alterar_departamento.index') ? 'active' : '' }}" href="{{ route('alterar_departamento.index', $detail->id_funcionario) }}">Alterar Departamento</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('materia_docente') ? 'active' : '' }}" href="{{ route('materia_docente', $detail->id_funcionario) }}">Materia</a>
                    </li>
                    @if (request()->routeIs('inserir_materia_docente'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('inserir_materia_docente') ? 'active' : '' }}" href="{{ route('inserir_materia_docente', $detail->id_funcionario) }}">Inserir Materia</a>
                    </li>
                    @endif

                    @if (request()->routeIs('alterar_docentemateria'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('alterar_docentemateria') ? 'active' : '' }}" href="{{ route('alterar_docentemateria', $detail->id_funcionario) }}">Alterar Materia</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('horario') ? 'active' : '' }}" href="{{ route('horario', $detail->id_funcionario) }}">Horario Ensinar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('estatuto') ? 'active' : '' }}" href="{{ route('estatuto', $detail->id_funcionario) }}">Estatuto</a>
                    </li>
                    @if (request()->routeIs('inserir_estatuto'))
                    <li class="nav-item">
                        <a class="nav-link active {{ request()->routeIs('inserir_estatuto') ? 'active' : '' }}" href="{{ route('inserir_estatuto', $detail->id_funcionario) }}">Inserir Estatuto</a>
                    </li>
                    @endif
                    @if (request()->routeIs('alterar_estatuto.index'))
                    <li class="nav-item">
                        <a class="nav-link active {{ request()->routeIs('alterar_estatuto.index') ? 'active' : '' }}" href="{{ route('alterar_estatuto.index', $detail->id_funcionario) }}">Alterar Estatuto</a>
                    </li>
                    @endif

              

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('posicao_funcionario') ? 'active' : '' }}" href="{{ route('posicao_funcionario', $detail->id_funcionario) }}">Posição</a>
                    </li>

                </ul>
            </div>

            <!-- Dynamic Content Section -->
           

            </div>

           
        </div>


        