<div class="modal fade" id="modalSolicita" tabindex="-1" role="dialog" aria-labelledby="modalSolicita"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="form_solicita" action="{{ route('solicitacao.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSolicita">Solicitar nova conta</h5>
                </div>
                <div class="modal-body">
                    <input class="form-control" type="hidden" name="user_id" value="{{ $user->id }}"><br>
                    <input class="form-control" type="hidden" name="tipo" value=1><br>
                    <div class="mb-3">
                        <label class="form-label">Tipo</label>
                        <select class="form-select" name="conta">
                            <option value=0>Poupança</option>
                            <option value=1>Corrente</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Solicitar</button>
                </div>
            </form>
        </div>
    </div>
</div>
