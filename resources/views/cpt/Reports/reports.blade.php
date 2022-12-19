@extends('layouts.kapella')

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ $set['title'] }}</h4>
                <p class="card-category"> Gerenciamento de {{ $set['title'] }}</p>
              </div>
              <div class="card-body">
                    @include("cpt.Reports.form")
              </div>
            </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
            <div class="card">
                @include("cpt.Reports.ReportsKartRaffles")      
            </div>  
        </div>  
      </div>  
    </div>
  </div>

@if( count( $dados["drivers"] ) > 0 ){
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-4 grid-margin stretch-card">
            @include("cpt.kartRaffle.raffle")
        </div>
    </div>
</div>
@endif

@endsection



@push('js')
<script>
  
$(document).ready(function() {    

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#forms").on('click', '#getDrivers', function(event) {

        event.preventDefault();
        let href = `{{ @url()->current() }}`;
        $.ajax({
            url: href,
            type: "post",
            data: { 
                event_id        : $("#event_id").val(),
                categoria_id    : $("#categoria_id").val(),
            },
            beforeSend: function() {
                $('#loader').show();
            },
              // return the result
            success: function(result) {
                $("#driversList").find("tr:gt(0)").remove();

                $.each(result.data.drivers, function(key, value) {   

                    $('#driversList').append(`<tr id="">
                        <td class="row-index text-center">
                                <p>${value.id}</p></td>
                        <td class="text-center">${value.name}</tr>`);
                    
                });
                
                $("#loading").hide();
                $("#listDrivesCards").show();
            },
              complete: function() {
                  $('#loader').hide();
              },
              error: function(jqXHR, testStatus, error) {
                  $('#loader').hide();
                  console.log(error,testStatus , jqXHR.responseText.errors );
                  alert("Page " + href + " cannot open. Error:" + error);
              },
              timeout: 8000
          }) 
    });

});
</script>

@endpush
