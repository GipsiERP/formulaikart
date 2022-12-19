@extends('layouts.kapella')

@section('content')

@include("welcome.CarrouselEvents")
<div class="row mt-4">

    <div class="col-lg-12 mb-12 mb-lg-0">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">                    
                    @include("welcome.show-driverCategoria")
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-12 mb-12 mb-lg-0">
        <div class="card">
            <div class="card-body pb-0">
                <div class="row">                    
                    @include("welcome.show-teamCategoria")
                </div>
            </div>
        </div>
    </div>
    

</div>

<div class="row mt-4">
    <div class="col-lg-12 mb-12 mb-lg-0">
    <div class="card">
    @include("welcome.show-driver")
    </div>
    </div>
</div>

@endsection

@push('js')
<script>
    $(document).ready(function() {    
        $('.full-width').owlCarousel({
            loop: true,
            margin: 10,
            items: 1,
            nav: true,
            autoplay: true,
            autoplayTimeout: 5000,
            navText: ["<i class='mdi mdi-chevron-left'></i>", "<i class='mdi mdi-chevron-right'></i>"]
        });
    });

</script>

@endpush('js')
