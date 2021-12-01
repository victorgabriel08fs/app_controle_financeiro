@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Novo registro</div>

                    <div class="card-body">
                        @component('registro._components.formulario')

                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
