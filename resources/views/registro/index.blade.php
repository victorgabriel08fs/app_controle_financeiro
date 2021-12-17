@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Regitros
                            </div>
                            <div class="col-6" style="display:flex;align-items: center;justify-content:right">
                                <div class="float-right">
                                    <a href="{{ route('registro.create') }}" class="btn btn-primary mb-3">Novo
                                        registro</a>
                                    <li class="nav-item dropdown ano">
                                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            Ano
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                            <a class="dropdown-item" href="{{ route('registro.index') }}">Todos</a>
                                            @for ($i = 2020; $i <= date('Y'); $i++)
                                                <a class="dropdown-item"
                                                    href="{{ route('registro.ano', ['ano' => $i]) }}">
                                                    {{ $i }}
                                                </a>
                                            @endfor
                                        </div>
                                    </li>
                                    @if ($objeto->saldo > 0)
                                        <p class="valor positivo">Saldo: {{ $objeto->saldo }}</p>
                                    @elseif($objeto->saldo==0)
                                        <p>Saldo: R$ {{ $objeto->saldo }}</p>
                                    @else
                                        <p class="valor negativo">Saldo: R$ {{ $objeto->saldo }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col"><a class="link"
                                            href="{{ route('registro.sort', ['ordenacao' => 'valor']) }}">Valor
                                            (R$)</a>
                                    </th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col"><a class="link"
                                            href="{{ route('registro.sort', ['ordenacao' => 'data']) }}">Data</a>
                                    </th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($objeto->registros as $registro)
                                    <tr>
                                        @if ($registro->tipo)
                                            <td class="valor positivo">+
                                            @else
                                            <td class="valor negativo">-
                                        @endif
                                        {{ number_format($registro->valor, 2) }}</td>

                                        <td>{{ $registro->descricao }}</td>
                                        <td>{{ date('d/m/Y', strtotime($registro->data)) }}</td>
                                        <td><a href="{{ route('registro.edit', ['registro' => $registro]) }}"><i
                                                    class="fas fa-pen"></i></a>
                                        </td>
                                        <td>
                                            <form id="form_{{ $registro->id }}" method="POST"
                                                action="{{ route('registro.destroy', ['registro' => $registro]) }}">
                                                @csrf
                                                @method('DELETE')
                                                <a href="#"
                                                    onclick="document.getElementById('form_{{ $registro->id }}').submit()"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>

                        <a href="{{ url()->previous() }}" class="btn btn-primary float-right">Voltar</a>
                        <br>
                        <br>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination">
                                <li class="page-item">
                                    <a class="page-link" href="{{ $objeto->registros->previousPageUrl() }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $objeto->registros->lastPage(); $i++)
                                    <li class="page-item {{ $objeto->registros->currentPage() == $i ? 'active' : '' }}">
                                        <a class="page-link"
                                            href="{{ $objeto->registros->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $objeto->registros->nextPageUrl() }}"
                                        aria-label="Next">
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
@endsection
