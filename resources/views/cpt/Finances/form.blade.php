<form class="row g-3 needs-validation" novalidate id="formModal">
    @csrf
    <input type="hidden" class="form-control" id="id" value="" required>

    <div class="col-md-6">
        <label for="name" class="form-label">Piloto / Fornecedor</label>
        <input type="text" class="form-control" id="name" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="due" class="form-label">Vencimento</label>
        <input type="date" class="form-control" id="due" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-2">
        <label for="value" class="form-label">R$ Incrição</label>
        <input type="number" class="form-control" id="value" value="" required>
        <div class="invalid-feedback">
            Selecione o Campeonato.
        </div>
    </div>
    
</form>
