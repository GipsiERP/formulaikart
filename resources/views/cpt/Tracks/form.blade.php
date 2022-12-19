<form class="row g-3 needs-validation" novalidate id="formModal">
    @csrf
    <input type="hidden" class="form-control" id="id" value="" required>

    <div class="col-md-6">
        <label for="name" class="form-label">Nome do Piloto</label>
        <input type="text" class="form-control" id="name" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-6">
        <label for="cidade" class="form-label">Cidade</label>
        <input type="text" class="form-control" id="cidade" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>
    
    <div class="col-md-3">
        <label for="telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="telefone" value="" required>
        <div class="invalid-feedback">
            Selecione o Campeonato.
        </div>
    </div>
    <div class="col-md-3">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" class="form-control" id="celular" value="" required>
        <div class="invalid-feedback">
            Selecione a Categoria.
        </div>
    </div>

    <div class="col-md-6">
        <label for="email" class="form-label">email</label>
        <input type="text" class="form-control" id="email" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>
    
</form>
