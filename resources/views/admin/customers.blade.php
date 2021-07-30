@extends('admin/layout')
@section('page_title', 'Customer List')
@section('customer_select', 'active')
@section('container')
   <div class="card height-auto">
<div class="card-body">

    <span style="color: green;font-weight: 500;text-align: center;">{{session('message')}}</span>

    <div class="heading-layout1">
        <div class="item-title">
            <h3>Customers</h3>
        </div>
       
    </div>
    <form class="mg-b-20">
        <div class="row gutters-8">
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
                    <th>S.NO</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Pincode</th>
                    <th>Status</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $cate)
                <tr>
                    
                    <td>{{$cate->id}}</td>
                    <td>{{$cate->name}}</td>
                    <td><a href="mailto:{{$cate->email}}">{{$cate->email}}</a></td>
                    <td><a href="tel:{{$cate->mobile}}">{{$cate->mobile}}</a></td>
                    <td>{{$cate->address}}</td>
                    <td>{{$cate->pincode}}</td>
                    <td>
                        @if($cate->status == 'Active')
                           <span class="badge badge-primary">{{$cate->status}}</span>
                        @else
                            <span class="badge badge-danger">{{$cate->status}}</span>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <span class="flaticon-more-button-of-three-dots"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" onclick="return confirm('Are you sure you want to delete this Colors ?')" href="{{url('admin/customers/delete/')}}/{{$cate->id}}"><i class="fas fa-times text-orange-red" ></i>Delete</a>

                                <a class="dropdown-item" href="{{url('admin/customers/show/')}}/{{$cate->id}}"><i class="fas fa-cogs text-dark-pastel-green"></i>View</a>

                                  @if($cate->status == 'Active')
                                   <a class="dropdown-item" href="{{url('admin/customers/changecustomersstatus/')}}/{{$cate->id}}/Deactivate"><i class="fas fa-cogs text-dark-pastel-green"></i>Deactivate</a>
                                @else
                                    <a class="dropdown-item" href="{{url('admin/customers/changecustomersstatus/')}}/{{$cate->id}}/Active"><i class="fas fa-cogs text-dark-pastel-green"></i>Active</a>
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


