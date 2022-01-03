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
                        <div class="table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Conta</th>
                                        <th>Tipo</th>
                                        <th>Saldo</th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contas as $conta)
                                        <tr>
                                            <td>{{ $conta->conta . '-' . $conta->digito }}</td>
                                            <td>{{ $conta->tipo ? 'Corrente' : 'Poupança' }}</td>
                                            @if ($conta->saldo > 0)
                                                <td class="valor positivo">
                                                @elseif($conta->saldo < 0) <td class="valor negativo">
                                                    @else
                                                <td>
                                            @endif
                                            R$ {{ number_format($conta->saldo, 2) }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalDeposito_{{ $conta->id }}">
                                                    <i class="fas fa-piggy-bank"></i>
                                                </button>

                                                <!-- Modal -->
                                                @component('conta._components.modals.deposito', ['conta' => $conta])

                                                @endcomponent

                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalSaque_{{ $conta->id }}">
                                                    <i class="fas fa-money-bill-alt"></i>
                                                </button>

                                                <!-- Modal -->
                                                @component('conta._components.modals.saque', ['conta' => $conta])

                                                @endcomponent
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#modalTransfer_{{ $conta->id }}">
                                                    <i class="fas fa-share"></i>
                                                </button>

                                                <!-- Modal -->
                                                @component('conta._components.modals.transfer', ['conta' => $conta])

                                                @endcomponent


                                            </td>


                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
@endsection
