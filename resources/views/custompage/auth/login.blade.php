@extends('dashboard.template.app')
@section('title','Manage User')

<!-- content -->
@section('content')
<section id="basic-horizontal-layouts">
<div class="row">
    <div class="col-md-6 col-12">
        <div class="card">
            
            <div class="card-header">
                <h4 class="card-title">Registrasi</h4>
            </div>
            <div class="card-body">
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
                <form class="form form-horizontal" action="{{ url('manageuser/login') }}" id="register" method="post">
                    @method('POST')
                    @csrf
                    <div class="row">
                       
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
                                    <label for="password">Password</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="password" id="password" class="form-control required" name="password" placeholder="Password">
                                </div>
                            </div>
                        </div>
                      
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn submit-button btn-primary mr-1 waves-effect waves-float waves-light">Login</button>
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