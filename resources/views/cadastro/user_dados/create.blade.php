@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Preencha com seus dados</div>

                    <div class="card-body">
                        @component('cadastro.user_dados._components.formulario')

                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
