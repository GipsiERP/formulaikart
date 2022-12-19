<form class="row g-3 needs-validation" novalidate id="formModal">
    @csrf
    <input type="hidden" class="form-control" id="id" value="" required>

    <div class="col-md-6">
        <label for="name" class="form-label">Evento / Etapa</label>
        <input type="text" class="form-control" id="name" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="data" class="form-label">Data</label>
        <input type="date" class="form-control" id="data" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-3">
        <label for="horario" class="form-label">Horário</label>
        <input type="time" class="form-control" id="horario" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-4">
        <label for="track_id" class="form-label">Local</label>
            <select class="form-select" id="track_id" required>
                <option selected disabled value="">Escolha...</option>
                @foreach($dados as $d)
                <option value="{{$d->id}}">{{$d->name}}</option>
                @endforeach
            </select>
        <div class="invalid-feedback">
            Selecione a Categoria.
        </div>
    </div>

    <div class="col-md-2">
        <label for="fee_value" class="form-label">R$ Incrição</label>
        <input type="number" class="form-control" id="fee_value" value="" step="0.01" name="fee_value" min="0.01"  required>
        <div class="invalid-feedback">
            Selecione o Campeonato.
        </div>
    </div>
    
</form>
