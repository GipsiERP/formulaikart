<h4 class="card-title">Inscrições pendente pagamento</h4>
<!-- Tabs navs -->
<ul class="nav nav-tabs tab-no-active-fill">
    @foreach($dados["inscritosEtapa"] as $c)
    <li class="nav-item">
        <a href="#{{ strtolower($c->nameHash) }}" class="nav-link {{$c->id === 1 ? "show active" : "" }}" data-bs-toggle="tab">{{$c->name}}</a>
    </li>
    @endforeach
</ul>
<!-- Tabs navs -->

<!-- Tabs content -->
@php $qtdetab=0; @endphp
<div class="tab-content">
    @foreach($dados["inscritos"] as $c)
    @php $qtdetab++; @endphp    
    <div class="tab-pane fade {{$qtdetab === 1 ? "show active" : "" }}" id="{{ strtolower($c["dados"]->nameHash) }}">
        <h3 class="card-title">Etapa: {{$c["dados"]->name}}</h3>

        <div class="d-flex justify-content-between mt-2">
            <small>Confirmados</small>
            <small>{{ $c["draw"]->percent }}%</small>
        </div>
        
        <div class="progress progress-sm mt-2">
            <div class="progress-bar bg-success" role="progressbar" style="width: {{$c["draw"]->percent}}%" aria-valuenow="{{$c["draw"]->percent}}" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        <br>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Seq</th>
                        <th>Piloto</th>
                        <th>Status do Pagamento </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($c["drivers"] as $dc)
                    <tr>
                        <!-- <td>{{$dc->id}}</td> -->
                        <td>{{$no++}}</td>
                        <td>{{$dc->name}}</td>
                        <td><div class="badge badge-danger">Pendente</div></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
    @endforeach
</div>
<!-- Tabs content -->



