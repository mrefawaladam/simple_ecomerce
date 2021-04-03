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
              <!-- alert -->
              @if ($message = Session::get('peringatan'))
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Eror</h4>
                    <div class="alert-body">
                    {{ $message }}
                    </div>
                </div>
                @endif
                <!-- end alert -->
            <table class="table table-striped data-table" id="datatable-tabletools" >
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Transaksi</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Menu</th>
                        <th>Ingredients</th>
                        <th>Add On</th>

                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($transaksi as $tr)
                    <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tr->kode_transaksi }}</td>
                    <td>{{ $tr->name }}</td>
                    <td>{{ $tr->alamat }}</td>

                    <td>
                        <?php
                        $menu = DB::table('tb_order_menu')
                        ->join('tb_menu', 'tb_order_menu.menu_id', '=', 'tb_menu.id_menu')
                        ->where('tb_order_menu.transaksi_id',$tr->id_transaksi)
                        ->get();
                        ?>
                        <ol>
                        @foreach($menu as $a)
                            <li>{{ $a->nama }}</li>
                        @endforeach
                        </ol>
                    </td>
                    
                    <td>
                        <?php
                        $addOn = DB::table('tb_order_ingredients')
                        ->join('tb_ingredients', 'tb_order_ingredients.ingredients_id', '=', 'tb_ingredients.id_ingredients')
                        ->where('tb_order_ingredients.transaksi_id',$tr->id_transaksi)
                        ->get();
                        ?>
                        <ol>
                        @foreach($addOn as $a)
                            <li>{{ $a->nama }}</li>
                        @endforeach
                        </ol>
                    </td>
                    <td>
                        <?php
                        $addOn = DB::table('tb_order_addon')
                        ->join('tb_add_on', 'tb_order_addon.add_on_id', '=', 'tb_add_on.id_add_on')
                        ->where('tb_order_addon.transaksi_id',$tr->id_transaksi)
                        ->get();
                        ?>
                        <ol>
                        @foreach($addOn as $a)
                            <li>{{ $a->nama }}</li>
                        @endforeach
                        </ol>
                    </td>
                    @if($tr->status == 'kirim')
                        <td>barang sudah kirim</td>
                    @else
                        <td><a href="{{ url('transaksi/kirim/'.$tr->id_transaksi) }}">kirim</a></td>
                    @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>  
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
    <script>
    $(document).ready(function() {
        $('#datatable-tabletools').DataTable();
    } );
    </script>
@endsection