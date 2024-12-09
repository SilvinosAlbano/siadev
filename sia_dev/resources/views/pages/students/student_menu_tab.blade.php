<div class="card-body border mb-4">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Ficha Detalhe  Estudante</h3>
                </div>
            </div>
            <div class="basic-tab">
                <ul class="nav nav-tabs" role="tablist">
                @if (request()->routeIs('students.edit'))
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.edit') ? 'active text-danger' : '' }}" href="{{ route('students.edit', $student->id_student) }}">Editar Estudante</a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.detail') ? 'active text-danger' : '' }}" href="{{ route('students.detail', $student->id_student) }}">Dados Pessoais</a>
                    </li>
                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('semestre_estudante') ? 'active text-danger' : '' }}" href="{{ route('semestre_estudante', $student->id_student) }}">Semestre</a>
                    </li>

                    @if (request()->routeIs('inserir_semestre'))
                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('inserir_semestre') ? 'active text-danger' : '' }}" href="{{ route('inserir_semestre', $student->id_student) }}">Inserir semestre</a>
                    </li>
                   @endif
                   
                   @if (request()->routeIs('alterar_semestre_estudante'))
                    <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('alterar_semestre_estudante') ? 'active text-danger' : '' }}" href="{{ route('alterar_semestre_estudante', $student->id_student) }}">Alterar Licensa</a>

                    </li>
                   @endif

                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('programa_estudo') ? 'active text-danger' : '' }}" href="{{ route('programa_estudo', $student->id_student) }}">Programa Estudo</a>
                    </li>

                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('materia_estudante') ? 'active text-danger' : '' }}" href="{{ route('materia_estudante', $student->id_student) }}">Curiculo</a>
                    </li>

                 
                  

                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('pagamento_estudante') ? 'active text-danger' : '' }}" href="{{ route('pagamento_estudante', $student->id_student) }}">Pagamento</a>
                    </li>
                    @if (request()->routeIs('inserir_pagamento'))
                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('inserir_pagamento') ? 'active text-danger' : '' }}" href="{{ route('inserir_pagamento', $student->id_student) }}">Inserir Pagamento</a>
                    </li>
                   @endif

                   <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('estudante_licenca') ? 'active text-danger' : '' }}" href="{{ route('estudante_licenca', $student->id_student) }}">Licenca</a>
                    </li>

                    @if (request()->routeIs('Inserir_estudante_licenca'))
                    <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('Inserir_estudante_licenca') ? 'active text-danger' : '' }}" href="{{ route('Inserir_estudante_licenca', $student->id_student) }}">Inserir Licensa</a>

                    </li>
                   @endif

                   @if (request()->routeIs('alterar_licensa_estudante'))
                    <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('alterar_licensa_estudante') ? 'active text-danger' : '' }}" href="{{ route('alterar_licensa_estudante', $student->id_student) }}">Alterar Licensa</a>

                    </li>
                   @endif

                   
                </ul>
            </div>

            <!-- Dynamic Content Section -->
           

            </div>

           
        </div>


        