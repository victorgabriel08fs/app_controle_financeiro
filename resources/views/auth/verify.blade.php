@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifique seu email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Um link para a verificação foi enviado para o seu email.') }}
                        </div>
                    @endif

                    {{ __('Antes de continuarmos, verifique seu email.') }}
                    {{ __('Caso ainda não tenha recebido o link') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('clique aqui para solicitar um novo.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
