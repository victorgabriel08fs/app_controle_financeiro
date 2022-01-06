@if (isset($conta->id))
    <form action="{{ route('conta.update', ['conta' => $conta]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('conta.store') }}" method="POST">
            @csrf
@endif
<input type="hidden" name="user_id" value={{ $objeto->user_id }}>
<div class="mb-3">
    <label class="form-label">Conta</label>
    <input type="text" class="form-control" name="conta" value="{{ $objeto->conta ?? old('conta') }}">
    {{ $errors->has('conta') ? $errors->first('conta') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Dígito</label>
    <input type="text" class="form-control" name="digito" value="{{ $objeto->digito ?? old('digito') }}">
    {{ $errors->has('digito') ? $errors->first('digito') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Tipo</label>
    <select class="form-select" name="tipo">
        <option value=0 {{ isset($objeto->tipo) && $objeto->tipo == 0 ? 'selected' : '' }}>Poupança</option>
        <option value=1 {{ isset($objeto->tipo) && $objeto->tipo == 1 ? 'selected' : '' }}>Corrente</option>
    </select>
</div>
<a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
<button type="submit" class="btn btn-primary">Salvar</button>
</form>
