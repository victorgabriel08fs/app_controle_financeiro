@if (isset($user->id))
    <form action="{{ route('user.update', ['user' => $user]) }}" method="POST">
        @csrf
        @method('PUT')
    @else
        <form action="{{ route('user.store') }}" method="POST">
            @csrf
@endif
<div class="mb-3">
    <label class="form-label">Nome</label>
    <input type="text" class="form-control" name="name" value="{{ $user->name ?? old('name') }}">
    {{ $errors->has('name') ? $errors->first('name') : '' }}
</div>
<div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" class="form-control" name="email" value="{{ $user->email ?? old('email') }}">
    {{ $errors->has('email') ? $errors->first('email') : '' }}
</div>
{{-- <div class="mb-3">
    <label class="form-label">Senha</label>
    <input type="password" class="form-control" name="password" value="{{ $user->password ?? old('password') }}">
    {{ $errors->has('password') ? $errors->first('password') : '' }}
</div> --}}
@if (auth()->user()->id == 1)
    <label class="form-label">Status</label>
    <select class="form-select" name="is_admin">
        <option value=0 {{ isset($user->id) && !$user->is_admin ? 'selected' : '' }}>
            Básico</option>
        <option value=1 {{ isset($user->id) && $user->is_admin ? 'selected' : '' }}>
            Administrador</option>
    </select>
@endif
<br>
<a href="{{ url()->previous() }}" class="btn btn-primary">Voltar</a>
<button type="submit" class="btn btn-primary">Salvar</button>
</form>
