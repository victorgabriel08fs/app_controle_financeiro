@extends('layouts.app')

@section('content')
    @component('admin.taxa._components.modals.create_taxa')

    @endcomponent
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                Gerenciamento de taxas
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#modalTaxa">
                            Nova Taxa
                        </button>

                        <div class="table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Taxa</th>
                                        <th scope="col">Criador</th>
                                        <th scope="col">Data/Hora</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($taxas as $taxa)

                                        <tr>
                                            <td>{{ bcmul($taxa->taxa, 100) }}%</td>
                                            <td>{{ strtok($taxa->user->name," ") }}</td>
                                            <td>{{ date('d/m/Y', strtotime($taxa->created_at)) }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
@endsection
