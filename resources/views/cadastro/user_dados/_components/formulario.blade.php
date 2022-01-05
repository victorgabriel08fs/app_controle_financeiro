@if (isset($user_dados->id))
    <form action="{{ route('user_dados.update', ['user_dados' => $user_dados]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('user_dados.store') }}" method="POST">
            @csrf
@endif
<input type="hidden" name="user_id" value={{ auth()->user()->id }}>
<div class="mb-3">
    <label class="form-label">Telefone</label>
    <input type="phone" class="form-control" name="telefone" value="{{ $user_dados->telefone ?? old('telefone') }}">
    {{ $errors->has('telefone') ? $errors->first('telefone') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Data de Nascimento</label>
    <input type="date" max="{{ date('Y-m-d') }}" class="form-control" name="data_nasc"
        value="{{ $user_dados->data_nasc ?? old('data_nasc') }}">
    {{ $errors->has('data_nasc') ? $errors->first('data_nasc') : '' }}
</div>
<label class="form-label">Estado Civil</label>
<select class="form-select" name="estado_civil">
    <option value=0 {{ isset($user_dados->id) && $user_dados->estado_civil == 0 ? 'selected' : '' }}>
        Solteiro (a)</option>
    <option value=1 {{ isset($user_dados->id) && $user_dados->estado_civil == 1 ? 'selected' : '' }}>
        Casado (a)</option>
    <option value=2 {{ isset($user_dados->id) && $user_dados->estado_civil == 2 ? 'selected' : '' }}>
        Divorciado (a)</option>
    <option value=3 {{ isset($user_dados->id) && $user_dados->estado_civil == 3 ? 'selected' : '' }}>
        Viúvo (a)</option>
</select>
{{ $errors->has('estado_civil') ? $errors->first('estado_civil') : '' }}
<br>
<label class="form-label">Sexo</label>
<select class="form-select" name="sexo">
    <option value=0 {{ isset($user_dados->id) && $user_dados->sexo == 0 ? 'selected' : '' }}>
        Masculino (a)</option>
    <option value=1 {{ isset($user_dados->id) && $user_dados->sexo == 1 ? 'selected' : '' }}>
        Feminino (a)</option>
</select>
{{ $errors->has('sexo') ? $errors->first('sexo') : '' }}
<br>
<button type="submit" class="btn btn-primary">Salvar</button>
</form>
