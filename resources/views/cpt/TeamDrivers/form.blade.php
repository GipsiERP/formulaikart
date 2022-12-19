<form class="row g-3 needs-validation" novalidate id="formModal">
    @csrf
    <input type="hidden" class="form-control" id="id" value="" required>
    <div class="col-md-3">
        <label for="championship_id" class="form-label">Campeonato</label>
            <select class="form-select" id="championship_id" required>
                <option selected disabled value="">Escolha...</option>
                @foreach($dados["championship"] as $c )
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach                
            </select>
        <div class="invalid-feedback">
            Selecione o Campeonato.
        </div>
    </div>
    <div class="col-md-3">
        <label for="categoria_id" class="form-label">Categoria</label>
            <select class="form-select" id="categoria_id" required>
                <option selected disabled value="">Escolha...</option>
                @foreach($dados["category"] as $c )
                    <option value="{{$c->id}}">{{$c->name}}</option>
                @endforeach
            </select>
        <div class="invalid-feedback">
            Selecione a Categoria.
        </div>
    </div>

    <div class="col-md-6">
        <label for="name" class="form-label">Nome da Equipe</label>
        <input type="text" class="form-control" id="name" value="" required>
        <div class="invalid-feedback">
        Preenchimento obrigatório
        </div>
    </div>

    <div class="col-md-12 ">
        <label for="drive_id" class="form-label">Pilotos</label>
        <select class="drivers-multiple w-100 form-select" multiple="multiple" id="driver_id" name="drive_id[]">
        @foreach($dados["drivers"] as $c )
            <option value="{{$c->id}}">{{$c->name}}</option>
        @endforeach                
        </select>
        <div class="invalid-feedback">
            Selecione a Categoria.
        </div>        
    </div>
    
</form>
