<div id="modalconvidado" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Adicionar Convidado</h4>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('/inserirConvidado')}}" >
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="field-3" class="control-label">Nome</label>
                                <input  type="text" class="form-control" required name="nome" placeholder="ex: Dalton Edval Cabeia">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="field-3" class="control-label">Genero</label><br>
                            <div style="margin-left:7px" class="radio radio-info form-check-inline">
                                <input type="radio" id="inlineRadio1" value="M" name="genero" checked>
                                <label for="inlineRadio1"> Masculino </label>
                            </div>
                            <div class="radio form-check-inline">
                                <input type="radio" id="inlineRadio2" value="F" name="genero">
                                <label for="inlineRadio2"> Feminino </label>
                            </div>
                        </div>
                    </div>
                    <br>
                    <?php if($assento->tipo !='Cadeira'){ ?>
                        <!-- AJAX para adicionar acompanhante -->
                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" id="maisAcompanhante" name="maisAcompanhante" class="btn btn-primary btn-sm"><i class='fa fa-plus'>  Mais Acompanhante </i></button><br>
                                <table id="tabela" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <tr class="linha">
                                        <td style="text-align: center;width:90%"><input  type="text" class="form-control" name="nome_acompanhante[]" placeholder="Informe o nome do acompanhante"></td>
                                        <td class="eliminar" style="text-align: center"><button type="button" class="btn btn-danger btn-md"><i class='fa fa-trash-alt'> </i></button></td>                                                    
                                    </tr>
                                </table>
                            </div>
                        </div>
                    <?php } ?>
                    <input  type="hidden" class="form-control" value="{{$assento->id}}" required name="idAssento">
                    <input  type="hidden" class="form-control" value="{{$pasta}}" required name="pasta">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning waves-effect" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Registar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
