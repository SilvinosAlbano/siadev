<div class="breadcrumbs-area">
    <h3>Funcionario</h3>
    <ul>
        <li>
            <a href="/funcionarios">Tabela</a>
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
            <div class="item-img border">


            @php
                use Carbon\Carbon;
                $currentDate = Carbon::now();
                $dataFim = Carbon::parse($detail->fim_estatuto); // Mengonversi ke instance Carbon
            @endphp

            @if (is_null($detail->controlo_estado))
                @if ($dataFim->lt($currentDate))  {{-- lt: kurang dari --}}
                    <div class="ribbon bg-warning">
                        <span class="text-white text-center"> &nbsp; Contrato Termina</span>
                    </div>
                @else  {{-- Jika dataFim >= currentDate --}}
                    <div class="ribbon bg-success border">
                        <span class="text-white text-center">&nbsp; Ativo</span>
                    </div>
                @endif
            @elseif ($detail->controlo_estado == 'Nao Ativo')
                <div class="ribbon bg-danger">
                    <span class="text-white text-center"> &nbsp; Nao Ativo</span>
                </div>
            @endif

                <img class="border" src="{{ asset('img/pessoa_neutra.png') }}" width="200"
                    height="250" alt="">

            </div>

            <div class="item-content">
                <div class="header-inline item-header">
                    <h4 class="text-dark-medium font-medium">{{ $detail->nome_funcionario }},{{ $detail->titulu }} - ({{ $detail->sexo }})</h4>

                </div>

                <div class="info-table table-responsive">
                    <table class="table text-nowrap">
                        <tbody>

                            <tr>
                                <td>Funcionario:</td>
                                <td class="font-medium text-dark-medium">{{ $detail->categoria }}</td>
                            </tr>
                            <tr>
                                <td>Tipo Contrato:</td>
                                <td class="font-medium text-dark-medium">{{ $detail->estatuto }}</td>
                            </tr>

                            <tr>
                                <td>Nivel Educacao:</td>
                                <td class="font-medium text-dark-medium">{{ $detail->habilitacao }}</td>
                            </tr>
                            <tr>
                                <td>Contacto:</td>
                                <td class="font-medium text-dark-medium">{{ $detail->email }}-{{ $detail->no_contacto }}</td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
