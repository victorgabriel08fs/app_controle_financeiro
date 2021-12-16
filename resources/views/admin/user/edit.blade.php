@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Aluno</div>

                    <div class="card-body">
                        @component('admin.user._components.formulario', ['user' => $user])

                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
