<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Painel Administrativo') }}</div>

                    <div class="card-body">
                        <div class="cards">

                            <p><a href="{{ route('registro.create') }}">Insira registros</a> para que possamos demonstra-los</p>


                            @if ($saidas_porcento != 0 || $entradas_porcento != 0)
                                <h6 class="grafico-titulo">Saldo mensal</h6>
                                <canvas id="myChart2" class="grafico"></canvas>

                                <script>
                                    const ctx2 = document.getElementById('myChart2').getContext('2d');
                                    const myChart2 = new Chart(ctx2, {
                                        type: 'line',
                                        data: {
                                            labels: [
                                                <?php for ($i = 1; $i <= 12; $i++) {
                                                    echo $i . ',';
                                                } ?>
                                            ],
                                            datasets: [{
                                                label: 'Saldo mensal',

                                                data: [
                                                    <?php for ($i = 0; $i < 12; $i++) {
                                                        echo $saldo_mes[$i] . ',';
                                                    } ?>
                                                ],
                                                fill: false,
                                                borderColor: 'rgb(75, 192, 192)',
                                                tension: 0.1
                                            }]
                                        }

                                    })
                                </script>
                            @else

                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
