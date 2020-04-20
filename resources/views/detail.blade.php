<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Data Rekap</title>

   <!-- Custom fonts for this template-->
  <link href="{{ URL::to('/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="{{ URL::to('/vendor/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ URL::to('/css/sb-admin.css') }}" rel="stylesheet">
  <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body id="page-top">

  <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="#">Admin Pemilihan Rektor</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

   
  </nav>

  <div id="wrapper">

       <ul class="sidebar navbar-nav">
 <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('/main/home') }}"  >
    <i class="fas fa-gavel"></i>

          <span>Senat</span></a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('/candidate') }}">
          <i class="fas fa-fw fa-vote-yea"></i>
          <span>Kandidat</span>
        </a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('/rekap') }}">
          <i class="fa fa-trophy"></i>
          <span>Ranking</span>
        </a>
      </li>


 <li class="nav-item active">
        <a class="nav-link" href="{{ URL::to('/detail') }}">
          <i class="fas fa-fw fa-chart-area"></i>
          <span>Rekap</span></a>
      </li>


      <li class="nav-item">
        <a class="nav-link" href="{{ URL::to('/main/logout') }}">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Keluar</span></a>
      </li>
    </ul>

    <div id="content-wrapper">

      <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Rekap</li>
        </ol>
        
        <button type="button" id="download" class="btn btn-primary"   style="margin: 10px">
          <i class="fa fa-download"> Download</i> 
        </button>
       
     

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Penilai</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                      <th width="20%">Nama Kandidat</th>
                      <th width="20%">Nama Senat</th>
                      <th>Leadership Of Change</th>
                      <th >Entrepreneurship</th>
                      <th>Strategic Orientation</th>
                      <th>Action Manegement</th>
                      <th>Networking</th>
                      <th>Organization Climate Development</th>
                      <th>Personal Value</th>
                      <th>Future Orientation</th>
                      <th>Digital Mastery</th>
                      <th>Global Perspective</th>
                      <th>Nilai Total</th>
                  </tr>
                </thead>
               
              </table>
            </div>
          </div>
         
        </div>

      

      </div>
      <!-- /.container-fluid -->

      <!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright ©Lintang Prayogo</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 







  <!-- Bootstrap core JavaScript-->
  <script src="{{URL::to('vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{URL::to('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{URL::to('vendor/jquery-easing/jquery.easing.min.js')}}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{URL::to('js/sb-admin.min.js')}}"></script>
  <script src="//code.jquery.com/jquery.js"></script>
        <!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



</body>
<script type="text/javascript">


 $('#myTable').DataTable({
        processing: true,
        serverSide: true,
          ajax: {
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                url: '{!! route('detail.score') !!}',
                type: 'GET',
            },
        columns: [
            { data: 'candidate', name: 'candidate' },
            { data: 'user', name: 'user' },
            { data: 'leadership', name: 'leadership' ,searchable:false},
            { data: 'entrepreneurship', name: 'entrepreneurship' ,searchable:false},
            { data: 'strategic', name: 'strategic' ,searchable:false},
            { data: 'manegement', name: 'manegement' ,searchable:false},
            { data: 'networking', name: 'networking' ,searchable:false},
            { data: 'organization', name: 'organization' ,searchable:false},
            { data: 'personal', name: 'personal' ,searchable:false},
            { data: 'future', name: 'future' ,searchable:false},
            { data: 'digital', name: 'digital' ,searchable:false},
            { data: 'global', name: 'global' ,searchable:false},
            { data: 'total', name: 'total' ,searchable:false},


        
        ]
    });

 $("#download").click(function() {
     window.location.href = "{{ URL::to('/rekap/exportDetail') }}";
   });

</script>
</html>
