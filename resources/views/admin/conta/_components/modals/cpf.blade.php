<div class="modal fade" id="modalCpf" tabindex="-1" role="dialog" aria-labelledby="modalCpf" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formConta" action="{{ route('conta.cpf') }}"
                method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCpf">Nova Conta
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="cpf">CPF</label>
                        <input class="form-control" type="text" name="cpf" id="cpfId"><br>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
