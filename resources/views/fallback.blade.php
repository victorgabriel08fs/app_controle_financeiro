@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <p>A rota acessada não existe. <a href="{{ route('index') }}">Clique aqui</a> para ser redirecionado.</p>
                </div>
            </div>
        </div>
    </div>
@endsection