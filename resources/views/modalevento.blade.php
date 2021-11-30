<div id="modalevento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">    
				<button id="modalClose" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Registar Evento</h4>
            </div>
            <div class="modal-body">
                <form id="formularioSalvar" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Tipo</label>
                                <select name="tipo" class="custom-select mt-3">
                                    <option>Casamento</option>
                                    <option>Aniversario</option>
                                    <option>Forum</option>
                                    <option>Outro</option>
                                </select>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Modalidade de Convite</label>
                                <select name="modalidade" class="custom-select mt-3">
                                    <option value='1'>Gerenciável</option>
                                    <option value='2'>Randómico</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Entidade</label>
                                <input  type="text" class="form-control" name="entidade" placeholder="ex: Casal Acordeon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Local</label>
                                <input  type="text" class="form-control" name="local" placeholder="ex: Salão de Eventos GPLine">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Data</label>
                                <input  type="date" class="form-control" name="data" placeholder="ex: Ambiente Favorável">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Hora</label>
                                <input  type="time" class="form-control" name="hora" placeholder="ex: Ambiente Favorável">
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
