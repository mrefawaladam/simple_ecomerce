@extends('dashboard.template.app')
@section('title','Manage User')
<!-- css -->
@section('css')
<!-- link -->
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/buttons.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/tables/datatable/rowGroup.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('app-assets/vendors/css/pickers/flatpickr/flatpickr.min.css') }}">
 
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-validation.css">
@endsection
<!-- content -->
@section('content')
<section id="basic-datatable">
<div class="row">
    <div class="col-12">
        <div class="card">
            
        <div class="card-header border-bottom p-1">
            <div class="head-label"><h6 class="mb-0">Manage Admin</h6></div>
            <button type="button" id="createNewData" class="btn btn-gradient-primary">Tambah Data</button>
        </div>
                
            <div class="table-responsive">
            <div class="container">
            <table class="table table-striped data-table" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Nomor Hp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            </div>  
            </div>

        </div>     
    </div>
</div>

                    
      
<!-- modal -->
<div class="modal fade" id="ajaxModel" aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" id="modelHeading">Manage User</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>

            <div class="modal-body">
<!-- form -->
                <form id="productForm" name="productForm" class="form-horizontal">
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                        <input type="text" class="form-control dt-full-name required" id="nama" name="nama" required="">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Kode Post</label>
                        <input type="number" id="kode_pos" class="form-control dt-post required" name="kode_pos">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">No hp</label>
                        <input type="number" id="nomor_hp" class="form-control  required dt-post" name="nomor_hp">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-email">Email</label>
                        <input type="text" id="email" class="form-control required dt-email" name="email">
                        
                    </div>
                    <input type="hidden" name="data_id" id="data_id">

                    <!-- <div class="form-group">
                        <label class="d-block">Gender</label>
                        <div class="custom-control custom-radio my-50">
                            <input type="radio" id="validationRadiojq1" name="jenis_klamin" class="custom-control-input">
                            <label class="custom-control-label" for="validationRadiojq1">L</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="validationRadiojq2" name="jenis_klamin" class="custom-control-input">
                            <label class="custom-control-label" for="validationRadiojq2">P</label>
                        </div>
                    </div> -->
                    <div class="form-group">
                    <label class=" control-label">Jenis kelamin</label>
  
                        <select name="jenis_klamin" id="jenis_klamin" class="form-control">
                            <option value="L">L</option>
                            <option value="P">P</option>
                        </select>
                   
                    </div>
                    <div class="form-group">
                            <label class="d-block" for="alamat">Alamat</label>
                            <textarea class="form-control required required" id="alamat" name="alamat" rows="3"></textarea>
                    </div>
  <!-- end form  -->
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save
                     </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- js -->
@section('js')
<!-- link -->
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/responsive.bootstrap4.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
    <script src="{{ asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
    <script src="app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- script -->
<script type="text/javascript">
    $('#pesan-error,#pesan-sukses').hide()
  $(function () {



      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });



    var table = $('.data-table').DataTable({

        processing: true,

        serverSide: true,

        ajax: "{{ route('manageuser.index') }}",

        columns: [

            {data: 'DT_RowIndex', name: 'DT_RowIndex'},

            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'nomor_hp', name: 'nomor_hp'},

            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });



    $('#createNewData').click(function () {

        $('#saveBtn').html("Save");
        $('#data_id').val('');
        $('#productForm').trigger("reset");
        $('#modelHeading').html("Tambah Data Admin");
        $('#gusername,#gpassword').hide()
        $('#ajaxModel').modal('show');

    });



    $('body').on('click', '.editData', function () {

      var data_id = $(this).data('id');

      $.get("{{ route('manageuser.index') }}" +'/' + data_id +'/edit', function (data) {

          $('#modelHeading').html("Edit User");
          $('#saveBtn').html("update");
          $('#tanggal').val(data.tanggal);

          $('#ajaxModel').modal('show');

          $('#data_id').val(data.id);
          $('#nama').val(data.name);
          $('#alamat').val(data.alamat);
          $('#kode_pos').val(data.kode_pos);
          $('#nomor_hp').val(data.nomor_hp);
          $('#email').val(data.email);
          $('#jenis_klamin').val(data.jenis_klamin);

      })

   });



        if ($("#productForm").length > 0) {
            $("#productForm").validate({

                submitHandler: function(form) {

                    var actionType = $('#btn-save').val();
                    $('#btn-save').html('Sending..');

                           $.ajax({

                    data: $('#productForm').serialize(),

                    url: "{{ route('manageuser.store') }}",

                    type: "POST",

                    dataType: 'json',

                    success: function (data) {




                        if(data.status == 'sukses'){
                        $('#ajaxModel').modal('hide');
                        swal("Selamat", data.pesan , "success");
                        $('#productForm').trigger("reset");

                        table.draw();

                        }else{
                        $('#pesan-error').html(data.pesan).show()
                        }

                    },

                    error: function (data) {

                        console.log('Error:', data);

                        $('#saveBtn').html('Save Changes');

                    }

                });


                }
            })
        }





    $('body').on('click', '.deleteData', function () {



        var data_id = $(this).data("id");


  swal({
      title: "Apa kamu yakin?",
      text: "Menghapus data ini!",
      icon: "warning",
      buttons: [
        'Tidak',
        'Iya'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
        swal({
          title: 'Selamat!',
          text: 'Data berhasil di hapus!',
          icon: 'success'
        }).then(function() {
            $.ajax({

                type: "DELETE",

                url: "{{ route('manageuser.store') }}"+'/'+data_id,

                success: function (data) {
                    table.draw();

                },

                error: function (data) {

                    console.log('Error:', data);

                }

            });
        });
      } else {
        swal("Cencel", "Data tidak jadi dihapus :)", "error");
      }
    })


    });



  });

</script>

@endsection