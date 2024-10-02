<div class="card-body border mb-4">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Ficha Detalhe  ao Funcionario</h3>
                </div>
            </div>
            <div class="basic-tab">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('students.edit') ? 'active' : '' }}" href="{{ route('students.edit', $student->id_student) }}">Identifição</a>
                    </li>

                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('programa_estudo') ? 'active' : '' }}" href="{{ route('programa_estudo', $student->id_student) }}">Programa Estudo</a>
                    </li>

                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('materia_estudante') ? 'active' : '' }}" href="{{ route('materia_estudante', $student->id_student) }}">Materia</a>
                    </li>

                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('departamento_estudante') ? 'active' : '' }}" href="{{ route('departamento_estudante', $student->id_student) }}">Departamento</a>
                    </li>

                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('matricula_estudante') ? 'active' : '' }}" href="{{ route('matricula_estudante', $student->id_student) }}">Matricula</a>

                    </li>

                    <li class="nav-item">
                         <a class="nav-link {{ request()->routeIs('pagamento_estudante') ? 'active' : '' }}" href="{{ route('pagamento_estudante', $student->id_student) }}">Pagamento</a>
                    </li>
                   
                </ul>
            </div>

            <!-- Dynamic Content Section -->
           

            </div>

           
        </div>


        