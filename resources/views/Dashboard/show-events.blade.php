<h4 class="card-title">Etapas do Campeonato</h4>
@if(session()->has('error'))
    <div class="alert alert-danger">
        {{ session()->get('error') }}
    </div>
@endif

<div class="table-responsive">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th>Etapa</th>
                <th>Data</th>
                <th>Horário</th>
                <th>Status</th>
                <th>#</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados["events"] as $e)
            <tr>
                <td>{{$e->name}}</td>
                <td>{{$e->data}}</td>
                <td>{{$e->horario}}</td>
                <td><div class="badge badge-{{$e->status}}">{{$e->badge}}</div></td>
                <td>
                    <div class="template-demo">
                        <div class="btn-group" role="group" aria-label="Basic example">
                            @if ($e->badge == "Agendado") 
                            <button type="button" class="btn btn-primary" onclick="location.href='/openEvent/{{$e->id}}'" title="Abrir inscrição para o evento" >
                            <i class="mdi mdi-currency-usd"></i>            
                            </button>
                            @elseif ($e->badge == "Realizado") 
                            <button type="button" class="btn btn-primary" onclick="location.href='/getResultEventReproc/{{$e->id}}'" title="Reprocessar resultado do evento" >
                            <i class="mdi mdi-reload"></i>
                            </button>
                            @elseif ($e->badge == "Confirmado") 
                            <button type="button" class="btn btn-primary" onclick="location.href='/getResultEvent'" title="Processar resultado do evento" >
                            <i class="mdi mdi-download"></i>
                            </button>
                            @endif
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
