@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => $set['title'] ])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">{{ $set['title'] }}</h4>
                <p class="card-category"> Conciliação Bancária</p>
              </div>

            <div class="card-body">

                <div class="row">
                  
                </div>
                <form id="forms" action="#" class="needs-validation" novalidate>
                    @csrf
                    <div class="form-row">
                        <div class="col-md-3 mb-3">
                            <label for="dt_ini">Data Inicial</label>
                            <input type="date" name="dt_ini" class="form-control text-uppercase" id="dt_ini" placeholder="" value="{{$request->dt_ini?? date('Y-m-01') }}" >
                        </div>
                        <div class="col-md-3 mb-3">
                        <label for="dt_fim">Data Final</label>
                            <input type="date" name="dt_fim" class="form-control text-uppercase" id="dt_fim" placeholder="" value="{{$request->dt_fim?? date('Y-m-t')}}" >
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="dt_ini">Saldo Inicial</label>
                            <input type="text" name="sd_ini" class="form-control text-uppercase" id="sd_ini" placeholder="" value="{{$request->sd_ini = 0  ? "0" : $dados->saldo }}" >
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit" id="formsCashflow" >Pesquisar</button>
                    
                </form>
                <hr>
                <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatable" >
                        <thead class=" text-primary">
                            <tr>
                                <td scope=""><input type="checkbox" id="ckbCheckAll" /></td>
                                <th scope="">Seq</th>
                                <th scope="col-3">Vencto</th>
                                <th scope="col-2">Recebimento</th>
                                <th scope="col-1">Pagamento</th>
                                <th scope="col-1">Saldo</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td scope=""></td>
                                <th scope=""></th>
                                <th scope="col-3">Total</th>
                                <th scope="col-2" id="receitas"></th>
                                <th scope="col-1" id="despesas"></th>
                                <th scope="col-1"></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')

<script>
  
$(document).ready(function() {    
    
    var table = $('#datatable').DataTable( {
          "columns": [
                {
                    "className"     : 'details-control',
                    "orderable"     : false,
                    "data"          : null,
                    "defaultContent": ''
                },
                { "data": "seq" },
                { "data": "date", 
                    render: function (data, type, row) { 
                        if ( data == null  ) {
                            return data;
                        }
                    return moment(data).format('DD/MM/YYYY'); 
                }
              },
              
              { "data": "receitas" },
              { "data": "despesas" },
              { "data": "saldo" },
          ],
          "columnDefs": [
                {
                    orderable   : false,
                    className   : 'select-checkbox',
                    targets     : [ 0 ]
                },
                { className: "text-center", "targets": [ 1 ] },
                { className: "text-center", "targets": [ 2 ] },
                { className: "text-right", "targets": [ 3 ] },
                { className: "text-right", "targets": [ 4 ] },
                { className: "text-right", "targets": [ 5 ] },
          ],
        select: {
            style:    'os',
            selector: 'td:first-child'
        },
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
                  },
                  {
                        attr:  { id: 'action' },
                        text: 
                            "<div class\=\"btn-group\"\>"+
                                "\<button type\=\"button\" class\=\"btn btn-outline-secondary dropdown-toggle\" data-bs-toggle\=\"dropdown\"\>Ações\<\/button\>"+
                                "\<div class\=\"\dropdown-menu\"\>"+
                                    "\<a class\=\"dropdown-item\"\>Go back<\/a\>"+
                                    "\<a class\=\"dropdown-item\">Delete<\/a\>"+
                                    "\<a class\=\"dropdown-item\">Swap</a\>"+
                                "\<div\>"+
                            "\</div\>",
                        action: function ( e, dt, node, config ) {
                            alert("entrou...");
                            // table.clear().draw();
                            // table.ajax.reload( null, false );
                        },
                        //className: 'btn-primary'
                  },
                  


              ],
          },
          //"search": {"search" : '@php echo date("m/Y") @endphp' },
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

      $("#forms").on('click', '#formsCashflow', function(event) {
          event.preventDefault();
          let href = `{{ @url()->current() }}`;
          $.ajax({
                url: href,
                type: "post",
                data: { 
                    dt_ini  : $("#dt_ini").val(),
                    dt_fim  : $("#dt_fim").val(),
                    sd_ini  : $("#sd_ini").val(),
                    type    : $("#type").val()
                },
              beforeSend: function() {
                  $('#loader').show();
              },
              // return the result
              success: function(result) {
                table.clear().draw();
                table.rows.add(result.data).draw();
                var receitas = 1512.13; //$("#datatable").DataTable().column(4).data().sum();
                var despesas = 1215.1; //$("#datatable").DataTable().column(5).data().sum();
                $("#receitas").html( receitas.toLocaleString('de-DE', {
                        maximumFractionDigits: 2,
                        style: 'currency',
                        currency: 'EUR'
                    }) 
                );
                $("#despesas").html( despesas.toLocaleString('de-DE', {
                        maximumFractionDigits: 2,
                        style: 'currency',
                        currency: 'EUR'
                    }) 
                );
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

        $('#datatable tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );

            if ( row.child.isShown() ) {
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                row.child( format(row.data()) ).show();
                tr.addClass('shown');
            }
        } );

        function format ( rowData ) {
            var div = $('<div/>')
                .addClass( 'loading' )
                .text( 'Aguarde...' );

            $.ajax( {
                url: '{{ @url()->current() }}/detail',
                type: "post",
                data: {
                    due: rowData.date,
                },
                dataType: 'json',
                success: function ( result ) {

                var cycleArr = result.data; 
                var strTable = '<table class = \"table table-striped table-hover dataTable no-footer\">';
                strTable += "<tr>";
                strTable += '<th class=\" text-center\">' +'ID'+ '</th>'; 
                strTable += '<th class=\" text-center\">' +'Vencimento'+ '</th>'; 
                strTable += '<th class=\" text-right\">' + 'Receitas' + '</th>'; 
                strTable += '<th class=\" text-right\">' + 'Despesas' + '</th>'; 
                strTable += '<th class=\" text-left\">' + 'Cliente/Fornecedor' + '</th>'; 
                strTable += "</tr>";
                for(var i = 0; i < cycleArr.length; i++) {
                    strTable += "<tr>";
                    strTable += '<td class=\" text-center\">' + cycleArr[i]["id"] + '</td>'; 
                    strTable += '<td class=\" text-center\">' + cycleArr[i]["month"] + '</td>'; 
                    strTable += '<td class=\" text-right\">' + cycleArr[i]["receitas"] + '</td>'; 
                    strTable += '<td class=\" text-right\">' + cycleArr[i]["despesas"] + '</td>'; 
                    strTable += '<td class=\" text-left\">' + cycleArr[i]["favorecido"] + '</td>'; 
                    strTable += "</tr>";
                }
                strTable += '</table>'; 


                    div
                        .html(strTable )
                        .removeClass( 'loading' );
                }
            } );
        
            return div;
        }

        $("#ckbCheckAll").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });


});
</script>

@endpush

