@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Nova Conta</div>

                    <div class="card-body">
                        @component('admin.conta._components.formulario',['objeto'=>$objeto])

                        @endcomponent
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
