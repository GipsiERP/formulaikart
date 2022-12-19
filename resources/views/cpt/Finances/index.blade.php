@extends('layouts.kapella')

<!-- extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => $set['title'] ]) -->

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
                <div class="row">
                  
                </div>
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id="datatable" >
                    <thead class=" text-primary">
                      <tr>
                        <th><input type="checkbox" class="form-check-input" id="selectAll"  ></th>
                        <th>ID</th>
                        <th>Fatura</th>
                        <th>Cliente/Fornecedor</th>
                        <th>Emissão</th>
                        <th>Vencimento</th>
                        <th>R$</th>
                        <th>Data Pagto</th>
                        <th>R$ Pago</th>
                        <th width="50px" >Status</th>
                        <th class="text-right">Ações</th>
                      </tr>
                    </thead>
                    
                  </table>
                </div>
                  @include('layouts.kapella.modal-form')
                  @include(
                        $set["module"].'.'.
                        $set["prefix"].'.'.
                        "modal-pay ")
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('js')

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

<script>
  
$(document).ready(function() {


    var table = $('#datatable').DataTable( {
          "ajax":{ 
                "url"  :"/{{ ucwords($set['prefix']) }}",
                "type" : "GET",
          },
          beforeSend: function() {
              $('#loader').show();
          },
          complete: function() {
              $('#loader').hide();
          },
          "columns": [
              { "data": id,
                  render: function (data, type, row) { 
                    return "<input type=\"checkbox\" value=\"data\" class=\"form-check-input sum\"\>"; 
                  } 
              },
              { "data": "id" },
              { "data": "number" },
              { "data": "name" },
              { "data": "data" },
              { "data": "due" },
              { "data": "value" },
              { "data": "due_pay" },
              { "data": "value_pay" },
              { "data": "status" ,
                  render: function (data, type, row) { 
                    return "<span class=\"badge badge-pill badge-"+(data == 'pago' ? 'success' : 
                    (data == 'A vencer' ? 'warning' : 'danger'))+" \">"+
                    (data == 'pago' ? 'Pago' : 
                    (data == 'A vencer' ? 'A vencer' : 'Atrasado'))+"</span>"
                        ; 
                  }
              },
              {
                "render": function ( data, type, row, meta ) {                    
                return  '<div class="btn-group" role="group" aria-label="Basic example">'+
                          '<button type="button" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-inverse-dark btn-icon" title="Visualizar" id="btnShow"><i class=" mdi mdi-eye "></i></button>'+
                          '<button type="button" class="btn btn-inverse-dark btn-icon" title="Editar" id="btnUpdate"><i class="mdi mdi-pencil "></i></button>'+
                          '<button type="button" class="btn btn-inverse-dark btn-icon" title="Apagar" id="btnDelete"><i class="mdi mdi-delete"></i></button>'+
                        '</div>';
                }      
              }
          ],
          "columnDefs": [
            {
                orderable: false,
                className: 'select-checkbox',
                targets:   0
            } ,
            // { className: "text-center", "targets": [ 2 ] },
            // { className: "text-center", "targets": [ 3 ] },
            // { className: "text-center", "targets": [ 4 ] },
            // {
            //     targets: 5,
            //     render: $.fn.dataTable.render.number('.', ',', 2, '')
            // },
            // {
            //     targets: 7,
            //     render: $.fn.dataTable.render.number('.', ',', 2, '')
            // }
          ],
          //"dom": 'Bfrtip',
          dom: "<'row'<'col-10'r>><'row'<'col-5'l><'col-7 text-right'f>>" +
          "<'row'<'col-sm-12'B>><'row'<'col-sm-12't>><'row'<'col-5'i><'col-7'p>>",
          // toolbar
          buttons: {
              dom: {
                  button: {
                      tag: 'button',
                      className: 'btn btn-sm'
                  }
              },
              buttons: [
                  {
                      attr:  { id: 'reload' },
                      text: "\<span class\=\"material-icons\"\>\<i class\=\"mdi mdi-reload\"\></i\></span>Atualizar",
                      action: function ( e, dt, node, config ) {
                          table.clear().draw();
                          table.ajax.reload( null, false );
                      },
                      className: 'btn-primary'
                  },
                  
                  { 
                      extend: "print", 
                      text: "<span class=\"material-icons\">\<i class\=\"mdi mdi-printer\"\></i\></span>Imprimir", 
                      className: 'btn-primary'
                  },
                  {  
                      extend: "excelHtml5", 
                      text: "<span class=\"material-icons\">\<i class\=\"mdi mdi-file-excel\"\></i\></span> Excel", 
                      className: 'btn-primary'
                  },
                  { 
                      extend: "pdfHtml5", 
                      text: "<span class=\"material-icons\">\<i class\=\"mdi mdi-file-pdf\"\></i\></span> PDF", 
                      className: 'btn-primary'
                  },{
                      text: "<span id=\"btnPay\" class=\"material-icons\">\<i class\=\"mdi mdi-plus\" \></i\></span>Baixa Pagamento",
                      action: function ( e, dt, node, config ) {
                    //       $('#modalFormPay')[0].reset();
                    //       $('#id').val('0');
                    //       $("#modal-pay").modal("show");
                        pay();
                      },
                      className: 'btn-primary'
                  },
              ],
          },
        //   "search": {"search" : '@php echo date("m/Y") @endphp' },
          "order": [[ 0, "asc" ]],
          processing  : false,
          "language":{
            "url":"/js/Portuguese-Brasil.json"
          },
      } );
      
      $.ajaxSetup({
          headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

        // submit
        $(document).on('click', '#btnSubmit', function(event) {

            event.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ @url()->current() }}",
                method: 'POST',
                data: {
                    id              : $("#id").val(),
                    due             : $("#due").val(),
                    // name            : $("#name").val(),
                    // data            : $("#data").val(),
                    // horario         : $("#horario").val(),
                    // track_id        : $("#track_id").val(),
                    // fee_value       : $("#fee_value").val(),                    
                },
                success: function(result){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Salvo',
                        showConfirmButton: false,
                        timer: 1500
                    });
                    table.clear().draw();
                    table.ajax.reload( null, false );

                    $("#myModal").modal('hide');

                },
                error: function(result){
                    txt = '';
                    $.each(result.responseJSON.errors, function(key, value){
                        txt = txt + value + '<br />';
                    });
                    Swal.fire(
                        'Favor revisar',
                        txt ,
                        'warning'
                    );
                }

            });

        });


      // SHOW
      $(document).on('click', '#btnShow', function(event) {
          event.preventDefault();

          var id  = $(this).parents('tr').find("td:eq(1)").text();
          let href = `{{ @url()->current() }}/${id}`;
          $.ajax({
              url: href,
              beforeSend: function() {
                  $('#loader').show();
              },
              // return the result
              success: function(result) {
                //   $('#modalForm')[0].reset();
                  $("#action").hide();
                  $("#id").val(result.data.id);
                  $("#name").val(result.data.name);
                  $("#due").val(result.data.due);
                  $("#value").val(result.data.value);      

              },
              complete: function() {
                  $('#loader').hide();
              },
              error: function(jqXHR, testStatus, error) {
                  console.log(error);
                  alert("Page " + href + " cannot open. Error:" + error);
                  $('#loader').hide();
              },
              timeout: 8000
          })
      });
      
      // Update
      $("#datatable").on("click", "#btnUpdate", function () {

          var id  = $(this).parents('tr').find("td:eq(1)").text();
          let _url = `{{ @url()->current() }}/${id}`;

          $.ajax({
              url: _url,
              type: "GET",
              success: function(result) {
                  $('#formModal')[0].reset();
                  
                  $("#id").val(result.data.id);
                  $("#name").val(result.data.name);
                  $("#due").val(result.data.due);
                  $("#value").val(result.data.value);                 
                  
                  $("#action").show();
                  $("#myModal").modal("show");

              }
          });

      });

      // DELETE 
      $("#datatable").on("click", "#btnDelete", function () {

          Swal.fire({
              title: "Excluir dados?",
              icon: "warning",
              "buttons": true,
              dangerMode: true,
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Sim',
              cancelButtonText: 'Não',
          })
          .then((result) => {

            if (result.value === true) {
              
              var id  = $(this).parents('tr').find("td:eq(1)").text();
              let _url = `{{ @url()->current() }}/${id}`;
              let _token   = $('meta[name="csrf-token"]').attr('content');

              $.ajax({
                  url: _url,
                  type: 'DELETE',
                  data: {
                    id      : id,
                    _token  : _token
                  },
                  success: function(response) {
                      // if(response.code == 200) {
                        
                          table.clear().draw();
                          table.ajax.reload( null, false );
                          Swal.fire(
                              'Apagado',
                              'Dados excluído !',
                              'success'
                          );
                      // }
                  },
                  error: function(response) {
                      Swal.fire({ 
                          "title": "Dados não excluído !", 
                          "text": "Erro ao excluir (possui algum vinculo)",
                          "icon": 'error',
                      });
                  },
              });    
              
          } else {
              Swal.fire({
                  title: "Exclusão cancelada !"
              });
          }
        }); 
      });

    // SubmitPay
    $(document).on('click', '#btnPay', function(event) {

        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        ids = [];
           
        $('input.sum:checkbox:checked').each(function () {            
            var id  = $(this).parents('tr').find("td:eq(1)").text();
            var val  = $(this).parents('tr').find("td:eq(6)").text().replace(".", "");
            val = val.replace(",", ".") ;
            ids.push({"id":id, "valor":val});
        });

        $.ajax({
            url: "{{ @url()->current() }}",
            method: 'POST',
            data: {
                ids             : ids, 
                pay_date        : $("#pay_date").val(),
                qtde_pay        : $("#qtde_pay").val(),
                total_pay       : $("#total_pay").val(),
                bank_id         : $("#bank_id").val(),
                action          : "pay",
            },
            success: function(result){
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Salvo',
                    showConfirmButton: false,
                    timer: 1500
                });
                table.clear().draw();
                table.ajax.reload( null, false );

                $("#myModal").modal('hide');

            },
            error: function(result){
                txt = '';
                $.each(result.responseJSON.errors, function(key, value){
                    txt = txt + value + '<br />';
                });
                Swal.fire(
                    'Favor revisar',
                    txt ,
                    'warning'
                );
            }

        });

    });


    /// cancel modal
    $( "#cancelPost" ).click(function() {
        $('#modalForm')[0].reset();
        $('#modal-id').modal('hide');
    });

    // check all
    $("#selectAll").on( "click", function(e) {
        $("#datatable thead tr th input:checkbox").click(function() {
            var checkedStatus = this.checked;
            var index = $(this).parent().index() + 1;
            $("#datatable tbody tr td:nth-child("+index+") input:checkbox").each(function() {
                this.checked = checkedStatus;
            });
        });
    });

    function pay() {
 
        $('#modalFormPay')[0].reset();
        $('#id').val('0');
        $("#modal-pay").modal("show");
        var count = 0;
        var sum = 0;
        var ids = [];
        var i = 0;

        count = 0;
        if($("#datatable").hasClass('check_all')){
            
            $('input[type="checkbox"][class="form-check-input"]').prop('checked',true);
            $('input[type="checkbox"][class="form-check-input"]').each(function(){

                count += 1; //parseInt($(this).val());
                
            });
            
        }else{
            // $('input[type="checkbox"]:checked').each(function(){
            $('input.sum:checkbox:checked').each(function () {            
                
                var val  = $(this).parents('tr').find("td:eq(6)").text().replace(".", "");
                val = val.replace(",", ".") ;

                var id  = $(this).parents('tr').find("td:eq(1)").text();

                sum = (sum + parseInt( val*100 ) );
                count += 1; 
                i++;
            });
        }   

        $("#total_pay").val(sum/100).toLocaleString("pt-BR", {style:"currency", currency:"Real"});
        $("#qtde_pay").val(count);

    };

});
</script>

@endpush
