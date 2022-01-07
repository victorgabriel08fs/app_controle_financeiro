@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Preencha com seus dados</div>

                    <div class="card-body">
                        @if (isset($endereco))
                            @component('cadastro.endereco._components.formulario', ['endereco' => $endereco, 'status' =>
                                $status])
                            @endcomponent
                        @elseif(isset($status))
                            @component('cadastro.endereco._components.formulario', ['status' => $status])
                            @endcomponent
                        @else
                            @component('cadastro.endereco._components.formulario')
                            @endcomponent
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
