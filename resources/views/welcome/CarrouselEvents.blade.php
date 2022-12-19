<div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Próximas Etapas</h4>
            <div class="owl-carousel owl-theme full-width">
                @foreach($dados["events"] as $e)
                @if( $e->finished === 1 ) @php continue; @endphp @else
                <div class="item">
                    <div class="card text-white">
                        <img class="card-img" src="{{ Storage::url('/img/events/banner_event.png' ) }}" alt="Card image">
                        <div class="card-img-overlay d-flex">
                            <div class="mt-auto text-left w-100">
                            <h1>Etapa {{$e->name}}</h1>
                            <h4 class="card-text mb-4 font-weight-normal">Em {{$e->data}} as {{$e->horario}}h.</h4>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach()
            </div>
        </div>
    </div>
</div>
