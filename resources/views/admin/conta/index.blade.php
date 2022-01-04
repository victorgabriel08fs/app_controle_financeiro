@extends('layouts.app')

@section('content')
    @component('_components.functions.formatCpf')

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
