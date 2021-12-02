<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div>
                            <input id="entradas" type="hidden" value={{ $entradas_porcento }}>
                            <input id="saidas" type="hidden" value={{ $saidas_porcento }}>
                            <canvas id="myChart" style="max-height: 200px;max-width:200px"></canvas>
                            @if ($saidas_porcento != 0 || $entradas_porcento != 0)
                                <script>
                                    const ctx = document.getElementById('myChart').getContext('2d');
                                    let saidas = document.getElementById('saidas').value;
                                    let entradas = document.getElementById('entradas').value;
                                    const myChart = new Chart(ctx, {
                                        type: 'pie',
                                        data: {
                                            labels: ['Saídas', 'Entradas'],
                                            datasets: [{
                                                label: '# of Votes',
                                                data: [saidas, entradas],
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
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection
