<div class="mb-5">
    <form {{ isset($status) && $status == 0 ? 'hidden' : '' }} action="{{ route('endereco.preencher') }}"
        method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">CEP</label>
            <input type="text" {{ isset($status) && $status == 1 ? 'disabled' : '' }} class="form-control" name="cep"
                value="{{ isset($endereco) ? $endereco->cep : '' }}">
            {{ $errors->has('cep') ? $errors->first('cep') : '' }}
        </div>
        <button class="btn btn-secondary" type="submit">Preencher Endereço</button>
        <br>
    </form>
</div>
<form action="{{ route('endereco.store') }}" method="POST">
    @csrf
    <input type="hidden" name="user_dados_id" value={{ auth()->user()->user_dados->id }}>
    <input type="hidden" name="cep" value={{ isset($endereco) ? $endereco->cep : '0000000' }}>

    <div class="mb-3">
        <label class="form-label">Rua</label>
        <input type="text" class="form-control" name="rua"
            value="{{ isset($endereco) ? $endereco->logradouro : '' }}">
        {{ $errors->has('rua') ? $errors->first('rua') : '' }}
    </div>
    <div class="mb-3">
        <label class="form-label">Número</label>
        <input type="text" class="form-control" name="numero">
        {{ $errors->has('numero') ? $errors->first('numero') : '' }}
    </div>
    <div class="mb-3">
        <label class="form-label">Complemento</label>
        <input type="text" class="form-control" name="complemento"
            value="{{ isset($endereco) ? $endereco->complemento : '' }}">
        {{ $errors->has('complemento') ? $errors->first('complemento') : '' }}
    </div>
    <div class="mb-3">
        <label class="form-label">Bairro</label>
        <input type="text" class="form-control" name="bairro"
            value="{{ isset($endereco) ? $endereco->bairro : '' }}">
        {{ $errors->has('bairro') ? $errors->first('bairro') : '' }}
    </div>
    <div class="mb-3">
        <label class="form-label">Cidade</label>
        <input type="text" class="form-control" name="cidade"
            value="{{ isset($endereco) ? $endereco->localidade : '' }}">
        {{ $errors->has('cidade') ? $errors->first('cidade') : '' }}
    </div>
    <div class="mb-3">
        <label class="form-label">Estado</label>
        <input type="text" class="form-control" name="estado" value="{{ isset($endereco) ? $endereco->uf : '' }}">
        {{ $errors->has('estado') ? $errors->first('estado') : '' }}
    </div>
    <button type="submit" class="btn btn-primary">Salvar</button>
</form>
