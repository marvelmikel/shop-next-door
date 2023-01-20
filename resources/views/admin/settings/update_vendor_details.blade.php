@extends('admin.layout.layout')
@section('content')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Update Vendor Details</h3>
                        {{-- <h6 class="font-weight-normal mb-0">Update Admin Password</h6> --}}
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
                                    <a class="dropdown-item" href="#">January - March</a>
                                    <a class="dropdown-item" href="#">March - June</a>
                                    <a class="dropdown-item" href="#">June - August</a>
                                    <a class="dropdown-item" href="#">August - November</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($slug=="personal")
        <div class="row">

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Personal Details</h4>

                  @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong>{{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif


                  @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong>{{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif


              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $errors)
                    <li>{{ $errors }}</li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
              </div>
              @endif

                  <form class="forms-sample" action="{{ url('admin/update-vendor-details/personal') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Vendor Email</label>
                      <input  class="form-control" name="vendor_email" value="{{ Auth::guard('admin')->user()->email }}">
                    </div>
                    <div class="form-group">
                      <label for="vendor_name">Name</label>
                      <input type="text" class="form-control" name="vendor_name" value="{{Auth::guard('admin')->user()->name}}">

                    </div>
                    <div class="form-group">
                        <label for="vendor_address">Address</label>
                        <input type="text" class="form-control" name="vendor_address" value="{{ $vendorDetails['address'] }}">

                    </div>
                    <div class="form-group">
                        <label for="vendor_city">City</label>
                        <input type="text" class="form-control" name="vendor_city" value="{{ $vendorDetails['city'] }}">

                    </div>
                    <div class="form-group">
                        <label for="vendor_state">State</label>
                        <input type="text" class="form-control" name="vendor_state" value="{{ $vendorDetails['state'] }}">

                    </div>
                    <div class="form-group">
                        <label for="vendor_country">Country</label>
                        <input type="text" class="form-control" name="vendor_country" value="{{ $vendorDetails['country'] }}">

                    </div>
                    <div class="form-group">
                        <label for="vendor_pincode">Pincode</label>
                        <input type="text" class="form-control" name="vendor_pincode" value="{{ $vendorDetails['pincode'] }}">

                    </div>
                    <div class="form-group">
                        <label for="vendor_mobile">Mobile</label>
                        <input type="text" class="form-control" value="{{Auth::guard('admin')->user()->mobile}}"  name="vendor_mobile" >
                      </div>
                    <div class="form-group">
                      <label for="vendor_image">Photo</label>
                      <input type="file" class="form-control" id="vendor_image" name="vendor_image">
                      <br/>

                      @if (!empty(Auth::guard('admin')->user()->image))
                      <button class="btn btn-light"> <a target="_black" href="{{ url('admin/images/photos/'.Auth::guard('admin')->user()->image) }}">View Image</a></button>
                      <input type="hidden" name="current_vendor_image" value="{{ Auth::guard('admin')->user()->image }}">
                      @endif

                    </div>
                    <button  type="submit" class="btn btn-primary mr-2">Submit</button>
                    {{-- <button class="btn btn-light">Cancel</button> --}}
                  </form>
                </div>
              </div>
            </div>
          </div>




        @elseif($slug=="business")

        <div class="row">

            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Update Business Details</h4>

                  @if(Session::has('error_message'))
                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong>{{ Session::get('error_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif


                  @if(Session::has('success_message'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong>{{ Session::get('success_message') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif


              @if ($errors->any())
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $errors)
                    <li>{{ $errors }}</li>
                    @endforeach
                    <button type="button" class="close" data-dismiss="alert" aria-label="close">
                        <span aria-hidden="true">&times;</span>
                    </button>
              </div>
              @endif

                  <form class="forms-sample" action="{{ url('admin/update-vendor-details/business') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                      <label>Vendor Username/Email</label>
                      <input  class="form-control" name="shop_email" value="{{ Auth::guard('admin')->user()->email }}" readonly="">
                    </div>
                    <div class="form-group">
                      <label for="shop_name">Shop Name</label>
                      <input type="text" class="form-control" name="shop_name" value="{{ $vendorDetails['shop_name'] }}" placeholder="Enter Shop Name">

                    </div>
                    <div class="form-group">
                        <label for="shop_address">Shop Address</label>
                        <input type="text" class="form-control" name="shop_address" value="{{ $vendorDetails['shop_address'] }}"  placeholder="Enter Shop Address">

                    </div>
                    <div class="form-group">
                        <label for="shop_city"> Shop City</label>
                        <input type="text" class="form-control" name="shop_city" value="{{ $vendorDetails['shop_city'] }}" placeholder="Enter Shop City">

                    </div>
                    <div class="form-group">
                        <label for="shop_state">Shop State</label>
                        <input type="text" class="form-control" name="shop_state" value="{{ $vendorDetails['shop_state'] }}" placeholder="Enter Shop State">

                    </div>
                    <div class="form-group">
                        <label for="shop_country">Shop Country</label>
                        <input type="text" class="form-control" name="shop_country" value="{{ $vendorDetails['shop_country'] }}" placeholder="Enter Shop Country">

                    </div>
                    <div class="form-group">
                        <label for="shop_pincode">Shop Pincode</label>
                        <input type="text" class="form-control" name="shop_pincode" value="{{ $vendorDetails['shop_pincode'] }}" placeholder="Enter Shop Pincode">

                    </div>
                    <div class="form-group">
                        <label for="shop_mobile">Shop Mobile</label>
                        <input type="text" class="form-control" value="{{ $vendorDetails['shop_mobile'] }}"  name="shop_mobile" placeholder="Enter Shop Mobile">
                      </div>
                      <div class="form-group">
                        <label for="business_license_number">Business Registration Number</label>
                        <input type="text" class="form-control" value="{{$vendorDetails['business_license_number']}}"  name="business_license_number" placeholder="Enter Business Registration Number">
                      </div>
                      <div class="form-group">
                        <label for="address_proof">Address Proof</label>
                       <select class="form-control" name="address_proof" id="address_proof" style="color: black; font-family:bold">
                        <option  value="Passport" @if($vendorDetails['address_proof']=="Passport"
                        ) selected @endif>International Passport</option>
                        <option value="Voters Card"  @if($vendorDetails['address_proof']=="Voters Card"
                        ) selected @endif>Voters Card</option>
                        <option value="Driving Licence"  @if($vendorDetails['address_proof']=="Driving Licence"
                        ) selected @endif>Driving Licence</option>
                        <option value="NIN" @if($vendorDetails['address_proof']=="NIN"
                        ) selected @endif>NIN</option>
                       </select>
                      </div>
                    <div class="form-group">
                      <label for="address_proof_image">Proof of Address Image</label>
                      <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">

                      @if(!empty($vendorDetails['address_proof_image']))
                      <br/>
                      <button class="btn btn-light">
                        <a target="_black" href="{{ url('admin/images/proofs/'.$vendorDetails['address_proof_image']) }}">View Proof Of Address</a></button>
                      <input type="hidden" name="current_address_proof" value="{{
                       $vendorDetails['address_proof_image']}}">
                      @endif
                    </div>
                    <button  type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

        @elseif($slug=="bank")

        @endif
    </div>

    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    @include('admin.layout.footer')
    <!-- partial -->
</div>

@endsection
