<div class="modal" id="modal-pay" tabindex="-1" >
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ $set['title'] }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">

            <form class="row g-3 needs-validation" novalidate id="modalFormPay">
                @csrf
                <input type="text" class="form-control" id="idPay" name="ids[]" value="" required>

                <div class="col-md-2">
                    <label for="pay_date" class="form-label">Data do Pagamento</label>
                    <input type="date" class="form-control" id="pay_date" value="" required>
                    <div class="invalid-feedback">
                        Selecione o Campeonato.
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="qtde_pay" class="form-label">Qtde Pagtos</label>
                    <input type="text" class="form-control" id="qtde_pay" value="" required>
                    <div class="invalid-feedback">
                    Preenchimento obrigatório
                    </div>
                </div>

                <div class="col-md-3">
                    <label for="total_pay" class="form-label">Total R$ Pagtos</label>
                    <input type="text" class="form-control" id="total_pay" value="" required>
                    <div class="invalid-feedback">
                    Preenchimento obrigatório
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="bank_id" class="form-label">Local</label>
                        <select class="form-select" id="bank_id" required>
                            <option selected disabled value="">Escolha...</option>
                            @foreach($dados as $d)
                            <option value="{{$d->id}}">{{$d->name}}</option>
                            @endforeach
                        </select>
                    <div class="invalid-feedback">Selecione a Categoria.</div>
                </div>
                
            </form>

          </div>
        </div>
      </div>
      <div class="modal-footer" id="action">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="btnPay" >Salvar</button>
      </div>
    </div>
  </div>
</div>
