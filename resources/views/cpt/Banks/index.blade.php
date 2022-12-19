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
                        <th>ID</th>
                        <th>Banco</th>
                        <th>Agência</th>
                        <th>Conta</th>
                        <th>Contato</th>
                        <th>telefone</th>
                        <th>celular</th>
                        <th>email</th>
                        <th width="50px" >Status</th>
                        <th class="text-right">Ações</th>
                      </tr>
                    </thead>
                    
                  </table>
                </div>
                  @include('layouts.kapella.modal-form')
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
            { "data": "id" },
            { "data": "name" },
            { "data": "agencia" },
            { "data": "conta"},
            { "data": "contato_name"},
            { "data": "contato_telefone"},
            { "data": "contato_celular",
                "render": function(data, type, full, meta) {
                        return '<a href="https://wa.me/55' + full.contato_celular + ' " target=\"_blank\" >'+ full.contato_celular +'</a>';
                }
            },
            { "data": "contato_email",
                "render": function(data, type, full, meta) {
                    return '<a href="mailto:' + full.contato_email + '?">'+ full.contato_email +'</a>';
                }
            },
            { "data": "status" ,
            render: function (data, type, row) { 
                return "<span class=\"badge badge-pill badge-"+(data == 1 ? 'success' : 'danger')+" \">"+
                (data == 1 ? 'Ativo' : 'Inativo')+"</span>"
                ; 
            }
            },
              {
                "render": function ( data, type, row, meta ) {                    
                return  '<div class="btn-group" role="group" aria-label="Basic example">'+
                          '<button type="button" data-bs-toggle="modal" data-bs-target="#myModal" class="btn btn-inverse-dark btn-icon" title="Visualizar" id="btnShow"><i class=" mdi mdi-eye "></i></button>'+
                          '<button type="button" class="btn btn-inverse-dark btn-icon" title="Editar" id="btnUpdate"><i class="mdi mdi-pencil "></i></button>'+
                          '<button type="button" class="btn btn-inverse-dark btn-icon" title="'+(row.status === 1 ? 'Inativar' :'Ativar')+'" id="btnStatus"><i class="mdi mdi-'+(row.status === 1 ? 'account-cancel' : 'account-check' )+'"></i></button>'+
                          '<button type="button" class="btn btn-inverse-dark btn-icon" title="Apagar" id="btnDelete"><i class="mdi mdi-delete"></i></button>'+
                        '</div>';
                }      
              }
          ],
          "columnDefs": [
            { className: "text-center", "targets": [ 2 ] },
            { className: "text-center", "targets": [ 3 ] },
            { className: "text-center", "targets": [ 4 ] },
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
                      text: "<span class=\"material-icons\">\<i class\=\"mdi mdi-plus\"\></i\></span>Novo",
                      action: function ( e, dt, node, config ) {
                          $('#formModal')[0].reset();
                          $('#id').val('0');
                          $("#myModal").modal("show");
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
                  }
              ],
          },
        //   "search": {"search" : '@php echo date("m/Y") @endphp' },
          "order": [[ 0, "asc" ]],
          //"deferLoading": 57,
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
                    name            : $("#name").val(),
                    agencia         : $("#agencia").val(),
                    conta           : $("#conta").val(),
                    codigo          : $("#codigo").val(),
                    contato_name    : $("#contato_name").val(),
                    contato_telefone: $("#contato_telefone").val(),
                    contato_celular : $("#contato_celular").val(),
                    contato_email   : $("#contato_email").val(),
                    bank_principal  : $("#bank_principal").val(),
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

          var id  = $(this).parents('tr').find("td:eq(0)").text();
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
                  $("#agencia").val(result.data.agencia);
                  $("#conta").val(result.data.conta);
                  $("#codigo").val(result.data.codigo);
                  $("#contato_name").val(result.data.contato_name);
                  $("#contato_telefone").val(result.data.contato_telefone);
                  $("#contato_celular").val(result.data.contato_celular);
                  $("#contato_email").val(result.data.contato_email);
                  $("#bank_principal").val(result.data.bank_principal);

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

          var id  = $(this).parents('tr').find("td:eq(0)").text();
          let _url = `{{ @url()->current() }}/${id}`;

          $.ajax({
              url: _url,
              type: "GET",
              success: function(result) {
                  $('#formModal')[0].reset();
                  
                  $("#id").val(result.data.id);
                  $("#name").val(result.data.name);
                  $("#agencia").val(result.data.agencia);
                  $("#conta").val(result.data.conta);
                  $("#codigo").val(result.data.codigo);
                  $("#contato_name").val(result.data.contato_name);
                  $("#contato_telefone").val(result.data.contato_telefone);
                  $("#contato_celular").val(result.data.contato_celular);
                  $("#contato_email").val(result.data.contato_email);
                  $("#bank_principal").val(result.data.bank_principal);


                  $("#action").show();
                  $("#myModal").modal("show");

              }
          });

      });

        // Status
        $("#datatable").on("click", "#btnStatus", function () {

        var id  = $(this).parents('tr').find("td:eq(0)").text();
        let _url = `{{ @url()->current() }}/${id}`;

        $.ajax({
            url: _url,
            type: "PUT",
            success: function(result) {
                table.clear().draw();
                table.ajax.reload( null, false );
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
              
              var id  = $(this).parents('tr').find("td:eq(0)").text();
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
  
    /// cancel modal
    $( "#cancelPost" ).click(function() {
        $('#modalForm')[0].reset();
        $('#modal-id').modal('hide');
    });

});
</script>

@endpush
