@if (isset($endereco->id))
    <form action="{{ route('endereco.update', ['endereco' => $endereco]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('endereco.store') }}" method="POST">
            @csrf
@endif
<input type="hidden" name="user_dados_id" value={{ auth()->user()->user_dados->id }}>
<div class="mb-3">
    <label class="form-label">CEP</label>
    <input type="text" class="form-control" name="cep" value="{{ $endereco->cep ?? old('cep') }}">
    {{ $errors->has('cep') ? $errors->first('cep') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Rua</label>
    <input type="text" class="form-control" name="rua" value="{{ $endereco->rua ?? old('rua') }}">
    {{ $errors->has('rua') ? $errors->first('rua') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Número</label>
    <input type="text" class="form-control" name="numero" value="{{ $endereco->numero ?? old('numero') }}">
    {{ $errors->has('numero') ? $errors->first('numero') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Complemento</label>
    <input type="text" class="form-control" name="complemento"
        value="{{ $endereco->complemento ?? old('complemento') }}">
    {{ $errors->has('complemento') ? $errors->first('complemento') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Bairro</label>
    <input type="text" class="form-control" name="bairro" value="{{ $endereco->bairro ?? old('bairro') }}">
    {{ $errors->has('bairro') ? $errors->first('bairro') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Cidade</label>
    <input type="text" class="form-control" name="cidade" value="{{ $endereco->cidade ?? old('cidade') }}">
    {{ $errors->has('cidade') ? $errors->first('cidade') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Estado</label>
    <input type="text" class="form-control" name="estado" value="{{ $endereco->estado ?? old('estado') }}">
    {{ $errors->has('estado') ? $errors->first('estado') : '' }}
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
</form>
