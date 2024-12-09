@php
    $user = Auth::user();
@endphp
<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="/home"><img src="{{ asset('img/logo1.png') }}" width="50px" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar">
        <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                {{-- @if ($user->hasAnyAccess(['read', 'create', 'update', 'delete', 'extract', 'admin'], 'students')) --}}
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Modul Estudantes</span></a>
                    <ul class="nav sub-group-menu">
                      <li class="nav-item">
                            <a href="{{ route('escolha_estudante') }}" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Modul Estudante</a>
                        </li>
                        {{-- @if ($user->canAccess('create', 'admission_form_student')) --}}
                        <li class="nav-item">
                            <a href="/students/create" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Registo Estudante</a>
                        </li>
                        {{-- @endif --}}

                        {{-- @if ($user->canAccess('read', 'students')) --}}
                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Lista Gerais</a>
                        </li>
                        {{-- @endif --}}

                        <li class="nav-item">
                            <a href="{{ route('estudantenaoativo') }}" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Estudante Nao Ativo</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('view_monitoramento_finalista') }}" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Estudante Finalista</a>
                        </li>



                      

                       
                    </ul>
                </li>
                {{-- @endif --}}
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-multiple-users-silhouette"></i><span>Modul Docente</span></a>
                    <ul class="nav sub-group-menu">
                       <li class="nav-item">
                            <a href="/escolha_dados_docentes" class="nav-link"><i class="fas fa-angle-right"></i>
                             Modul   Docentes</a>
                        </li>
                        <li class="nav-item">
                            <a href="/adiciona_funcionario" class="nav-link"><i class="fas fa-angle-right"></i>Registo
                                Docentes</a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="/funcionarios" class="nav-link"><i class="fas fa-angle-right"></i>Lista
                                Gerais Docentes</a>
                        </li>
                        <li class="nav-item">
                            <a href="/docente-report" class="nav-link"><i class="fas fa-angle-right"></i>Monitoramento
                            </a>
                        </li>

                    </ul>
                </li>

                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Modul Materia
                            </span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="{{route('disciplinas_index')}}" class="nav-link"><i class="fas fa-angle-right"></i>Silabos da
                                Materia</a>
                        </li>

                        <li class="nav-item">
                            <a href="/materia_semestre" class="nav-link"><i class="fas fa-angle-right"></i>Materia da
                                Semestre</a>
                        </li>

                    </ul>
                </li>


                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Modul Horario</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/all_classes" class="nav-link"><i class="fas fa-angle-right"></i>Horario
                                </a>
                        </li>
                       
                    </ul>
                </li>

                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Modul Lista Presenca</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/all_classes" class="nav-link"><i class="fas fa-angle-right"></i>Lista Prezensa
                                </a>
                        </li>
                       
                    </ul>
                </li>

                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Modul Pagamento</span></a>
                    <ul class="nav sub-group-menu">
                    {{-- @if ($user->canAccess('read', 'students')) --}}
                        <li class="nav-item">
                            <a href="{{ route('lista_pagamento_estudante') }}" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Lista pagamento</a>
                        </li>
                        {{-- @endif --}}

                        <li class="nav-item">
                            <a href="{{ route('pagamento_indice') }}" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Indice Pagamento</a>
                        </li>
                       
                    </ul>
                </li>

                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Modul KRS</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/all_classes" class="nav-link"><i class="fas fa-angle-right"></i>KRS
                                </a>
                        </li>
                       
                    </ul>
                </li>

               
<!-- 
                <li class="nav-item">
                    <a href="/student_attendence" class="nav-link"><i
                            class="flaticon-checklist"></i><span>Atendimentos</span></a>
                </li> -->

                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-multiple-users-silhouette"></i><span>Parametro</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/salas" class="nav-link"><i class="fas fa-angle-right"></i>
                                Sala Aulas</a>
                        </li>
                        <li class="nav-item">
                            <a href="/datas" class="nav-link"><i class="fas fa-angle-right"></i>
                                Configurar de Datas</a>
                        </li>


                    </ul>
                </li>


                {{-- @if ($user->hasAnyAccess(['read', 'create', 'update', 'delete', 'extract', 'admin'], 'students')) --}} <!-- Comment lai tama sei uza atu dev -->
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Modul Usuários</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/all_users" class="nav-link"><i class="fas fa-angle-right"></i>Todos
                                Usuários</a>
                        </li>
                        <li class="nav-item">
                            <a href="#/users_teachers" class="nav-link"><i class="fas fa-angle-right"></i>Usuários
                                Funcionário</a>
                        </li>
                        <li class="nav-item">
                            <a href="#/users_students" class="nav-link"><i class="fas fa-angle-right"></i>Usuários
                                Estudante</a>
                        </li>
                    </ul>
                </li>
                {{-- @endif --}}
            </ul>
        </div>
    </div>

</div>
