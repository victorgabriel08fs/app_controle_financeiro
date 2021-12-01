@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edição de registro</div>

                    <div class="card-body">
                        @component('registro._components.formulario', ['registro' => $registro])

                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
