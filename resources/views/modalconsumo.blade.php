<div id="modalconsumo" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" id="modalCloseConsumo" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Registar Produto</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="formularioConsumo">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Categoria</label>
                                <select name="categoria" class="custom-select mt-3">
                                    <option>Alimento</option>
                                    <option>Bebida</option>
                                    <option>Bolos</option>
                                    <option>Doces</option>
                                    <option>Salgados</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Designação</label>
                                <input  type="text" class="form-control" required name="designacao" placeholder="ex: SUMO NUTRY">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Quantidade</label>
                                <input required  type="number" class="form-control" required name="quantidade" placeholder="ex: 10">
                            </div>
                        </div>
                    </div>
                    <input  type="hidden" class="form-control" value="{{$evento->id}}" required name="idEvento">
                                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
