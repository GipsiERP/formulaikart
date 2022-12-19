<div class="modal fade" id="modal-tarifa-id" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="alert alert-danger" style="display:none"></div>
            <div class="modal-header">
                <h4 class="modal-title" id="userCrudModal">Cadastro de tarifa bancária</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>

            <div class="modal-body">
                <form id="modalFormTarifa" class="needs-validation" novalidate>

                    <br>
                    @csrf
                    <input type="hidden" class="form-control" id="id" value="{{old('id')?? ($dados->id??0)}}">
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="dt_movimento">Data</label>
                            <input type="text" class="form-control" id="dt_movimento" placeholder="Data" value="{{old('dt_movimento')?? ($dados->dt_movimento??"")}}" aria-describedby="inputGroupPrepend"  required>
                            <div class="invalid-feedback">Favor revisar</div>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="name">R$</label>
                            <input class="form-control" data-inputmask="'alias': 'currency'" style="text-align: right;" value="{{old('name')?? ($dados->name??"")}}" im-insert="true" required>
                            <div class="invalid-feedback">Favor revisar</div>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="bank">Banco</label>
                            <select class="form-control" id="exampleFormControlSelect1" required>
                                <option value="0">Selecione o Banco</option>
                                @foreach($bancos as $b)
                                <option value="{{$b->id}}">{{$b->name}}-{{$b->agencia}}</option>
                                @endforeach()
                            </select>
                            <div class="invalid-feedback">Favor revisar</div>
                        </div>
                        <div class="form-group col-md-5">
                            <label for="historico">Histórico</label>
                            <input type="text" class="form-control" id="historico" placeholder="Histórico" value="{{ old('historico')?? ( $dados->historico??"" )}}" aria-describedby="inputGroupPrepend"  required>
                            <div class="invalid-feedback">Favor revisar</div>
                        </div>
                    </div>

                    <div id="action">
                        <button type="submit" class="btn btn-primary" id="btnSubmitTarifa" >Salvar</button>                        
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div> 