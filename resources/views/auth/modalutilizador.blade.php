<div id="modalevento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="closeModal" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Registar Utilizador</h4>
            </div>
            <div class="modal-body">
                <form action="{{ url('registarutilizador')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Tipo</label>
                                <select name="tipo" class="custom-select mt-3">
                                    <option value="1">Administrador</option>
                                    <option value="2">Protocolo</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nome</label>
                                <input  type="text" required class="form-control" name="nome" placeholder="Informe o nome">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Email</label>
                                <input required type="text" class="form-control" name="email" placeholder="ex: utilizador@gdw.com">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
