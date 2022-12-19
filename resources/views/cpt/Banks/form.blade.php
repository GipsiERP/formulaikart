<form class="row g-3 needs-validation" novalidate id="formModal">
    @csrf
    <input type="hidden" class="form-control" id="id" value="" required>

    <div class="col-md-3">
        <label for="name" class="form-label">Nome do Banco</label>
        <input type="text" class="form-control" id="name" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="agencia" class="form-label">Agência</label>
        <input type="text" class="form-control" id="agencia" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="conta" class="form-label">Conta</label>
        <input type="text" class="form-control" id="conta" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>
    <div class="col-md-3">
        <label for="codigo" class="form-label">Código do Banco</label>
        <input type="text" class="form-control" id="codigo" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="contato_name" class="form-label">Nome do Gerente</label>
        <input type="text" class="form-control" id="contato_name" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="contato_telefone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="contato_telefone" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="contato_celular" class="form-label">Celular</label>
        <input type="text" class="form-control" id="contato_celular" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="contato_email" class="form-label">email</label>
        <input type="text" class="form-control" id="contato_email" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">    
        <label for="bank_principal" class="form-label">Banco Principal</label>
        <label class="toggle-switch">
            <input type="checkbox" id="bank_principal" checked>
            <span class="toggle-slider round"></span>
        </label>  
    </div>
       
</form>
