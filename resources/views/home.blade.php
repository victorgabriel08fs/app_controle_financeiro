<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>
                    @if ($saidas_porcento != 0 || $entradas_porcento != 0 || isset($ano))
                        <li class="nav-item dropdown ano">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Ano
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('home') }}">Todos</a>
                                @for ($i = 2020; $i <= date('Y'); $i++)
                                    <a class="dropdown-item" href="{{ route('home.ano', ['ano' => $i]) }}">
                                        {{ $i }}
                                    </a>
                                @endfor
                            </div>
                        </li>
                    @endif

                    <div class="card-body">
                        <div class="cards">
                            @if ($saidas_porcento != 0 || $entradas_porcento != 0)
                                <h6 class="grafico-titulo">Relação entradas/saídas</h6>
                                <canvas id="myChart" class="grafico"></canvas>
                                <script>
                                    const ctx = document.getElementById('myChart').getContext('2d');
                                    const myChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: ['Saídas', 'Entradas'],
                                            datasets: [{
                                                label: 'Relação de entradas e saídas',
                                                data: [<?php echo $saidas_porcento . ',' . $entradas_porcento; ?>],
                                                backgroundColor: [
                                                    'rgba(255, 99, 132, 0.7)',
                                                    'rgba(0, 255, 0, 0.7)',

                                                ],
                                                borderColor: [
                                                    '#000',
                                                    '#000',

                                                ],
                                                borderWidth: 1
                                            }]
                                        },

                                    });
                                </script>
                            @else
                                <p><a href="{{ route('registro.create') }}">Insira registros</a> para que possamos
                                    demonstra-los</p>
                            @endif

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
