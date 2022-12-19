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
        <label for="apelido" class="form-label">Apelido do Piloto</label>
        <input type="text" class="form-control" id="apelido" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-4">
        <label for="rg" class="form-label">RG</label>
        <input type="text" class="form-control" id="rg" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-4">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-4">
        <label for="dn" class="form-label">Data de Nascimento</label>
        <input type="date" class="form-control" id="dn" value="" required>
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
