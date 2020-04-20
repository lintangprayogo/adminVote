<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Data Senat</title>

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

    <a class="navbar-brand mr-1" href="{{ URL::to('/main/home') }}">Admin Pemilihan Rektor</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button>

   
  </nav>

  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="sidebar navbar-nav">
 <li class="nav-item active">
        <a class="nav-link " href="{{ URL::to('/main/home') }}"  >
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


 <li class="nav-item">
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
          <li class="breadcrumb-item active">Senat</li>
        </ol>
        
        <button type="button" class="btn btn-primary"  id="create-new-user" style="margin: 10px">
          <i class="fa fa-plus"></i> Tambah
        </button>
       
       <button type="button" class="btn btn-info"  id="upload" data-toggle="modal" data-target="#userUpload" style="margin: 10px">
          <i class="fa fa-upload"></i> Upload
        </button>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <div class="card-header">
            <i class="fas fa-table"></i>
            Data Table Senat</div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="myTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                  
                      <th width="10%">Id</th>
                      <th width="40%">Name</th>
                      <th width="40%">Email</th>
                      <th width="10%">Action</th>
            
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

 

<div class="modal fade" id="ajax-crud-modal" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="userCrudModal"></h4>
    </div>
    <div class="modal-body">
        <form id="userForm" name="userForm" class="form-horizontal">
           <input type="hidden" name="user_id" id="user_id">
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-12">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                </div>
            </div>
 
            <div class="form-group">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-12">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" value="" required="required">
                </div>
            </div>

             <div class="form-group" id="password-content">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-12">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="" required="required">
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-save" value="create">Save changes
             </button>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>



<div class="modal fade" id="userUpload" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="Upload Excel">Upload Excel</h4>
    </div>
    <div class="modal-body">
        <form  id="excelForm" name="excelForm" action="{{ URL::to('/voter/upload') }}" class="form-horizontal" enctype="multipart/form-data" method="post">
           {{ csrf_field() }}
            <div class="form-group">
                <label for="name" class="col-sm-2 control-label">File</label>
                <div class="col-sm-12">
                    <input type="File" id="file" name="file" placeholder="File"  required="required" accept="application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>
            </div>
           <div class="col-sm-offset-2 col-sm-10">
             <button type="submit" class="btn btn-primary" id="btn-upload" value="create">Upload
             </button>
            </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        
    </div>
</div>
</div>
</div>


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
                url: '{!! route('store.voter') !!}',
                type: 'GET',
            },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            {data: 'action', name: 'action', orderable: false},
         

        
        ]
    });

$('#create-new-user').click(function () {
        $('#btn-save').val("create-candidate");
        $('#user_id').val('');
        $('#userForm').trigger("reset");
        $('#userCrudModal').html("Tambah Senat Baru");
        $('#ajax-crud-modal').modal('show');
        $('#btn-save').html('Add');
        $("#password-content").show();

      });

$('body').on('click', '.edit-user', function () {
      var id = $(this).data('id');
      $.get('{{ URL::to("voter/edit/") }}/'+id, function (data) {
         $('#name-error').hide();
         $('#email-error').hide();
         $('#userCrudModal').html("Sunting Senat");
          $('#btn-save').val("edit-user");
          $('#ajax-crud-modal').show();
          $('#user_id').val(data.id);
          $('#name').val(data.name);
          $('#email').val(data.email);
          $("#password-content").hide();
          $('#btn-save').html('Simpan');
          
      })
   });

if ($("#userForm").length > 0) {
      $("#userForm").validate({
       submitHandler: function(form) {
      var actionType = $('#btn-save').val();
      var actionURL ="{{ URL::to('voter/create') }}";
      var msg ="Data Berhasil Diubah";
        var msgError ="Data Gagal Diubah";
         if(actionType=="edit-user"){
         actionURL="{{ URL::to('/voter/store/edit') }}";
         msg="Data Berhasil Diinput";
         msgError ="Data Gagal Dinput";
         }
      $('#btn-save').html('Sending..');
      $.ajax({
          data: new FormData($("#userForm")[0]),
          url: actionURL ,
          type: "POST",
          headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
          dataType: 'json',
           async: false,
          cache: false,
          contentType: false,
          enctype: 'multipart/form-data',
           processData: false,
          success: function (data) {
              $('#userForm').trigger("reset");
              $('#btn-save').html('Simpan');
              $('#ajax-crud-modal').modal('hide');
              var oTable = $('#myTable').dataTable();
              oTable.fnDraw(false);
              $('.modal-backdrop').hide();
              swal("Berhasil!",msg, "success");
         
          },
          error: function (data) {
            swal("Gagal!", msgError, "error");
              $('#btn-save').html('Simpan');
              $('.modal-backdrop').hide();
          }
      });
    }
  })
}


 var deleteVoter = function(id) {
       swal({
  title: "Apa Anda Yakin?",
  text: "Data akan dihapus dan tidak bisa dikembalikan!!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
       $.ajax({
            url: "{{ URL::to('/voter/delete')}}/"+id,
             type: "delete",
             dataType: 'json',

             headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
            success: function (data) {
            var oTable = $('#myTable').dataTable(); 
            oTable.fnDraw(false);
              swal("Selesai!", "Data Telah Berhasil Dihapus!", "success");
            },
            error: function (data) {
                  swal("Gagal!", "Gagal Menghapus Data!", "error");
            }
        });
  } 
});
    }

</script>
</html>
