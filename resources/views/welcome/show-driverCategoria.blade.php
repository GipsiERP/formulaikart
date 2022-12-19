<h4 class="card-title">Classificação Por Piloto do Campeonato </h4>
<!-- Tabs navs -->
<ul class="nav nav-tabs tab-no-active-fill">
    @foreach($dados["categories"] as $c)
    <li class="nav-item">
        <a href="#{{ strtolower($c->name) }}" class="nav-link {{$c->id === 1 ? "show active" : "" }}" data-bs-toggle="tab">{{$c->name}}</a>
    </li>
    @endforeach
</ul>
<!-- Tabs navs -->

<!-- Tabs content -->
<div class="tab-content">
    @foreach($dados["categories"] as $c)
    <div class="tab-pane fade {{$c->id === 1 ? "show active" : "" }}" id="{{ strtolower($c->name) }}">

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="row">
            <div class="col-lg-4">
                <h4>Categoria {{$c->name}}</h4>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <!-- <th>ID</th> -->
                                <th class="text-center">Posição</th>
                                <th>Piloto</th>
                                <th class="text-center">Pontos</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $no = 1; @endphp
                            @foreach($dados["drivers"]["driveBy".$c->name ] as $dc)
                            <tr>
                                <!-- <td>{{$dc->id}}</td> -->
                                <td class="text-center">{{$no++}}</td>
                                <td>{{$dc->name}}</td>
                                <td class="text-center">{{$dc->pontos}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-lg-8">

                <div class="row">

                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center"> 
                                    <img src="../../../../images/faces/face11.jpg" class="img-lg rounded" alt="profile image"/>
                                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <h6 class="mb-0">Maria</h6>
                                        <p class="text-muted mb-1">maria@gmail.com</p>
                                        <p class="mb-0 text-success font-weight-bold">Designer</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">

                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <img src="../../../../images/faces/face9.jpg" class="img-lg rounded" alt="profile image"/>
                                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <h6 class="mb-0">Thomas Edison</h6>
                                        <p class="text-muted mb-1">thomas@gmail.com</p>
                                        <p class="mb-0 text-success font-weight-bold">Developer</p>
                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <img src="../../../../images/faces/face12.jpg" class="img-lg rounded" alt="profile image"/>
                                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <h6 class="mb-0">Edward</h6>
                                        <p class="text-muted mb-1">edward@gmail.com</p>
                                        <p class="mb-0 text-success font-weight-bold">Tester</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <img src="../../../../images/faces/face11.jpg" class="img-lg rounded" alt="profile image"/>
                                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <h6 class="mb-0">Maria</h6>
                                        <p class="text-muted mb-1">maria@gmail.com</p>
                                        <p class="mb-0 text-success font-weight-bold">Designer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <img src="../../../../images/faces/face9.jpg" class="img-lg rounded" alt="profile image"/>
                                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <h6 class="mb-0">Thomas Edison</h6>
                                        <p class="text-muted mb-1">thomas@gmail.com</p>
                                        <p class="mb-0 text-success font-weight-bold">Developer</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <img src="../../../../images/faces/face12.jpg" class="img-lg rounded" alt="profile image"/>
                                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <h6 class="mb-0">Edward</h6>
                                        <p class="text-muted mb-1">edward@gmail.com</p>
                                        <p class="mb-0 text-success font-weight-bold">Tester</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
        
    </div>
    @endforeach
</div>
<!-- Tabs content -->
