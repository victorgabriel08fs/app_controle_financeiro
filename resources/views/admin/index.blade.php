<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Painel Administrativo') }}</div>

                    <div class="card-body">
                        <div class="cards col">

                            {{-- <p><a href="{{ route('registro.create') }}">Insira registros</a> para que possamos
                                demonstra-los</p> --}}

                            <div class="col left-labels">
                                <h4>Total em movimentações: <br>R$
                                    <strong>{{ number_format($objeto->movimentacoes, 2) }}</strong></h4>
                                <h4>Total de movimentações: <br><strong>{{ $objeto->qnt_movimentacoes }}</strong></h4>
                            </div>

                            <h6 class="grafico-titulo">Movimentações por mês</h6>
                            <canvas id="myChart2" class="grafico"></canvas>

                            <script>
                                const ctx2 = document.getElementById('myChart2').getContext('2d');
                                const myChart2 = new Chart(ctx2, {
                                    type: 'line',
                                    data: {
                                        labels: [
                                            'Jan', 'Fev', 'Mar', 'Abril', 'Maio', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'
                                        ],
                                        datasets: [{
                                            label: 'Movimentações por mês (R$)',

                                            data: [
                                                <?php for ($i = 0; $i < 12; $i++) {
                                                    echo $objeto->meses[$i] . ',';
                                                } ?>
                                            ],
                                            fill: false,
                                            borderColor: 'rgb(75, 192, 192)',
                                            tension: 0.1
                                        }],
                                    },
                                })
                            </script>
                        </div>
                        <div class="col">a</div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
