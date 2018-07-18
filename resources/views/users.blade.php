<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel with Datatables - rafaelogic</title>

  @if (App::environment('local'))
  <link href="{{url('/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{url('/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
  
  @else
  <!-- Bootstrap core CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  @endif

  <link href="https://dl.dropbox.com/s/7u2aw574eb9hzph/mark.min.css" rel="stylesheet">


</head>
<body>
  <div class="container-fluid">
    <div class="d-flex flex-column bg-dark text-center p-2 mb-2 row">
      <h2 class="text-white">Users</h2>
    </div>
  </div>
  
  <div class="container">
    <table id="users-table" class="table table-striped table-bordered" style="width:100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th width="140px">Action</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th width="140px">Action</th>
            </tr>
        </tfoot>
    </table>
  </div>

  <div class="container-fluid">
      <div class="d-flex flex-column row">
        <footer class="footer bg-dark mt-2 p-3">
            <div class="text-center">
            <span class="text-white">Laravel Datatables Example - <a class="text-success" href="http://d3vt3c.com">rafaelogic</a></span>
            </div>
        </footer>
      </div>
      @include('modals')
  </div>

  @if (App::environment('local'))
  <script src="{{url('/js/jquery-3.3.1.js')}}"></script>
  <script src="{{url('/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{url('/js/mark.js')}}"></script>

  <script src="{{url('/js/pdf/pdfmake.min.js')}}"></script>
  <script src="{{url('/js/pdf/vfs_fonts.js')}}"></script>
  <script src="{{url('/js/datatables/datatables.min.js')}}"></script>
  <script src="{{url('/js/datatables/datatables.mark.js')}}"></script>
  @else
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.2/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jq-3.3.1/jszip-2.5.0/dt-1.10.18/b-1.5.2/b-colvis-1.5.1/b-html5-1.5.2/b-print-1.5.2/fc-3.2.5/fh-3.1.4/r-2.2.2/rg-1.0.3/sl-1.2.6/datatables.min.js"></script>  
  <script type="text/javascript" src="https://cdn.datatables.net/plug-ins/1.10.13/features/mark.js/datatables.mark.js"></script>  
  <script type="text/javascript" src="https://cdn.jsdelivr.net/g/mark.js(jquery.mark.min.js),datatables.mark.js"></script>
  @endif

  <script src="https://dl.dropbox.com/s/mx3s198q3dmzs3i/app.js"></script>
  <script>
    $(document).ready(function() {
    var table = $('#users-table').DataTable( {
        processing: true,
        serverSide: true,
        mark: true,
        ajax: {
            "url": "/users",
            "dataType": "json",
            "type": "POST",
            "data": {
                "_token": "<?= csrf_token(); ?>"
            }
        },
        columns: [
            {"data": "number","searchable":false,"orderable":false},
            {"data": "name"},
            {"data": "email"},
            {"data": "created_at","searchable":false},
            {"data": "updated_at","searchable":false},
            {"data": "action","searchable":false,"orderable":false},
        ],
        dom: '<"d-flex flex-wrap justify-content-center" <"col-md-6"l> <"col-md-6"f>>  <"d-flex flex-wrap justify-content-center"Br>  <"d-flex flex-column"<"d-flex flex-row justify-content-between"ip> t <"d-flex flex-row justify-content-between"ip>>  ',
        buttons: [
            'copy',
            'colvis',
            'excel',
            'pdf',
            'print',
        ]
    });
});
  </script>
</body>
</html>