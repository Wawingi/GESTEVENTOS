<div id="modaleditevento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button id="closeModalEdit" type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Editar Evento</h4>
            </div>
            <div class="modal-body">
                <form id="formularioEditar" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Tipo</label>
                                <select id="tipo" name="tipo" class="custom-select mt-3">
                                    <option>Casamento</option>
                                    <option>Aniversario</option>
                                    <option>Forum</option>
                                    <option>Outro</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Entidade</label>
                                <input  type="text" class="form-control" id="entidade" name="entidade" placeholder="ex: Casal Acordeon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Local</label>
                                <input  type="text" class="form-control" id="local" name="local" placeholder="ex: Salão de Eventos GPLine">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Data</label>
                                <input  type="date" class="form-control" id="data" name="data" placeholder="ex: Ambiente Favorável">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Hora</label>
                                <input  type="time" class="form-control" id="hora" name="hora" placeholder="ex: Ambiente Favorável">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" id="id_evento"  name="id_evento">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="registar" class="btn btn-primary waves-effect waves-light">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
