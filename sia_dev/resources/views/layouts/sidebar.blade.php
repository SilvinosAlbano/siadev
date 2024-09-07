<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="/home"><img src="{{ asset('img/logo1.png') }}" width="50px" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar">
        <div class="sidebar-menu-content">
            <ul class="nav nav-sidebar-menu sidebar-toggle-view">
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>Estudantes</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <!-- Link to all students -->
                            <a href="{{ route('students.index') }}" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Todos os Estudantes</a>
                        </li>
                        <li class="nav-item">
                            <a href="/student_details" class="nav-link"><i class="fas fa-angle-right"></i>Detalhos de
                                Estudante</a>
                        </li>
                        <li class="nav-item">
                            <a href="/student_promotion" class="nav-link"><i class="fas fa-angle-right"></i>Promoção de
                                Estudante</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admission_form_student" class="nav-link"><i
                                    class="fas fa-angle-right"></i>Formulário de Admissão</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-multiple-users-silhouette"></i><span>Docentes</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/docentes" class="nav-link"><i class="fas fa-angle-right"></i>Todos
                                Docentes</a>
                        </li>
                        <li class="nav-item">
                            <a href="/docente-report" class="nav-link"><i class="fas fa-angle-right"></i>Monitoramento Docentes</a>
                        </li>
                        <li class="nav-item">
                            <a href="/teacher_payment" class="nav-link"><i class="fas fa-angle-right"></i>Pagamento de
                                Docentes</a>
                        </li>
                        <li class="nav-item">
                            <a href="/add_teacher" class="nav-link"><i class="fas fa-angle-right"></i>Adicionar Docentes
                                Form</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Classes</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/all_classes" class="nav-link"><i class="fas fa-angle-right"></i>Todas Classes</a>
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
                <li class="nav-item">
                    <a href="/all_subject" class="nav-link"><i
                            class="flaticon-open-book"></i><span>Disciplinas</span></a>
                </li>
                <li class="nav-item">
                    <a href="/student_attendence" class="nav-link"><i
                            class="flaticon-checklist"></i><span>Atendimentos</span></a>
                </li>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i
                            class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Usuários</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="/all_users" class="nav-link"><i class="fas fa-angle-right"></i>Todos Usuários</a>
                        </li>
                        <li class="nav-item">
                            <a href="/users_details" class="nav-link"><i class="fas fa-angle-right"></i>Detalhos de Usuario</a>
                        </li>
                        <li class="nav-item">
                            <a href="/assign_role" class="nav-link"><i class="fas fa-angle-right"></i>Permissão de Acesso</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>

</div>
