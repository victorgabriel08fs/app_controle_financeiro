<div class="modal fade" id="modalSaque_{{ $conta->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modalSaque_{{ $conta->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form_saque_{{ $conta->id }}" action="{{ route('conta.saque', ['conta' => $conta]) }}"
                method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSaque_{{ $conta->id }}">Saque</h5>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="valor">Valor</label>
                        <input class="form-control" type="number" step=".01" name="valor" id="saqueId">
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
