<div class="modal" id="myModal" tabindex="-1" >
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ $set['title'] }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            @include($set['module'].".".$set['prefix'].'.form')
          </div>
        </div>
      </div>
      <div class="modal-footer" id="action">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary" id="btnSubmit" >Salvar</button>
      </div>
    </div>
  </div>
</div>
