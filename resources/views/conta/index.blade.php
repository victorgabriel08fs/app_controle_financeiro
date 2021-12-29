@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Olá, {{ strtok(auth()->user()->name, ' ') }}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Conta</th>
                                    <th>Tipo</th>
                                    <th>Saldo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contas as $conta)
                                    <tr>
                                        @if ($conta->saldo >= 0)
                                            <td class="valor positivo">+
                                            @else
                                            <td class="valor negativo">-
                                        @endif
                                        {{ number_format($conta->saldo, 2) }}</td>
                                        <td>{{ $conta->conta . '-' . $conta->digito }}</td>
                                        <td>{{ $conta->tipo ? 'Corrente' : 'Poupança' }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
