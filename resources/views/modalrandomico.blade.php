<div id="modalrandomico" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">    
				<button id="modalCloseRandomico" type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Gerar Convite</h4>
            </div>
            <div class="modal-body">
                <form id="formularioGerarConvite" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Quantidade</label>
                                <input  type="number" max="20" class="form-control" name="quantidade" required placeholder="Informe a quantidade de convites a gerar">
								<span style="color:red;font-size:12px">O máximo a gerar é 20</span>
							</div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id_evento" required value="{{$evento->id}}">
					<input type="hidden" class="form-control" name="entidade" required value="{{$evento->entidade}}">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
