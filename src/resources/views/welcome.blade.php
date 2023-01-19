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
        <!-- <link href="{{ asset('css/jquery-datatable.min.css') }}" rel="stylesheet"> -->
        <link href="{{ asset('css/dataTables.bootstrap5.min.css') }}" rel="stylesheet">
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

                        <table id="example" class="display dataTable table table-bordered table-striped table-hover" aria-describedby="example_info">
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
                              <td valign="top" colspan="6" class="dataTables_empty">Loading...</td>
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
    <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap5.min.js') }}"></script>
    <script>
        function filterColumn(i) {
            $('#example')
                .DataTable()
                .column(i)
                .search(
                    $('#col' + i + '_filter').val(),
                    false,
                    true
                )
                .draw();
        }
        document.addEventListener('DOMContentLoaded', function () {
            let table = new DataTable('#example', {
                dom: 'lrtip',
                ordering: false,
                "processing": true,
                "serverSide": true,
                "ajax": '{!! url('getRecords') !!}',
                columns: [
                    { data: 'product_key' },
                    { data: 'notes' },
                    { data: 'qty' },
                    { data: 'cost' },
                    { data: 'price' }
                ]
            } );
            $('input.column_filter').on('keyup click', function () {
                filterColumn($(this).parents('tr').attr('data-column'));
            });
        } );
    </script>
</html>
