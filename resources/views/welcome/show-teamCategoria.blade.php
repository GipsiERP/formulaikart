<h4 class="card-title">Classificação Por Equipe do Campeonato </h4>
<!-- Tabs navs -->
<ul class="nav nav-tabs tab-no-active-fill">
    @foreach($dados["categories"] as $c)
    <li class="nav-item">
        <a href="#team{{ strtolower($c->name) }}" class="nav-link {{$c->id === 1 ? "show active" : "" }}" data-bs-toggle="tab">{{$c->name}}</a>
    </li>
    @endforeach
</ul>
<!-- Tabs navs -->

<!-- Tabs content -->
<div class="tab-content">
    @foreach($dados["categories"] as $c)
    <div class="tab-pane fade {{$c->id === 1 ? "show active" : "" }}" id="team{{ strtolower($c->name) }}">

        <h4>Categoria {{$c->name}}</h4>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <!-- <th>ID</th> -->
                        <th>Classificação</th>
                        <th>Equipe</th>
                        <th>Piloto</th>
                        <th>Pontos</th>
                    </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                    @foreach($dados["teams"]["teamBy".$c->name ] as $dc)
                    <tr>
                        <!-- <td>{{$dc->id}}</td> -->
                        <td>{{$no++}}</td>
                        <td>{{$dc->name}}</td>
                        <td>{{ $dc->drivers_name }}</td> 
                        <td>{{$dc->pontos}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        
    </div>
    @endforeach
</div>
<!-- Tabs content -->



