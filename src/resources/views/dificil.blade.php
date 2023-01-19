<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

        <style>
          .dataTables_paginate{
              display: inline-block;
              margin:0 auto;
              /*float: left;*/
          }
          .dataTables_info{
              display: inline-block;
              margin:0 auto !important;
              float: left;
          }
        </style>        
    </head>
    <body>
        <div class="container">
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 p-2 my-2">
                <div class="card">
                  <div class="body">
                    <div class="table-responsive">
                      <div id="example_wrapper" class="dataTables_wrapper text-center p-2">
                        <table cellpadding="3" cellspacing="0" border="0" style="width: 67%; margin: 0 auto 2em auto;">
                          <thead>
                              <tr>
                                  <th>Target</th>
                                  <th>Search text</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr id="filter_col1" data-column="0">
                                  <td>Column - product_key</td>
                                  <td align="center">
                                    <input type="text" class="column_filter" id="col0_filter">
                                  </td>
                              </tr>
                              <tr id="filter_col2" data-column="1">
                                  <td>Column - notes</td>
                                  <td align="center">
                                    <input type="text" class="column_filter" id="col1_filter">
                                  </td>
                              </tr>
                          </tbody>
                        </table>
                        <div class="dataTables_length" id="example_length">
                          <label>Show
                            <select id="miSelect" name="example_length" aria-controls="example" class="form-select form-select-sm">
                              <option value="10">10</option>
                              <option value="25">25</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select> entries
                          </label>
                        </div>
                        <table id="example" class="table table-bordered table-striped table-hover" aria-describedby="example_info">
                          <thead>
                              <tr>
                                <th scope="col">product_key</th>
                                <th scope="col">notes</th>
                                <th scope="col" class="no_search">qty</th>
                                <th scope="col" class="no_search">cost</th>
                                <th scope="col" class="no_search">price</th>
                              </tr>
                          </thead>
                          <tbody>
                            <tr class="odd">
                              <td valign="top" colspan="6" class="dataTables_empty">
                                <div class="spinner-grow text-primary" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-secondary" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-success" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th scope="col">product_key</th>
                              <th scope="col">notes</th>
                              <th scope="col" class="no_search">qty</th>
                              <th scope="col" class="no_search">cost</th>
                              <th scope="col" class="no_search">price</th>
                            </tr>
                          </tfoot>
                        </table>
                        <table id="preloader" class="d-none table table-bordered table-striped table-hover" aria-describedby="example_info">
                          <thead>
                              <tr>
                                <th scope="col">product_key</th>
                                <th scope="col">notes</th>
                                <th scope="col" class="no_search">qty</th>
                                <th scope="col" class="no_search">cost</th>
                                <th scope="col" class="no_search">price</th>
                              </tr>
                          </thead>
                          <tbody>
                            <tr class="odd">
                              <td valign="top" colspan="6" class="dataTables_empty">
                                <div class="spinner-grow text-primary" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-secondary" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                                <div class="spinner-grow text-success" role="status">
                                  <span class="visually-hidden">Loading...</span>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th scope="col">product_key</th>
                              <th scope="col">notes</th>
                              <th scope="col" class="no_search">qty</th>
                              <th scope="col" class="no_search">cost</th>
                              <th scope="col" class="no_search">price</th>
                            </tr>
                          </tfoot>
                        </table>
                        <div id="paginator">
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script>
        let page = '';
        let searchUno = '';
        let searchDos = '';
        let perPage = '';
        let controladorTiempo = '';

        function addPreloader(){
            $('#example').addClass("d-none");
            $('#preloader').removeClass("d-none");
        }

        function removePreloader(){
            $('#preloader').addClass("d-none");
            $('#example').removeClass("d-none");
        }

        function llamadaAjax(){

            addPreloader();

            const pageQuery = (page) ? page : "";
            
            const searchUnoQuery = (searchUno) ? searchUno : "";

            const searchDosQuery = (searchDos) ? searchDos : "";
              
            const perPageQuery = (perPage) ? perPage : "";

            const params = {'page': pageQuery, 'searchUno': searchUnoQuery, 'searchDos': searchDosQuery, 'per_page': perPageQuery};

            const queryString = new URLSearchParams(params).toString();

            console.log(queryString);

            $.ajax({
              type: 'GET',
              url: '{!! url('getRecordsDificil') !!}',
              data: queryString,
            })
            .done(function(respuesta){
              console.log(respuesta);
              createColumn(respuesta.data);
              createPaginator(respuesta);
            })
            .fail(function( jqXHR, textStatus, errorThrown ) {
                console.log('jqXHR');
                console.log(jqXHR);
                console.log('textStatus');
                console.log(textStatus);
                console.log('errorThrown');
                console.log(errorThrown);
            });
        }

        function createColumn(data) {
          var htmlTags = '';
          
          data.forEach((valor, index) => {
              htmlTags += '<tr>'+
                          '<td>' + valor.product_key + '</td>'+
                          '<td>' + valor.notes + '</td>'+
                          '<td>' + valor.qty + '</td>'+
                          '<td>' + valor.cost + '</td>'+
                          '<td>' + valor.price  + '</td>'+
                        '</tr>';
          });
          console.log(data);
          $('#example tbody').empty();
          $('#example tbody').append(htmlTags);
          removePreloader();
        }

        function createPaginator(data) {
          $('#paginator').empty();
          var conteo = `<div class="dataTables_info" id="example_info" role="status" aria-live="polite">Showing ${data.from} to ${data.to} of ${data.total} entries</div>`;
          console.log(data);
          const disabledPrevius = (data.current_page == 1) ? 'disabled' : '';
          const disabledNext = (data.current_page == data.last_page) ? 'disabled' : '';
          const activeFirst = (data.current_page == 1) ? 'active' : '';
          const activeLast = (data.current_page == data.last_page) ? 'active' : '';
          const prev = data.current_page-1;
          const next = data.current_page+1;
          var ciclo = [];
          var paginado = '';

          var inicioPag =
          `<div class="dataTables_paginate paging_simple_numbers" id="example_paginate">
            <ul class="pagination">
              <li class="paginate_button page-item previous ${disabledPrevius}" id="example_previous">
                <a aria-controls="example" tabindex="0" onclick="irAPage(${prev})" class="page-link" ${disabledPrevius} >Previous</a>
              </li>
              <li class="paginate_button page-item ${activeFirst}">
                <a aria-controls="example" tabindex="0" onclick="irAPage(1)" class="page-link">1</a>
              </li>
              `;
          if (data.current_page >= 1 && data.current_page <= 3) {
            ciclo = [2,3,4,'...'];
          }else if(data.current_page >= 4 && data.current_page <= data.last_page-3){
            ciclo = ['...',data.current_page-1,data.current_page,data.current_page+1,'...'];
          }else if(data.current_page >= data.last_page-3 && data.current_page <= data.last_page){
            ciclo = ['...',data.last_page-3,data.last_page-2,data.last_page-1];
          };
          var midlePag = '';
          ciclo.forEach((valor, index) => {
            const activeActual = (data.current_page == valor) ? 'active' : '';
            const aPage = 
              `
              onclick="irAPage(${valor})"
              `;
            if (valor == '...') {
              midlePag +=
                `
                <li class="paginate_button page-item disabled">
                  <a aria-controls="example" tabindex="0" class="page-link">...</a>
                </li>
                `
            }else{
              midlePag +=
                `
                <li class="paginate_button page-item ${activeActual}">
                  <a aria-controls="example" ${aPage} tabindex="0" class="page-link">${valor}</a>
                </li>
                `
            };

          })
          
          var finalPag =
              `
              <li class="paginate_button page-item ${activeLast}">
                <a aria-controls="example" tabindex="0" onclick="irAPage(${data.last_page})" class="page-link">${data.last_page}</a>
              </li>
              <li class="paginate_button page-item next ${disabledNext}" id="example_next">
                <a aria-controls="example" tabindex="0" onclick="irAPage(${next})" class="page-link" ${disabledNext} >Next</a>
              </li>
            </ul>
          </div>`
          paginado = inicioPag + midlePag + finalPag;
          $('#paginator').append(conteo);
          $('#paginator').append(paginado);
        }
        
        function irAPage(num){
          page = num;
          clearTimeout(controladorTiempo);
          controladorTiempo = setTimeout(llamadaAjax, 250);
        }

        document.addEventListener('DOMContentLoaded', function () {

            llamadaAjax();

            const select = $("#miSelect");

            select.change(function (){
              perPage = $("#miSelect :selected").val();
              page = '';
              clearTimeout(controladorTiempo);
              controladorTiempo = setTimeout(llamadaAjax, 250);
            });

            $('input#col0_filter').on('keyup', function () { //click
                console.log($(this).val());
              
                searchUno = $(this).val();
                page = '';
                clearTimeout(controladorTiempo);
                controladorTiempo = setTimeout(llamadaAjax, 250);
                // llamadaAjax();
              
            });
            $('input#col1_filter').on('keyup', function () { //click
                console.log($(this).val());
                
                searchDos = $(this).val();
                page = '';
                clearTimeout(controladorTiempo);
                controladorTiempo = setTimeout(llamadaAjax, 250);
                // llamadaAjax();
                
            });
        } );
    </script>
</html>
