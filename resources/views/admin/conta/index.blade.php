@extends('layouts.app')

@section('content')
    @component('_components.functions.formatCpf')

    @endcomponent

    @component('admin.conta._components.modals.cpf')

    @endcomponent
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Gerenciamento de contas
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalConta">
                            Nova Conta
                        </button>
                        @if (isset($message))
                            <br>
                            <div id='texto' class="message">
                                @if ($message == 0)
                                    <h3 class="negativo">O usuário já possui os dois tipos de conta!</h1>
                                    @elseif($message==1)
                                        <h3 class="negativo">O usuário já possui uma conta deste tipo!</h1>
                                        @else
                                            <h3 class="positivo">Conta criada com sucesso!</h1>
                                @endif
                            </div>
                        @endif
                        <script>
                            function init() {
                                var div = document.getElementById("texto");
                                var disp = div.style.display;
                                setTimeout(() => {
                                    div.style.display = "none";
                                }, 5000);
                            }
                            init();
                        </script>
                        <div class="table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">CPF</th>
                                        <th scope="col">Conta</th>
                                        <th>Tipo</th>
                                        <th>Saldo</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($contas as $conta)

                                        <tr>
                                            <td>@php
                                                echo formatCpf($conta->user->cpf);
                                            @endphp</td>
                                            <td>{{ $conta->conta . '-' . $conta->digito }}</td>
                                            <td>{{ $conta->tipo ? 'Corrente' : 'Poupança' }}</td>
                                            @if ($conta->saldo > 0)
                                                <td class="valor positivo">
                                                @elseif($conta->saldo < 0) <td class="valor negativo">
                                                    @else
                                                <td>
                                            @endif
                                            R$ {{ number_format($conta->saldo, 2) }}</td>
                                            <td>{{ $conta->deleted_at ? 'Inativa' : 'Ativa' }}</td>
                                            <td>
                                                @if (!$conta->trashed())
                                                    <form id="form_{{ $conta->id }}" method="POST"
                                                        action="{{ route('conta.destroy', ['conta' => $conta]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <a href="#"
                                                            onclick="document.getElementById('form_{{ $conta->id }}').submit()"><i
                                                                class="fas fa-trash-alt"></i></a>
                                                    </form>
                                                @else
                                                    <form id="form_{{ $conta->id }}" method="POST"
                                                        action="{{ route('conta.revive', ['conta_id' => $conta->id]) }}">
                                                        @csrf
                                                        <a href="#"
                                                            onclick="document.getElementById('form_{{ $conta->id }}').submit()"><i
                                                                class="fas fa-trash-restore"></i>
                                                    </form>
                                                @endif
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
