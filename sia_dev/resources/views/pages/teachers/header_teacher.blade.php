<div class="breadcrumbs-area">
    <h3>Funcionario</h3>
    <ul>
        <li>
            <a href="/docentes">Tabela</a>
        </li>
        <li>Funcionario Detalho</li>
    </ul>
</div>
<div class="card height-auto">
    <div class="card-body border">
        <div class="heading-layout1">
            <div class="item-title">
                {{-- <h3>Sobre</h3> --}}
            </div>
           
        </div>
        <div class="single-info-details">
            <div class="item-img">
               

                @if (is_null($detail->controlo_estado))
                        <div class="ribbon  bg-primary">
                                <span class="text-white text-center">
                                Ativo
                            </span>
                        </div>
                        @elseif ($detail->controlo_estado == 'deleted')
                        <div class="ribbon  bg-danger">
                            <span class="text-white text-center">
                            Nao Ativo
                        </span>
                            </div>
                        @endif
                <img class="border" src="{{asset('img/pessoa_neutra.png')}}" width="200" height="250" alt="docent">
               
            </div>
          
            <div class="item-content">
                <div class="header-inline item-header">
                    <h4 class="text-dark-medium font-medium">{{$detail->nome_funcionario}}</h4>
                   
                </div>
               
                <div class="info-table table-responsive">
                    <table class="table text-nowrap">
                        <tbody>
                           
                            <tr>
                                <td>Funcionario:</td>
                                <td class="font-medium text-dark-medium">{{$detail->categoria}}</td>
                            </tr>
                           
                            <tr>
                                <td>Numero Contacto:</td>
                                <td class="font-medium text-dark-medium">{{$detail->no_contacto}}</td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td class="font-medium text-dark-medium">{{$detail->email}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>