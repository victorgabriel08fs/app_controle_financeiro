@if (isset($registro->id))
    <form action="{{ route('registro.update', ['registro' => $registro]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('registro.store') }}" method="POST">
            @csrf
@endif
<input type="hidden" name="user_id" value={{ auth()->user()->id }}>
<div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" class="form-control" name="nome" value="{{ $registro->nome ?? old('nome') }}">
    {{ $errors->has('nome') ? $errors->first('nome') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Valor</label>
    <input type="number" step="0.01" class="form-control" name="valor"
        value="{{ $registro->valor ?? old('valor') }}">
    {{ $errors->has('valor') ? $errors->first('valor') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Descrição</label>
    <input type="text" class="form-control" name="descricao" value="{{ $registro->descricao ?? old('descricao') }}">
    {{ $errors->has('descricao') ? $errors->first('descricao') : '' }}
</div>
<select class="form-select" name="tipo">
    <option>Entrada ou saída?</option>
    <option value=1 {{ isset($registro->id) && $registro->tipo ? 'selected' : '' }}>
        Entrada</option>
    <option value=0 {{ isset($registro->id) && !$registro->tipo ? 'selected' : '' }}>
        Saída</option>
</select>
{{ $errors->has('unidade_id') ? $errors->first('unidade_id') : '' }}
<br>
<div class="mb-3">
    <label class="form-label">Data</label>
    <input type="date" max="{{ date('Y-m-d') }}" class="form-control" name="data"
        value="{{ $registro->data ?? old('data') }}">
    {{ $errors->has('data') ? $errors->first('data') : '' }}
</div>
<a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
<button type="submit" class="btn btn-primary">Salvar</button>
</form>
