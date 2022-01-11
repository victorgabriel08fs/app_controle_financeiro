<div class="modal fade" id="modalTaxa" tabindex="-1" role="dialog" aria-labelledby="modalTaxa" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="formConta" action="{{ route('taxa.store') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTaxa">Nova Taxa</h5>
                </div>
                <input type="hidden" name="user_id" value={{ auth()->user()->id }}>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label" for="cpf">Taxa (Decimal)</label>
                        <input class="form-control" type="number" step=".01" name="taxa" id="taxa"><br>
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
