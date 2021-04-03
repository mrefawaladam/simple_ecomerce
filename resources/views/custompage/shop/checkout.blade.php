@extends('dashboard.template.appEcomerce')
@section('title','Manage User')
@section('css')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/app-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/pickers/form-pickadate.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-wizard.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/ext-component-toastr.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-number-input.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/wizard/bs-stepper.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/toastr.min.css">
@endsection
<!-- content -->
@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content ecommerce-application">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Checkout</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">eCommerce</a>
                                    </li>
                                    <li class="breadcrumb-item active">Checkout
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrumb-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="grid"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="app-todo.html"><i class="mr-1" data-feather="check-square"></i><span class="align-middle">Todo</span></a><a class="dropdown-item" href="app-chat.html"><i class="mr-1" data-feather="message-square"></i><span class="align-middle">Chat</span></a><a class="dropdown-item" href="app-email.html"><i class="mr-1" data-feather="mail"></i><span class="align-middle">Email</span></a><a class="dropdown-item" href="app-calendar.html"><i class="mr-1" data-feather="calendar"></i><span class="align-middle">Calendar</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
              <!-- alert -->
              @if ($message = Session::get('sukses'))
                <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Berhasil</h4>
                    <div class="alert-body">
                    {{ $message }}
                    </div>
                </div>
                @endif
                <!-- end alert -->
                <div class="bs-stepper checkout-tab-steps">
                    <!-- Wizard starts -->
                    <div class="bs-stepper-header">
                        <div class="step" data-target="#step-cart">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="shopping-cart" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Cart</span>
                                    <span class="bs-stepper-subtitle">Your Cart Items</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#step-address">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="home" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Address</span>
                                    <span class="bs-stepper-subtitle">Enter Your Address</span>
                                </span>
                            </button>
                        </div>
                        <div class="line">
                            <i data-feather="chevron-right" class="font-medium-2"></i>
                        </div>
                        <div class="step" data-target="#step-payment">
                            <button type="button" class="step-trigger">
                                <span class="bs-stepper-box">
                                    <i data-feather="credit-card" class="font-medium-3"></i>
                                </span>
                                <span class="bs-stepper-label">
                                    <span class="bs-stepper-title">Payment</span>
                                    <span class="bs-stepper-subtitle">Select Payment Method</span>
                                </span>
                            </button>
                        </div>
                    </div>
                    <!-- Wizard ends -->

                    <div class="bs-stepper-content">
                        <!-- Checkout Place order starts -->
                        <div id="step-cart" class="content">
                            <div id="place-order" class="list-view product-checkout">
                                <!-- Checkout Place Order Left starts -->
                                <div class="checkout-items">
                                  


                                @foreach($cart as $c)
                                    <div class="card ecommerce-card">
                                        <div class="item-img">
                                            <a href="app-ecommerce-details.html">
                                                <img src="{{ asset('foto/'.$c->attributes->file) }}" alt="img-placeholder" />
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="item-name">
                                                <h6 class="mb-0">
                                                    <a href="app-ecommerce-details.html" class="text-body">{{ $c->name }}</a>
                                            </h6>
                                            <span class="item-company"> <a href="javascript:void(0)" class="company-name">{{$c->attributes->option }}</a></span>
                                            
                                        </div>
                                        
                                        <!-- jika ada waktu  -->
                                        <!-- <div class="item-quantity">
                                            <span class="quantity-title">Qty:</span>
                                            <div class="input-group quantity-counter-wrapper">
                                                <input type="text" class="quantity-counter" value="{{   $c->quantity }}" />
                                            </div>
                                        </div> -->
                                        
                                    </div>
                                    <div class="item-options text-center">
                                        <div class="item-wrapper">
                                            <div class="item-cost">
                                                <h4 class="item-price">{{  "Rp " . number_format( $c->quantity*$c->price,0,',','.') }}</h4>
                                                
                                            </div>
                                        </div>
                                        <a href="{{ url('shop/delete/'.$c->id) }}"  class="btn btn-light mt-1 ">
                                            <i data-feather="x" class="align-middle mr-25"></i>
                                            <span>Remove</span>
                                        </a>
                                      
                                        
                                    </div>
                                </div>
                                @endforeach

                                </div>
                                <!-- Checkout Place Order Left ends -->

                                <!-- Checkout Place Order Right starts -->
                                <div class="checkout-options">
                                    <div class="card">
                                        <div class="card-body">
                                            <label class="section-label mb-1">Options</label>
                                            <div class="coupons input-group input-group-merge">
                                                <input type="text" class="form-control required" placeholder="Coupons" aria-label="Coupons" aria-describedby="input-coupons" />
                                                <div class="input-group-append">
                                                    <span class="input-group-text text-primary" id="input-coupons">Apply</span>
                                                </div>
                                            </div>
                                            <hr />
                                            <div class="price-details">
                                                <h6 class="price-title">Detail pembelian  </h6>
                                                <ul class="list-unstyled">
                                                    @foreach($cart as $c)

                                                    <li class="price-detail">
                                                        <div class="detail-title">{{ $c->name }}</div>
                                                        <div class="detail-amt">{{  "Rp " . number_format( $c->quantity*$c->price,0,',','.') }}</div>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                <hr />
                                                <ul class="list-unstyled">
                                                    <li class="price-detail">
                                                        <div class="detail-title detail-total">Total</div>
                                                        <div class="detail-amt font-weight-bolder">{{  "Rp " . number_format( $subtotal,0,',','.') }}</div>
                                                    </li>
                                                </ul>
                                                <button type="button" class="btn btn-primary btn-block btn-next place-order">Lakukan order</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Checkout Place Order Right ends -->
                                </div>
                            </div>
                            <!-- Checkout Place order Ends -->
                        </div>
                        <!-- Checkout Customer Address Starts -->
                        <div id="step-address" class="content">
                            <form  action="{{ url('checkout/alamatbaru') }}" id="alamatbaru" method="post" class="list-view product-checkout">
                                @method('POST')
                                @csrf
                                <!-- Checkout Customer Address Left starts -->
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Tambahkan alamat baru</h4>
                                        <!-- <p class="card-text text-muted mt-25">Be sure to check "Deliver to this address" when you have finished</p> -->
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-name">Nama:</label>
                                                    <input type="text" id="checkout-name" class="form-control required " name="nama"  />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-number">Nomor hp:</label>
                                                    <input type="number" id="checkout-number" class="form-control required" name="nomor_hp" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-apt-number">Kode pos:</label>
                                                    <input type="number" id="checkout-apt-number" class="form-control required" name="kode_pos"  />
                                                </div>
                                            </div>
                                          
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-pincode">Email:</label>
                                                    <input type="email" id="checkout-pincode" class="form-control required" name="email" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-pincode">Jenis klamin:</label>
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
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group mb-2">
                                                    <label for="checkout-pincode">Alamat:</label>
                                                    <textarea class="form-control   required" id="alamat" name="alamat" rows="3"></textarea>
                                                   
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <button type="submit" class="btn btn-primary ">Tambah alamat baru</button>
                                                <button type="submit" class="btn btn-primary ">Alamat yang sudah ada</button>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Checkout Customer Address Left ends -->

                            </form>
                        </div>
                        <!-- Checkout Customer Address Ends -->

                        <!-- Checkout Payment Starts -->
                        <div id="step-payment" class="content">
                            
                        </div>
                        <!-- Checkout Payment Ends -->
                        <!-- </div> -->
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
@endsection

<!-- js -->
@section('js')
 <!-- BEGIN: Page Vendor JS-->
 <script src="app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="app-assets/vendors/js/forms/wizard/bs-stepper.min.js"></script>
    <script src="app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="app-assets/vendors/js/extensions/toastr.min.js"></script>
    <!-- END: Page Vendor JS-->
<script src="app-assets/js/scripts/pages/app-ecommerce-checkout.js"></script>
<script src="app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
<!-- script -->
<script type="text/javascript">

  $(function () {



      $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

    });

    if ($("#alamatbaru").length > 0) {
            $("#alamatbaru").validate({
                rules: {
             
                    jenis_klamin: "required",
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