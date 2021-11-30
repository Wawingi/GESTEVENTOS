<div id="modalevento" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Registar Assento</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/inserirAssento')}}" >
                    @csrf
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Tipo</label>
                                                    <select id="tipo" name="tipo" class="custom-select mt-3">
                                                        <option>Mesa</option>
                                                        <option>Cadeira</option>
                                                        <option>Outro</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Designação</label>
                                                    <input  type="text" class="form-control" required name="designacao" placeholder="ex: MES-12">
                                                </div>
                                            </div>
                                            <div id="el" class="col-md-6">
                                                <div class="form-group">
                                                    <label for="field-3" class="control-label">Capacidade</label>
                                                    <input required type="number" class="form-control"  name="capacidade" placeholder="ex: 10">
                                                </div>
                                            </div>
                                        </div>
                                        <input  type="hidden" class="form-control" value="<?php echo $evento->id ?>" required name="idEvento">
                                        
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Fechar</button>
                        <button type="submit" name="registar" class="btn btn-primary waves-effect waves-light">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
