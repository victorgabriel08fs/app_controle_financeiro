<div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="modalMessage"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalMessage">Atenção</h5>
            </div>
            <div class="modal-body">
                @if (isset($message))
                    <br>
                    <div id='texto' class="message">
                        @if ($message == 0)
                            <h4 class="negativo">O usuário já possui os dois tipos de conta!</h4>
                        @elseif($message == 1)
                            <h4 class="negativo">O usuário já possui uma conta deste tipo!</h4>
                        @else
                            <h4 class="positivo">Conta criada com sucesso!</h4>
                        @endif
                    </div>
                @endif
            </div>
            <div class="modal-footer">

            </div>

        </div>
    </div>
</div>
<button hidden id="open-modal" type="button" class="btn btn-primary mb-3" data-toggle="modal"
    data-target="#modalMessage">
</button>
<button hidden id="close-modal" type="button" class="btn btn-secondary" data-dismiss="modal"
    data-target="#modalMessage"></button>



@if (isset($message))
    <script>
        window.onload = function() {
            document.getElementById("open-modal").click();
        }
        setTimeout(() => {
            document.getElementById("open-modal").click();
        }, 2000);
    </script>
@endif
