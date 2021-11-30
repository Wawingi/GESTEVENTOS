<div id="modalevento" class="modal fade modalEditarAssento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Editar Assento</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('editarAssento')}}" >
                    @csrf                              
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Designação</label>
                                <input  type="text" class="form-control" required name="designacao" id="designacao" placeholder="ex: MESA-AMIGOS">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="form-control" name="id_assento" id="id_assento">                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
