<div class="card-body border mb-4">
            <div class="heading-layout1 mg-b-25">
                <div class="item-title">
                    <h3>Ficha Detalhe  ao Funcionario</h3>
                </div>
            </div>
            <div class="basic-tab">
                <ul class="nav nav-tabs" role="tablist">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs ('disciplinas_index')? 'active' : '' }}" href="{{ route('disciplinas_index') }}">Disciplinas</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('disciplinas.departamentos') ? 'active' : '' }}" href="{{ route('disciplinas.departamentos') }}">Departamento</a>
                  
                    </li> <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('disciplinas.programas') ? 'active' : '' }}" href="{{ route('disciplinas.programas') }}">Programa Estudo</a>
                    </li>
                   

                </ul>
            </div>

            <!-- Dynamic Content Section -->
           

            </div>

           
        </div>