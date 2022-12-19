<div class="card">
    <div class="card-body">
    <h4 class="card-title">Sorteio dos Karts</h4>

    <section style="">
        <div class="container py-5">
            <div class="main-timeline-2">
                @foreach($drivers as $d)
                @php $lado = ( ($no % 2 ) === 0)  ? "right" : "left" @endphp
                <div class="timeline-2 {{$lado}}-2">
                    <div class="card">
                        <!-- <img src="{{ Storage::url('/img/faces/1.png' ) }}" alt="image" class="card-img-top" alt="Responsive image" > -->
                        <!-- <img src="https://mdbcdn.b-cdn.net/img/Photos/Slides/img%20(135).webp" class="card-img-top" alt="Responsive image"> -->
                        <div class="card-body p-4">
                            <p> {{$no++; }} - {{$d->name}}</p>   
                            <!-- <h4 class="fw-bold mb-4">Ut enim ad minim veniam</h4> -->
                            <!-- <p class="text-muted mb-4"><i class="far fa-clock" aria-hidden="true"></i> 2017</p> -->
                            <!-- <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation
                            ullamco laboris nisi ut aliquip ex ea commodo consequat.</p> -->
                        </div>
                    </div>                    
                </div>
                @endforeach

            </div>
        </div>
    </section>

    </div>
</div>

<!-- <div class="card">
    <div class="card-body">
        <h4 class="card-title">Timeline</h4>
        <p class="card-description">A simple timeline</p>
        <div class="mt-5">
        <div class="timeline">
            <div class="timeline-wrapper timeline-wrapper-warning">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                <h6 class="timeline-title">Bootstrap 4 Beta</h6>
                </div>
                <div class="timeline-body">
                <p>Two years in the making, we finally have our first beta release of Bootstrap 4.</p>
                </div>
                <div class="timeline-footer d-flex align-items-center flex-wrap">
                    <i class="mdi mdi-heart-outline text-muted mr-1"></i>
                    <span>19</span>
                    <span class="ml-md-auto font-weight-bold">19 Oct 2017</span>
                </div>
            </div>
            </div>
            <div class="timeline-wrapper timeline-inverted timeline-wrapper-danger">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                <h6 class="timeline-title">Bootstrap 4 Alpha 6</h6>
                </div>
                <div class="timeline-body">
                <p>Alpha 6 has landed, and it’s one of our biggest ships to date.</p>
                </div>
                <div class="timeline-footer d-flex align-items-center flex-wrap">
                    <i class="mdi mdi-heart-outline text-muted mr-1"></i>
                    <span>25</span>
                    <span class="ml-md-auto font-weight-bold">10th Aug 2017</span>
                </div>
            </div>
            </div>
            <div class="timeline-wrapper timeline-wrapper-success">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                <h6 class="timeline-title">Bootstrap 4 Alpha 5</h6>
                </div>
                <div class="timeline-body">
                <p>Alpha 5 has arrived just over a month after Alpha 4 with some major feature improvements and a boat load of bug fixes.</p>
                </div>
                <div class="timeline-footer d-flex align-items-center flex-wrap">
                    <i class="mdi mdi-heart-outline text-muted mr-1"></i>
                    <span>19</span>
                    <span class="ml-md-auto font-weight-bold">5th Sep 2016</span>
                </div>
            </div>
            </div>
            <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                <h6 class="timeline-title">Bootstrap 4 Alpha 4</h6>
                </div>
                <div class="timeline-body">
                <p>Alpha 4 is here to address those pesky build and package errors, a few CSS bugs, and some documentation inconsistencies we introduced in our last release.</p>
                </div>
                <div class="timeline-footer d-flex align-items-center flex-wrap">
                    <i class="mdi mdi-heart-outline text-muted mr-1"></i>
                    <span>19</span>
                    <span class="ml-md-auto font-weight-bold">27th July 2016</span>
                </div>
            </div>
            </div>
            <div class="timeline-wrapper timeline-wrapper-primary">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                <h6 class="timeline-title">Bootstrap 4 Alpha 3</h6>
                </div>
                <div class="timeline-body">
                <p>Alpha 3 has landed! We have an overhauled grid, updated form controls, a new font stack, tons of bug fixes, and more.</p>
                </div>
                <div class="timeline-footer d-flex align-items-center flex-wrap">
                    <i class="mdi mdi-heart-outline text-muted mr-1"></i>
                    <span>25</span>
                    <span class="ml-md-auto font-weight-bold">25th July 2016</span>
                </div>
            </div>
            </div>
            <div class="timeline-wrapper timeline-inverted timeline-wrapper-info">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                <h6 class="timeline-title">Bootstrap 4 Alpha 2</h6>
                </div>
                <div class="timeline-body">
                <p>The general plan for v4’s development starts with a few alpha releases. We’re a little behind on that, but should be getting caught up as the year winds down.</p>
                </div>
                <div class="timeline-footer d-flex align-items-center flex-wrap">
                    <i class="mdi mdi-heart-outline text-muted mr-1"></i>
                    <span>32</span>
                    <span class="ml-md-auto font-weight-bold">19th Aug 2015</span>
                </div>
            </div>
            </div>
            <div class="timeline-wrapper timeline-wrapper-success">
            <div class="timeline-badge"></div>
            <div class="timeline-panel">
                <div class="timeline-heading">
                <h6 class="timeline-title">Bootstrap 4 alpha 1</h6>
                </div>
                <div class="timeline-body">
                <p>Bootstrap 4 has been a massive undertaking that touches nearly every line of code.</p>
                </div>
                <div class="timeline-footer d-flex align-items-center flex-wrap">
                    <i class="mdi mdi-heart-outline text-muted mr-1"></i>
                    <span>26</span>
                    <span class="ml-md-auto font-weight-bold">15th Jun 2015</span>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div> -->