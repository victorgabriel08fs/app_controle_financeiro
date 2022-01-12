@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Gerenciamento de solicitações
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Solicitante</th>
                                        <th scope="col">Conta</th>
                                        <th scope="col">Solicitação</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($solicitacoes as $solicitacao)
                                        <tr>
                                            <td>{{ $solicitacao->id }}</td>
                                            <td>@php
                                                echo formatCpf($solicitacao->user->cpf);
                                            @endphp</td>
                                            <td>{{ $solicitacao->conta ? 'Corrente' : 'Poupança' }}</td>
                                            <td>{{ $solicitacao->tipo ? 'Criação' : 'Desativação' }}</td>
                                            <td>
                                                <form id="form_{{ $conta->id }}" method="POST"
                                                    action="{{ route('solicitacao.update', ['solicitacao' => $solicitacao]) }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <select
                                                        onchange="document.getElementById('form_{{ $solicitacao->id }}').submit()"
                                                        class="form-select" name="status">
                                                        <option value=0>Pendente</option>
                                                        <option value=1>Resolvido</option>
                                                    </select>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-primary float-right">Voltar</a>
                        <br>
                        <br>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $contas->previousPageUrl() }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $contas->lastPage(); $i++)
                                    <li class="page-item {{ $contas->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link" href="{{ $contas->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $contas->nextPageUrl() }}" aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
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
