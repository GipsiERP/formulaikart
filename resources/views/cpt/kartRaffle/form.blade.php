<form class="row g-3 needs-validation" novalidate id="forms">
    @csrf
    <input type="hidden" class="form-control" id="id" value="" required>
    <div class="col-md-4">
        <label for="event_id" class="form-label">Eventos</label>
            <select class="form-select" id="event_id" required>
                <option selected disabled value="">Escolha...</option>
                @foreach($dados["events"] as $e)
                <option value="{{$e->id}}">{{$e->name}}</option>
                @endforeach
            </select>
        <div class="invalid-feedback">
            Selecione a Categoria.
        </div>
    </div>

    <div class="col-md-4">
        <label for="categoria_id" class="form-label">Categoria</label>
            <select class="form-select" id="categoria_id" required>
                <option selected disabled value="">Escolha...</option>
                @foreach($dados["categoria"] as $e)
                <option value="{{$e->id}}">{{$e->name}}</option>
                @endforeach
            </select>
        <div class="invalid-feedback">
            Selecione a Categoria.
        </div>
    </div>

    <button class="btn btn-primary" type="button" id="getDrivers" >Pesquisar</button>
    
</form>
