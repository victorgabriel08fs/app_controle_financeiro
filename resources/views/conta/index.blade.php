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
                        <div class="status">
                            @isset($status)
                                @if ($status)
                                    <script>
                                        alert('Olá')
                                    </script>
                                @endif
                            @endisset
                        </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Conta</th>
                                    <th>Tipo</th>
                                    <th>Saldo</th>
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
                                        {{ number_format($conta->saldo, 2) }}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalDeposito">
                                                <i class="fas fa-piggy-bank"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalDeposito" tabindex="-1" role="dialog"
                                                aria-labelledby="modalDeposito" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('conta.deposito', ['conta' => $conta]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalDeposito">Depósito</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="valor">Valor</label>
                                                                <input type="number" name="valor" id="depositoId">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancelar</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Confirmar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                                data-target="#modalSaque">
                                                <i class="fas fa-money-bill-alt"></i>
                                            </button>

                                            <!-- Modal -->
                                            <div class="modal fade" id="modalSaque" tabindex="-1" role="dialog"
                                                aria-labelledby="modalSaque" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <form action="{{ route('conta.saque', ['conta' => $conta]) }}"
                                                            method="POST">
                                                            @csrf
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="modalSaque">Saque</h5>
                                                            </div>
                                                            <div class="modal-body">
                                                                <label for="valor">Valor</label>
                                                                <input type="number" name="valor" id="saqueId">
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancelar</button>
                                                                <button type="submit"
                                                                    class="btn btn-primary">Confirmar</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

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
