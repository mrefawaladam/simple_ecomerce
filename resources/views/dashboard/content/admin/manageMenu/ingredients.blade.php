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
                        <th>Harga</th>
                        <th>Foto</th>
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
                <form id="dataForm" name="dataForm" action="javascript:void(0)" enctype="multipart/form-data" class="form-horizontal">\
                <input type="hidden" name="data_id" id="data_id">

                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-fullname">Nama</label>
                        <input type="text" class="form-control dt-full-name required" id="nama" name="nama" required="">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="basic-icon-default-post">Harga</label>
                        <input type="number" id="harga" class="form-control dt-post required" name="harga">
                    </div>
                    <div class="form-group" >
                        <label for="name" class=" control-label">Image</label>
                        <input type="file" class="form-control"  id="image" name="image" placeholder="Masukan image jika mau mengubah password" value=""  minlength="6" >
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

        ajax: "{{ route('manageingredients.index') }}",

        columns: [

            {data: 'DT_RowIndex', name: 'DT_RowIndex'},

            {data: 'nama', name: 'nama'},
            {data: 'harga', name: 'harga'},
            {data: 'foto', name: 'foto', orderable: false, searchable: false},
            {data: 'action', name: 'action', orderable: false, searchable: false},

        ]

    });



    $('#createNewData').click(function () {

        $('#saveBtn').html("Save");
        $('#data_id').val('');
        $('#dataForm').trigger("reset");
        $('#modelHeading').html("Tambah Menu");
        $('#ajaxModel').modal('show');

    });



    $('body').on('click', '.editData', function () {

      var data_id = $(this).data('id');

      $.get("{{ route('manageingredients.index') }}" +'/' + data_id +'/edit', function (data) {

          $('#modelHeading').html("Edit Menu");
          $('#saveBtn').html("update");
          $('#tanggal').val(data.tanggal);

          $('#ajaxModel').modal('show');

          $('#data_id').val(data.id_ingredients);
          $('#nama').val(data.nama);
          $('#harga').val(data.harga);

      })

   });



   if ($("#dataForm").length > 0) {
            $("#dataForm").validate({

                submitHandler: function(form) { 
                    var formData = new FormData(form);
                    $.ajax({
                    type: 'POST',
                    url: "{{ route('manageingredients.store')}}",
                    data: formData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success: function(data)
                    {
                        
                        if(data.status == 'sukses'){
                                $('#ajaxModel').modal('hide');
                                swal("Selamat", data.pesan , "success");
                                $('#dataForm').trigger("reset");

                                table.draw();

                                }else{
                                $('#pesan-error').html(data.pesan).show()
                                }

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

                url: "{{ route('manageingredients.store') }}"+'/'+data_id,

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