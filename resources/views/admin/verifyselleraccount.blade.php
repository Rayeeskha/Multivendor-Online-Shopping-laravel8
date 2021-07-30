@extends('admin/layout')
@section('banner_title', 'Home Banner')
@section('seller_select', 'active')
@section('container')
   <div class="card height-auto">
<div class="card-body">

    <span style="color: green;font-weight: 500;text-align: center;">{{session('message')}}</span>

    <div class="heading-layout1">
        <div class="item-title">
            <h3>Manage Sellers</h3>
        </div>
       
    </div>
    <form class="mg-b-20">
        <div class="row gutters-8">
            <div class="col-md-5"></div> 
           
            <div class="col-5-xxxl col-xl-5 col-lg-5 col-12 form-group">
                <input type="text" placeholder="Search by Name ..." class="form-control">
            </div>
            <div class="col-1-xxxl col-xl-2 col-lg-3 col-12 form-group">
                <button type="submit" class="fw-btn-fill btn-gradient-yellow">SEARCH</button>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table display data-table text-nowrap">
            <thead>
                <tr>
                    <th>Seller Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone</th>
                    
                    <th>Email</th>
                    <th>Company</th>
                    <th>Aadhar Number</th>
                    <th>GST Number</th>
                    <th>PAN Number</th>

                    <th>Address</th>
                    <th>Location</th>
                    <th>Website</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($sellers as $list)
                <tr>
                    
                    <td>{{$list->seller_id}}</td>
                    <td>{{$list->fname}}</td>
                    <td>{{$list->lname}}</td>
                    <td><a href="tel:{{$list->phone}}">{{$list->phone}}</a></td>
                    <td><a href="mailto:{{$list->email}}">{{$list->email}}</a></td>
                    <td>{{$list->company}}</td>
                    <td>{{$list->aadharnumber}}</td>
                    <td>{{$list->gstumber}}</td>
                    <td>{{$list->pannumber}}</td>
                    <td>{{$list->address}}</td>
                    <td><h6>City : {{$list->city}}</h6>
                        <h6>State : {{$list->state}}</h6>
                        <h6>Pincode : {{$list->zip}}</h6>
                    </td>
                    <td>{{$list->website}}</td>
                    <td>
                        @if($list->status == 'Active')
                            <span class="badge badge-success">{{$list->status}}</span>
                        @else
                            <span class="badge badge-danger">{{$list->status}}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this Seller ?')" href="{{url('admin/selleraccount/delete/')}}/{{$list->id}}"><i class="fas fa-times text-orange-red" ></i>Delete</a>

                                  @if($list->status == 'Active')
                                   <a class="dropdown-item" href="{{url('admin/sellers/changeselleraccount/')}}/{{$list->id}}/Deactive"><i class="fas fa-cogs text-dark-pastel-green"></i>Deactivate</a>
                                @elseif($list->status == 'AdminVerification')
                                   <a class="dropdown-item" href="{{url('admin/sellers/changeselleraccount/')}}/{{$list->id}}/Active"><i class="fas fa-cogs text-dark-pastel-green"></i>Active</a>
                                @else
                                    <a class="dropdown-item" href="{{url('admin/sellers/changeselleraccount/')}}/{{$list->id}}/Active"><i class="fas fa-cogs text-dark-pastel-green"></i>Active</a>
                                @endif
                                
                            </div>
                        </div>
                    </td>
                </tr> 
                @endforeach  
            </tbody>
        </table>
    </div>
</div>
</div>




@endsection


