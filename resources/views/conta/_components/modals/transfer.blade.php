<div class="modal fade" id="modalTransfer_{{ $conta->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalTransfer_{{ $conta->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form_transfer_{{ $conta->id }}" action="{{ route('conta.transfer', ['conta' => $conta]) }}"
                method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTransfer_{{ $conta->id }}">Transferência
                    </h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="cpf">Beneficiário</label>
                        <input class="form-control" type="text" name="cpf" id="cpfId"><br>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="valor">Valor</label>
                        <input class="form-control" step=".01" type="number" name="valor" id="valorId">
                    </div>
                    <label class="form-label">Tipo</label>
                    <select class="form-select" name="tipo">
                        <option value=0>Poupança</option>
                        <option value=1>Corrente</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>
