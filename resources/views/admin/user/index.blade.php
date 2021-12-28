@extends('layouts.app')

@section('content')
    @php
    function formatCpf($value)
    {
        $cpf = preg_replace('/\D/', '', $value);

        return preg_replace('/(\d{3})(\d{3})(\d{3})(\d{2})/', "\$1.\$2.\$3-\$4", $cpf);
    }
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Regitros
                            </div>

                        </div>
                    </div>
                    <div class="card-body">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Permissão</th>
                                    <th scope="col">Status</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($objeto->users as $user)
                                    <tr>

                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>@php
                                            echo formatCpf($user->cpf);
                                        @endphp</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->is_admin ? 'Administrador' : 'Básico' }}</td>
                                        <td>{{ $user->deleted_at ? 'Desativado' : 'Ativo' }}</td>
                                        <td><a href="{{ route('user.edit', ['user' => $user]) }}"><i
                                                    class="fas fa-pen"></i></a>
                                        </td>
                                        <td>
                                            @if (!$user->deleted_at)
                                                <form id="form_{{ $user->id }}" method="POST"
                                                    action="{{ route('user.destroy', ['user' => $user]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#"
                                                        onclick="document.getElementById('form_{{ $user->id }}').submit()"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </form>
                                            @else
                                                <form id="form_{{ $user->id }}" method="POST"
                                                    action="{{ route('user.destroy', ['user' => $user]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a href="#"
                                                        onclick="document.getElementById('form_{{ $user->id }}').submit()"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </form>

                                            @endif
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
                                    <a class="page-link" href="{{ $objeto->users->previousPageUrl() }}"
                                        aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $objeto->users->lastPage(); $i++)
                                    <li class="page-item {{ $objeto->users->currentPage() == $i ? 'active' : '' }}"><a
                                            class="page-link"
                                            href="{{ $objeto->users->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item">
                                    <a class="page-link" href="{{ $objeto->users->nextPageUrl() }}"
                                        aria-label="Próximo">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">Próximo</span>
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
