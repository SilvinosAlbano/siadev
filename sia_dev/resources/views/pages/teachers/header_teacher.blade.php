<div class="breadcrumbs-area">
    <h3>Docentes</h3>
    <ul>
        <li>
            <a href="/docentes">Tabela</a>
        </li>
        <li>Docente Detalho</li>
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
                <img src="{{asset('img/figure/student_2.jpg')}}" width="150" alt="docent">
                {{-- <div class="header-inline item-header">
                    <h4 class="text-dark-medium font-medium text-center">{{$detail->nome_docente}}</h4>
                   
                </div> --}}
            </div>
            <div class="item-content">
                <div class="header-inline item-header">
                    <h4 class="text-dark-medium font-medium">{{$detail->nome_docente}}</h4>
                   
                </div>
               
                <div class="info-table table-responsive">
                    <table class="table text-nowrap">
                        <tbody>
                           
                            <tr>
                                <td>Sexo:</td>
                                <td class="font-medium text-dark-medium">{{$detail->sexo}}</td>
                            </tr>
                           
                            <tr>
                                <td>Nivel Educacão:</td>
                                <td class="font-medium text-dark-medium">{{$detail->nivel_educacao}}</td>
                            </tr>
                            <tr>
                                <td>Estatuto (P/IP/C):</td>
                                <td class="font-medium text-dark-medium">{{$detail->categoria_estatuto}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>