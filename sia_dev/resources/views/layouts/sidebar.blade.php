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
                    <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Estudantes</span></a>
                    <ul class="nav sub-group-menu">
                        {{-- @if ($user->canAccess('read', 'students')) --}}
                        <li class="nav-item">
                            <a href="{{ route('students.index') }}" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Todos os Estudantes</a>
                        </li>
                        {{-- @endif --}}

                       

                        {{-- @if ($user->canAccess('read', 'students')) --}}
                        <li class="nav-item">
                            <a href="{{route('lista_pagamento_estudante')}}" class="nav-link"><i class="fas fa-angle-right"></i>Lista pagamento</a>
                        </li>
                        {{-- @endif --}}

                        {{-- @if ($user->canAccess('create', 'admission_form_student')) --}}
                        <li class="nav-item">
                            <a href="/admission_form_student" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Formulário de Admissão</a>
                        </li>
                        {{-- @endif --}}
                    </ul>
                </li>
                {{-- @endif --}}
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-multiple-users-silhouette"></i><span>Funcionario</span></a>
                    <ul class="nav sub-group-menu">
                         <li class="nav-item">
                            <a href="/adiciona_funcionario" class="nav-link"><i class="fas fa-angle-right"></i>Registo
                               Docentes</a>
                        </li>
                         <li class="nav-item">
                            <a href="/escolha_dados_docentes" class="nav-link"><i class="fas fa-angle-right"></i>Docentes</a>
                        </li>
                        <li class="nav-item">
                            <a href="/funcionarios" class="nav-link"><i class="fas fa-angle-right"></i>Dados 
                               Gerais</a>
                        </li>
                        <li class="nav-item">
                            <a href="/docente-report" class="nav-link"><i class="fas fa-angle-right"></i>Monitoramento
                                </a>
                        </li>
                        
                    </ul>
                </li>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Classes</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/all_classes" class="nav-link"><i class="fas fa-angle-right"></i>Todas
                                Classes</a>
                        </li>
                        <li class="nav-item">
                            <a href="/class_routine" class="nav-link"><i class="fas fa-angle-right"></i>Roteiro de
                                Classe</a>
                        </li>
                        <li class="nav-item">
                            <a href="/add_classes" class="nav-link"><i class="fas fa-angle-right"></i>Adicionar
                                Classe</a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Curiculo Disciplinas</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/disciplinas" class="nav-link"><i class="fas fa-angle-right"></i>silabos da Materia</a>
                        </li>
                       
                        <li class="nav-item">
                            <a href="/materia_semestre" class="nav-link"><i class="fas fa-angle-right"></i>Materia da Semestre</a>
                        </li>
                       
                    </ul>
                </li>
               
                <li class="nav-item">
                    <a href="/student_attendence" class="nav-link"><i
                            class="flaticon-checklist"></i><span>Atendimentos</span></a>
                </li>

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
                               Configurar de  Datas</a>
                        </li>
                      

                    </ul>
                </li>


                {{-- @if ($user->hasAnyAccess(['read', 'create', 'update', 'delete', 'extract', 'admin'], 'students')) --}} <!-- Comment lai tama sei uza atu dev -->
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Usuários</span></a>
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
