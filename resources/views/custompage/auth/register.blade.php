@extends('dashboard.template.app')
@section('title','Manage User')

<!-- content -->
@section('content')
<section id="basic-horizontal-layouts">
<div class="row">
    <div class="col-md col-12">
        <div class="card">
            
            <div class="card-header">
                <h4 class="card-title">Registrasi</h4>
            </div>
            <div class="card-body">
                <!-- alert -->
                @if ($message = Session::get('sukses'))
                
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{{ $message }}</strong>
                </div>
                @endif
                <!-- end alert -->
                <form class="form form-horizontal" action="{{ url('manageuser/register') }}" id="register" method="post">
                    @method('POST')
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="first-name">Nama</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="text" id="first-name" class="form-control required" name="nama" requ placeholder="First Name">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="email-id">Email</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="email" id="email-id" class="form-control required" name="email" placeholder="Email">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="contact-info">No hp</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" id="nomor_hp" class="form-control required" name="nomor_hp" placeholder="Mobile">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="contact-info">Kode pos</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="number" id="kode_pos" class="form-control required" name="kode_pos" placeholder="Mobile">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="contact-info">Jenis kelamin</label>
                                </div>
                                <div class="col-sm-9">
                                <div class="custom-control custom-radio my-50">
                                    <input type="radio" id="validationRadiojq1" name="jenis_klamin" value="L" class="custom-control-input">
                                    <label class="custom-control-label" for="validationRadiojq1">L</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="validationRadiojq2" name="jenis_klamin" value="P"  class="custom-control-input">
                                    <label class="custom-control-label" for="validationRadiojq2">P</label>
                                </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" id="password" class="form-control required" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" id="f" class="form-control required" name="password_confirm" placeholder="Password">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group row">
                                <div class="col-sm-3 col-form-label">
                                    <label for="contact-info">Alamat</label>
                                </div>
                                <div class="col-sm-9">
                                   
                                    <textarea class="form-control  required" id="alamat" name="alamat" rows="3"></textarea>

                                </div>
                            </div>
                        </div>
                       
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn submit-button btn-primary mr-1 waves-effect waves-float waves-light">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
@endsection
<!-- js -->
@section('js')
<script src="app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<!-- script -->
<script type="text/javascript">

  $(function () {



      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    if ($("#register").length > 0) {
            $("#register").validate({
                rules: {
             
                    jenis_klamin: "required",
               password :{
                   required: true,
                   minlength: 5
               },
               password_confirm : {
                    minlength : 5,
                    equalTo : "#password"
                }
           },
           highlight: function (element) {
               $(element).parent().addClass('error')
           },
           unhighlight: function (element) {
               $(element).parent().removeClass('error')
           },
           onsubmit: true
                
            })
        }





  });

</script>


@endsection